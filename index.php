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
                                        <input class="form-control" type="text" name="consumerKey">
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
                                        <input class="form-control" type="text" name="consumerSecret">
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
                                        <input class="form-control" type="text" name="accessToken">
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
                                        <input class="form-control" type="text" name="accessTokenSecret">
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
    <script src="inc/parsing.js"></script>

</body>

</html>