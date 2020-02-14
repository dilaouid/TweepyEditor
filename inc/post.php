<?php

    if (isset($_POST['submit'])) {
        if (isset($_POST['hashtag'])) {
            $hashtag = properArrCreation('words_to_include', $_POST['hashtag']);
            $hashtagBan = properArrCreation('words_to_exclude', $_POST['hashtagBan']);
            $account = properArrCreation('users_to_exclude', $_POST['account']);
            $theme = properTheme($_POST['theme']);
            $downloadScript = parseFavRT($hashtag, $hashtagBan, $account, $theme, $_FILES['scriptFile']['tmp_name']);
            writeFile('tmp/favretweet.py', $downloadScript);
            downloadFile('tmp/favretweet.py');
        } else {
            echo 'TO_DO';
        }


    }

?>