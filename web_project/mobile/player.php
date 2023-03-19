<head>
    <title><?php echo $_GET['title']; ?></title>
    <style>
        #ytplayer{
            border-radius: 8px;
        }
    </style>
    </head>
<?php
if(isset($_GET['videoid'])){

$videoId = $_GET['videoid'];
    echo '<iframe id="ytplayer" type="text/html" width="720" height="405" src="https://www.youtube.com/embed/'.$videoId.'?modestbranding=1&autoplay=1&rel=0" frameborder="0" allowfullscreen>';
}
?>
