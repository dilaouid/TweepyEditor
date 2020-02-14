<?php

/*  Developed by dilaouid for Advimotion
    PHP & JS scripts to parse and manipulate a tweepy-bot */

    require_once('inc/func.php');
    require_once('inc/post.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BotEditor</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/front.css">
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 22px;">
            <div class="col">
                <div class="selectfile">
                    <button class="file btn btn-primary w-100" type="button" id="importFileButton">
                        <i class="fa fa-star fa-plus" id="iconFile"></i>
                        <input type="file" id="inputFile" name="scriptFile" onchange="handleFiles()">
                        <span id="nameFile">Importer le BOT Python</span>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="alertError">
    </div>

        <form style="margin-top: 18px;" id="formSub" method="post" enctype="multipart/form-data">
        <div id="FavRT" style="display: none;">
                <div class="form-row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="hashtagCard">

                                <h4 class="card-title">Mots à RT</h4>
                                <h6 class="text-muted card-subtitle mb-2">Liste des mots à RT sur Twitter</h6>

                                <div class="form-row hashtagRow" style="margin-bottom: 17px;" id="hashtagForm_1">
                                    <div class="col-8">
                                        <input class="form-control" type="text" name="hashtag[]">
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-outline-success" type="button" onclick="addElem('hashtag')">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="accountCard">

                                <h4 class="card-title">Comptes blacklistés</h4>

                                <h6 class="text-muted card-subtitle mb-2">Liste des comptes à blacklister</h6>

                                <div class="form-row row-cols-2 accountRow" style="margin-bottom: 17px;" id="accountForm_1">
                                    <div class="col-8">
                                        <input class="form-control" type="text" name="account[]">
                                    </div>

                                    <div class="col-4">
                                        <button class="btn btn-outline-success" type="button" onclick="addElem('account')">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="hashtagBanCard">
                                <h4 class="card-title">Mots à exclure</h4>
                                <h6 class="text-muted card-subtitle mb-2">Liste des mots à exclure</h6>
                                <div class="form-row row-cols-2" style="margin-bottom: 17px;" id="hashtagBan_1">
                                    <div class="col-8">
                                        <input class="form-control" type="text" name="hashtagBan[]">
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-outline-success" type="button" onclick="addElem('hashtagBan')">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="themeCard">
                                <h4 class="card-title">Thèmes</h4>
                                <h6 class="text-muted card-subtitle mb-2">Liste des thèmes</h6>
                                <div class="form-row row-cols-2" style="margin-bottom: 17px;" id="theme_1">
                                    <div class="col-8">
                                        <input class="form-control" type="text" name="theme[]">
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-outline-success" type="button" onclick="addElem('theme')">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <button class="btn btn-link btn-block btn-lg" type="submit" style="margin-top: 18px;" name="submit">
                            <i class="fas fa-file-download"></i>
                            &nbsp; &nbsp;Télécharger le nouveau script</button>
                        </div>
                </div>
        </div>
        <div id="configBot" style="display: none;">
                <div class="form-row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="consumerKeyCard">

                                <h4 class="card-title">Consumer Key</h4>
                                <h6 class="text-muted card-subtitle mb-2">Configurez votre consumer key</h6>

                                <div class="form-row consumerKeyRow" style="margin-bottom: 17px;" id="consumerKey_1">
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="consumerKey[]">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="consumerSecretCard">

                                <h4 class="card-title">Consumer Secret</h4>

                                <h6 class="text-muted card-subtitle mb-2">Configurez votre consumer secret</h6>

                                <div class="form-row row-cols-2 consumerSecretRow" style="margin-bottom: 17px;" id="consumerSecret_1">
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="consumerSecret[]">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="accessTokenCard">
                                <h4 class="card-title">Access Token</h4>
                                <h6 class="text-muted card-subtitle mb-2">Configurez votre access token</h6>
                                <div class="form-row row-cols-2" style="margin-bottom: 17px;" id="accessToken_1">
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="accessToken[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body" id="accessTokenSecretCard">
                                <h4 class="card-title">Access Token Secret</h4>
                                <h6 class="text-muted card-subtitle mb-2">Configurez votre access token secret</h6>
                                <div class="form-row row-cols-2" style="margin-bottom: 17px;" id="accessTokenSecret_1">
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="accessTokenSecret[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <button class="btn btn-link btn-block btn-lg" type="submit" style="margin-top: 18px;" name="submit">
                            <i class="fas fa-file-download"></i>
                            &nbsp; &nbsp;Télécharger le nouveau script</button>
                        </div>
                </div>
        </div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <script>

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
            document.getElementsByName('consumerKey[]')[0].value        = consumerKey
            document.getElementsByName('consumerSecret[]')[0].value     = consumerSecret
            document.getElementsByName('accessToken[]')[0].value        = accessToken
            document.getElementsByName('accessTokenSecret[]')[0].value  = accessTokenSecret
        }

        function displayFavRT(usersToExclude, wordstoExclude, wordstoInclude, mainTheme) {
            delElem('configBot')
            let formDisplay = document.querySelector('#FavRT')
            formDisplay.setAttribute('style', '')
            fillInput('hashtag', wordstoInclude);
            fillInput('account', usersToExclude);
            fillInput('hashtagBan', wordstoExclude);
            fillInput('theme', mainTheme);
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
            displayAlert.innerHTML = "<strong>Le fichier importé n'a pas pu être importé correctement !</strong><br>Vous ne pouvez paramétrer que le fichier <strong>favretweet.py</strong> ou </strong>config.py</strong>.<br>Si vous avez essayé d'ouvrir l'un de ses fichiers, une erreur est survenue dans sa lecture. Merci de vérifier si le fichier ne contient pas d'erreurs.<br>(Le fichier de configuration doit contenir entre 25 et 30 lignes)"
            p.appendChild(displayAlert)
            delElem('formSub')
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
                var usersToExclude  = parseArray('users_to_exclude = [', lines, i)
                if (!usersToExclude)
                    return ;
                var wordstoInclude  = parseArray('words_to_include = [', lines, i)
                var wordstoExclude  = parseArray('words_to_exclude = [', lines, i)
                var mainTheme       = parseArray('main([', lines, i)
                if (!usersToExclude || !wordstoInclude || !wordstoExclude || !mainTheme)
                    return ;
                displayFavRT(usersToExclude, wordstoExclude, wordstoInclude, mainTheme)
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

    </script>


</body>

</html>