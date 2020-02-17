
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        console.log('Super! Toutes les API sont supportées !');
    } else {
        alert('Les APIs navigateurs ne sont pas supportées ! Essayez de changer de navigateur ou de le mettre à jour !');
    }

    function delElem(divID) {
        let element = document.getElementById(divID);
        element.parentNode.removeChild(element);
    }

    function addElem(type, value = null, enteredValue = false) {
        let p = document.querySelector('#' + type + 'Card');
        let nb = document.querySelectorAll('.' + type + 'Row').length + 1;
        var newElement = document.createElement('div');

        newElement.setAttribute('class', 'form-row ' + type + 'Row');
        newElement.setAttribute('style', 'margin-bottom: 17px');
        newElement.setAttribute('id', type + 'Form_' + nb);
        if (value === null || enteredValue == false)
            value = ''
        newElement.innerHTML = '<div class="col-8"><input class="form-control" type="text" name="' + type + '[]" value="' + value + '"></div><div class="col-4"><button class="btn btn-outline-success" type="button" onclick="addElem(\'' + type + '\',\'' + value + '\', false)"><i class="fas fa-plus"></i></button><button class="btn btn-outline-danger" type="button" style="margin-left: 3px;" onclick="delElem(\'' + type + 'Form_' + nb + '\')"><i class="fas fa-times"></i></button></div>';
        p.appendChild(newElement);
    }

    function getFilename(txtBtn) {
        let fullPath = document.querySelector('#inputFile').value;
        let startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0)
            filename = filename.substring(1);
        txtBtn.innerHTML = filename;
    }

    function fillInput(id, arr) {
        var inputBox = document.getElementsByName(id + '[]')
        if (arr[0])
            inputBox[0].value = arr[0];
        else
            return ;
        arr.forEach(function(item, index, array) {
            if (index > 0 && array[index].length > 0)
                addElem(id, array[index], true)
        });
    }

    function displayConfig(consumerKey, consumerSecret, accessToken, accessTokenSecret) {
        delElem('FavRT')
        let formDisplay = document.querySelector('#configBot')
        formDisplay.setAttribute('style', '')
        document.getElementsByName('consumerKey')[0].value        = consumerKey
        document.getElementsByName('consumerSecret')[0].value     = consumerSecret
        document.getElementsByName('accessToken')[0].value        = accessToken
        document.getElementsByName('accessTokenSecret')[0].value  = accessTokenSecret
    }

    function displayFavRT(usersToExclude, wordstoExclude, wordstoInclude, mainTheme, minSec, maxSec) {
        delElem('configBot')
        let formDisplay = document.querySelector('#FavRT')
        formDisplay.setAttribute('style', '')
        fillInput('hashtag', wordstoInclude);
        fillInput('account', usersToExclude);
        fillInput('hashtagBan', wordstoExclude);
        fillInput('theme', mainTheme);

        document.getElementsByName('minSec')[0].value        = minSec
        document.getElementsByName('maxSec')[0].value        = maxSec
    }

    function epurArray(arr) {
        var i = 0;
        arr.forEach(function(item, index, array) {
            if (array[index] == ']' || array[index] == ')' || array[index] == ', ' || array[index] == ',' || array[index] == "" || (!arr[index]))
                array.splice(index, 1)
        });
        var filtered = arr.filter(function(el) { return el; });
        console.log(filtered)
        return filtered;
    }

    function showAlert() {
        var displayAlert = document.createElement('div');
        let p = document.querySelector('#alertError');
        displayAlert.setAttribute('class', 'alert alert-danger');
        displayAlert.setAttribute('style', 'margin-top:22px');
        displayAlert.innerHTML = "<strong>Le fichier importé est incorrect !</strong><br>Vous ne pouvez paramétrer que les fichiers <strong>favretweet.py</strong> ou <strong>config.py</strong>.<br>Si vous avez essayé d'ouvrir l'un de ses fichiers, une erreur est survenue dans sa lecture. Merci de vérifier si le fichier ne contient pas d'erreurs.<br>(Le fichier de configuration doit contenir entre 25 et 30 lignes)"
        p.appendChild(displayAlert)
        delElem('formSub')
    }

    function parseVar(pointer, lines) {
        let i = 0;
        while (i < lines.length && lines[i].includes(pointer) === false)
            i++;
        if (i >= lines.length) {
            showAlert()
            return ;
        }
        let varSplit = lines[i].split('=');
        return varSplit[1].trim()
    }

    function parseArray(pointer, lines, i) {
        var arr        = [];
        var returnArr  = [];
        var epurStr    = '';

        while (i < lines.length && lines[i].includes(pointer) === false)
                i++;
        if (i >= lines.length) {
            showAlert()
            return ;
        }
        while (lines[i].includes(']') === false) {
            epurStr = lines[i].replace(/\"/g, "'").trim();
            arr.push(epurStr.split("\'"))
            i++;
        }
        epurStr = lines[i].replace(/\"/g, "'").trim();
        arr.push(epurStr.split("\'"))
        for (var j = 0; j < arr.length; j++)
            returnArr = returnArr.concat(arr[j]);

        returnArr.shift();
        returnArr.pop();

        var parsedArray = returnArr;
        parsedArray = epurArray(parsedArray);
        return returnArr
    }

    function parseContent(lines) {
        var i = 0;
        if (lines.length > 25 && lines.length < 30) {
            while (lines[i] != 'def create_api():')
                i++;
            var consumerKey         = lines[i + 1].split('\"')[1];
            var consumerSecret      = lines[i + 2].split('\"')[1];
            var accessToken         = lines[i + 3].split('\"')[1];
            var accessTokenSecret   = lines[i + 4].split('\"')[1];
            displayConfig(consumerKey, consumerSecret, accessToken, accessTokenSecret)
        } else {
            var minSec          = parseVar('number_min_sec =', lines)
            var maxSec          = parseVar('number_max_sec =', lines)
            var usersToExclude  = parseArray('users_to_exclude = [', lines, i)
            if (!usersToExclude)
                return ;
            var wordstoInclude  = parseArray('words_to_include = [', lines, i)
            var wordstoExclude  = parseArray('words_to_exclude = [', lines, i)
            var mainTheme       = parseArray('main([', lines, i)
            if (!usersToExclude || !wordstoInclude || !wordstoExclude || !mainTheme)
                return ;
            displayFavRT(usersToExclude, wordstoExclude, wordstoInclude, mainTheme, minSec, maxSec)
        }
    }

    function handleFiles() {

        let txtBtn = document.querySelector('#nameFile')
        let iconBtn = document.querySelector('.fa')
        let importBtn = document.querySelector('#importFileButton')
        var selectedFile = document.getElementById('inputFile').files[0];

        var real = $("#inputFile");
        var cloned = real.clone(true);
        real.hide();
        cloned.insertAfter(real);   
        real.appendTo("#formSub");

        var reader = new FileReader();
        reader.onload = (function(reader)
        { return function() {
                var contents = reader.result;
                var lines = contents.split('\n');
                parseContent(lines)
        }})(reader);

        reader.readAsText(selectedFile);

        getFilename(txtBtn);

        iconBtn.className = 'fa fa-star fa-file-text-o'
        importBtn.className = 'btn btn-info w-100 disabled'

    }