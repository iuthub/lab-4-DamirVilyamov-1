<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <link href="viewer.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="header">
    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
</div>

<div id="listarea">
    <ul id="musiclist">
        <?php

        $queryparam = array_key_exists("playlist", $_GET) ? htmlspecialchars($_GET["playlist"]) : null;

        $files = glob("songs/*.mp3");
        $playlists = glob("songs/*.txt");

        if (!empty($queryparam) || $queryparam != null) {
            $lines = file("$queryparam");
            foreach ($lines as $line) {
                ?>
                <li class="mp3item">
                    <a href="<?= $line ?>"><?= $line ?></a>
                </li>
                <?php
            }
        } else {
            foreach ($files as $file) {
                $size = filesize($file);
                $sizeStr = "";
                if (intval($size / 1024) > 0) {
                    $sizeStr = round($size / 1024, 0) . " Kb";
                    if (intval($size / 1048576) > 0) {
                        $sizeStr = round($size / 1048576, 0) . " Mb";
                    }
                } else {
                    $sizeStr = ($size) . " B";
                }
                ?>
                <li class="mp3item">
                    <a href="<?= $file ?>"><?= substr($file, 6) ?></a>

                    <?= $sizeStr ?>
                </li>
                <?php
            }
            foreach ($playlists as $playlist) {
                ?>
                <li class="playlistitem">
                    <a href="music.php?playlist=<?= $playlist ?>"><?= substr($playlist, 6) ?></a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>
</body>
</html>
<?php

