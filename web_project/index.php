<html>
    <head>
        <title>Welcome</title>
        <link rel="icon" type="image/x-icon" href="icon/favicon.ico">
    </head>
</html>
<?php
    function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    if(isMobile()){
        header('Location: /mobile.php');
    }
    else{
        //$link .= $_SERVER['HTTP_HOST'];
        header('Location: /Desktop.php');
    }
?>