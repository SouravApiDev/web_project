<?php
    $url = "https://www.youtube";
    $st = shell_exec("python youtube_api.py " .$url);
    $d = json_decode($st, true);
    if($d == ""){
        echo "pass";
    }
    echo $st;
?>