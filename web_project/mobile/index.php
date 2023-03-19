<head>
    <title>Youtube Clone</title>
    <style>
    .search{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .search_result{
            display: flex;
            align-items: left;
            justify-content: left;
            width: 100%;
            margin-bottom: 2px;
            background-color: #1c1c1c;
            border-radius: 20px;
            margin-bottom: 10px;
        }
        .thumbnails_img{
            width: 360px;
            height: 220px;
            border-radius: 15px;
            margin-right: 10px;
            display: inline-block;
        }
        .thumbnails_img_home{
            width: 360px;
            height: 220px;
            border-radius: 15px;
        }
        .serch_results_bar{
            display: inline-block;
            margin-left: 10px;
        }
        .title{
            display: block;
            color: white;
            padding-top: 20px;
            width: 100%;
            font-size: 20px;
            font-weight: bold;
        }
        .title_home{
            display: block;
            color: white;
            padding-top: 5px;
            width: 90%;
            font-size: 15px;
            font-weight: bold;
        }
        .dec{
            display: block;
            color: #Cececf;
            font-size: 10px;
        }
        .video-publish-time{
            color: #Cececf;
            font-size: 10px;
        }
        .channel_name{
            color: #Cececf;
            font-size: 10px;
        }
        .video-publish-time_home{
            color: #Cececf;
            font-size: 10px;
        }
        .channel_name_home{
            color: #Cececf;
            font-size: 10px;
        }
        #serach_bar_input{
            display: inline-block;
            width: 500px;
            height: 40px;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 30px;
            background-color: #1c1c1c;
            color: white;
            border: none;
        }
        #serach_btn{
            display: inline-block;
            background-color: #343535;
            border-radius: 20px;
            height: 40px;
            width: 80px;
            color: white;
            font-weight: bold;
            border: none;
        }
        #Search_div{
            height: 40px;
            width: 585px;
            border-radius: 30px;
            background-color: #1c1c1c;
            color: white;
            border: 1px solid #ccc;
        }
        .home_yt_results{
            display: inline-block;
            margin-left: 20px;
            margin-right: 20px;
            margin-bottom: 10px;
            width: 400px;
        }
        a:link, a:visited, a:hover, a:active{ text-decoration: none; }
    </style>
</head>
<body bgcolor="#1c1c1c">
    <center>
        <div id="Search_div">
            <form method="post">
                <input id="serach_bar_input" type="text" placeholder="Search" name="serach_bar_yt" required>
                <button id="serach_btn" type="submit">Search</button>
            </form>
        </div>
    </center><br>
<?php
if(isset($_POST['serach_bar_yt'])){
    $Serach_Q;
    $Serach_Q_temp = explode(" ",$_POST['serach_bar_yt']);
    $Serach_Q = $Serach_Q_temp[0];
    for($i=1; $i<sizeof($Serach_Q_temp); $i++){
        $Serach_Q = $Serach_Q."%".$Serach_Q_temp[$i];
    }
    $api_key = "AIzaSyAghUJJm7p714ElzMFiayd1kM_te0Uk7-s";
    //$api_key = "AIzaSyAp8yGkCqT9e9p7IzgpE24KGoqLRgNhOg0";
    $base_url = "https://youtube.googleapis.com/youtube/v3/search?part=snippet&";
    $maxResult = "50";
    $Search = $Serach_Q;
    $url = $base_url. "q=".$Search."&maxResults=".$maxResult."&key=".$api_key;
    $data = json_decode(file_get_contents($url), true);
    echo '<div id="search">';
    for($i=0; $i<sizeof($data['items']); $i++){
        $time_temp = explode("T", $data['items'][$i]['snippet']['publishTime']);
        echo '<a href="player.php?videoid='.$data['items'][$i]['id']['videoId'].'&title='.$data['items'][$i]['snippet']['title'].'"><div class="search_result"><img class="thumbnails_img" src="'.$data['items'][$i]['snippet']['thumbnails']['high']['url'].'"><div class="serch_results_bar"><div class="title">'.$data['items'][$i]['snippet']['title'].'</div><p class="video-publish-time">'.$time_temp[0].'</p><br><p class="channel_name">'.$data['items'][$i]['snippet']['channelTitle'].'</p><br><p class="dec">'.$data['items'][$i]['snippet']['description'].'</p></div></div></a>';
    }
    echo '</div>';
}
else {
    $api_key = "AIzaSyAghUJJm7p714ElzMFiayd1kM_te0Uk7-s";
    //$api_key = "AIzaSyAp8yGkCqT9e9p7IzgpE24KGoqLRgNhOg0";
    $base_url = "https://youtube.googleapis.com/youtube/v3/search?part=snippet&";
    $maxResult = "50";
    $Search = "new%south%indian%movie";
    $url = $base_url. "q=".$Search."&maxResults=".$maxResult."&key=".$api_key;
    $responce = json_decode(file_get_contents($url), true);
    echo '<div id="home_yt" style="width: 90%"><div id="home_yt_results">';
    for($i=0; $i<sizeof($responce['items']); $i++){
        $time_temp = explode("T", $responce['items'][$i]['snippet']['publishTime']);
        echo '<a onclick="dec()" href="player.php?videoid='.$responce['items'][$i]['id']['videoId'].'&title='.$responce['items'][$i]['snippet']['title'].'"><div class="home_yt_results"><img class="thumbnails_img_home" src="'.$responce['items'][$i]['snippet']['thumbnails']['high']['url'].'"><div class="title_home">'.$responce['items'][$i]['snippet']['title'].'</div>
        <div class="channel_name_home">'.$responce['items'][$i]['snippet']['channelTitle'].'</div><div class="video-publish-time_home">'.$time_temp[0].'</div></div></a>';
        }
        echo '</div></div>';
}
?>
