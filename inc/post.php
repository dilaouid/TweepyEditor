<?php

    if (isset($_POST['submit'])) {
        if (isset($_POST['hashtag'])) {
            $hashtag            = properArrCreation('words_to_include', $_POST['hashtag']);
            $hashtagBan         = properArrCreation('words_to_exclude', $_POST['hashtagBan']);
            $account            = properArrCreation('users_to_exclude', $_POST['account']);
            $theme              = properTheme($_POST['theme']);

            $minSec             = properVar('number_min_sec', $_POST['minSec'], false);
            $maxSec             = properVar('number_max_sec', $_POST['maxSec'], false);

            $downloadScript     = parseFavRT($hashtag, $hashtagBan, $account, $theme, $minSec, $maxSec, $_FILES['scriptFile']['tmp_name']);
            $filename           = 'tmp/favretweet.py';
        } else if (isset($_POST['consumerKey'])){
            $consumerKey        = properVar('consumer_key', $_POST['consumerKey']);
            $consumerSecret     = properVar('consumer_secret', $_POST['consumerSecret']);
            $accessToken        = properVar('access_token', $_POST['accessToken']);
            $accessTokenSecret  = properVar('access_token_secret', $_POST['accessTokenSecret']);
            $downloadScript     = parseConfig($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $_FILES['scriptFile']['tmp_name']);
            $filename           = 'tmp/config.py' ;
        }

        if (isset($downloadScript)) {
            writeFile($filename, $downloadScript);
            downloadFile($filename);
        }


    }

?>