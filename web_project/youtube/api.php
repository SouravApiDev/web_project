<?php
    function getUrl($Url){
        $Url_string = parse_url($Url, PHP_URL_QUERY);
        parse_str($Url_string, $args);
        return isset($args['v']) ? $args['v'] : false;
    }
    $videoURL = "https://youtu.be/SDjVIbUIPtA";
    $videoID=getUrl($videoURL);
    echo "<h1>".$videoID."</h1>";
?>