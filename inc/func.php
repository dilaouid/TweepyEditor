<?php

    function properArrCreation($varName, $arr) {
        $ret = $varName . " = [";
        for ($i = 0; $i < count($arr); $i++) { 
            if (!empty($arr[$i])) {
                $el = str_replace("'", "\'", $arr[$i]);
                $ret .= "'". $el ."'";
                if (isset($arr[$i + 1])) {
                    $ret .= ', ';
                } else {
                    $ret .= ']';
                }
            }
        }
        return $ret;
    }

    function properTheme($arr) {
        $ret = 'main([';
        for ($i = 0; $i < count($arr); $i++) { 
            if (!empty($arr[$i])) {
                $ret .= '"' . $arr[$i] . '"';
                $el = str_replace('"', '\"', $arr[$i]);
                if (isset($arr[$i + 1])) {
                    $ret .= ', ';
                } else {
                    $ret .= '])';
                }
            }
        }
        return $ret;
    }

    function properVar($varName, $value) {
        $ret = $varName . ' = "' . $value . '"';
        return $ret;
    }

    function parseFavRT($hashtag, $hashtagBan, $account, $theme, $file) {
        $i = 0;
        $arrContent = array('');
        $line = null;
        if ($fh = fopen($file, 'r')) {
            while (!feof($fh)) {
                while (strpos($line, 'number_max_sec') === false) {
                    $arrContent[$i] = fgets($fh);
                    $line = $arrContent[$i];
                    $i++;
                }
                $arrContent[$i++] = PHP_EOL . $account . PHP_EOL;
                $arrContent[$i++] = $hashtag . PHP_EOL;
                $arrContent[$i++] = $hashtagBan . PHP_EOL . PHP_EOL;
                while (strpos($line, 'class FavRetweetListener(tweepy.StreamListener):') === false) {
                    $line = fgets($fh);
                    $i++;
                }
                $arrContent[$i++] = $line;
                while (strpos($line, 'if __name__ == "__main__":') === false) {
                    $arrContent[$i] = fgets($fh);
                    $line = $arrContent[$i];
                    $i++;
                }
                $arrContent[$i++] = chr(9) . $theme . PHP_EOL;
                return array_filter(array_values($arrContent));
            }
        }
    }

    function parseConfig($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret, $file) {
        $i = 0;
        $arrContent = array('');
        $line = null;
        if ($fh = fopen($file, 'r')) {
            while (!feof($fh)) {
                while (strpos($line, 'def create_api():') === false) {
                    $arrContent[$i] = fgets($fh);
                    $line = $arrContent[$i];
                    $i++;
                }
                $arrContent[$i++] = chr(9) . $consumerKey . PHP_EOL;
                $arrContent[$i++] = chr(9) . $consumerSecret . PHP_EOL;
                $arrContent[$i++] = chr(9) . $accessToken . PHP_EOL;
                $arrContent[$i++] = chr(9) . $accessTokenSecret . PHP_EOL . PHP_EOL;
                while (strpos($line, 'auth = tweepy.OAuthHandler(consumer_key, consumer_secret)') === false) {
                    $line = fgets($fh);
                    $i++;
                }
                $arrContent[$i++] = $line;
                while (strpos($line, 'create_api()') === false) {
                    $arrContent[$i] = fgets($fh);
                    $line = $arrContent[$i];
                    $i++;
                }
                return array_filter(array_values($arrContent));
            }
        }

    }

    function writeFile($filename, $arrContent) {
        $ret = '';
        for ($i = 0; $i < count($arrContent); $i++) { 
            if (isset($arrContent[$i])) {
                $ret .= $arrContent[$i];
            }
        }
        file_put_contents($filename, $ret);
    }

    function downloadFile($file) {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            unlink($file);
            exit ;
        }
    }

?>