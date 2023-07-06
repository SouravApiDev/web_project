<?php include 'menu_bar.php';?>
<head>
    <title><?php echo("Index ".date('l'));?></title>
    <style>
        .error_window{
           background-image: linear-gradient(36deg, red, blue);
            width: 560px;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 60px; 
        }
        .youtube_linkbar {
            background-image: linear-gradient(30deg, red, yellow);
            width: 1350px;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
        }
        .yt_url_link_bar{
            width: 900px;
            height: 40px;
            border-radius: 30px;
            display: inline-block;
            border: none;
            padding-left: 20px;
        }
        .get_button{
            background-color: blue;
            height: 40px;
            width: 100px;
            border-radius: 50px;
            border: none;
            border-color: blue;
            color: white;
            display: inline-block;
            font-size: 15px;
        }
        .yt_ch_selector{
            display: inline-block;
            border-radius: 45px;
            width: 90px;
            height: 40px;
            text-align: center;
            font-size: 15px;
        }
        .image_thumbnail{
            height: 320px;
            width: 560px;
            border-radius: 45px;
        }
        .yt_title{
            justify-content: center;
            text-align: center;
        }
        .Download_btn{
            background-color: blue;
            height: 40px;
            border-radius: 50px;
            border: none;
            border-color: blue;
            color: white;
            display: inline-block;
            font-size: 15px;
            margin: 2px;
        }
        .download_btn_list{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mute_icon{
            height: 20px;
            width: 20px;
            margin-left: 8px;
        }
        #loading_bar{
            display: none;
            align-items: center;
            justify-content: center;
        }
        .center_mo{
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<div class="center_mo">
    <div class="youtube_linkbar">
        <form method="post" onsubmit="loading()" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input class="yt_url_link_bar" type="text" name="yt_url_link" placeholder="https://www.youtube.com/watch?v=Example" pattern="https://.*" required>
                <select class="yt_ch_selector" name="format">
                  <option value="Video">Video</option>
                  <option value="Audio">Audio</option>
                </select>
                <input class="get_button" type="submit" name="submit_link" value="Download">
        </form>
    </div>
</div>
<br>
<div id="loading_bar">
    <img src="icon/loading.gif">
</div>
<script>
    function loading(){
        document.getElementById("loading_bar").style ="display : flex";
    }
</script>
<?php
    if(isset($_POST['yt_url_link'])&&$_POST['yt_url_link'] != ""){
        $data = shell_exec("python youtube_api.py " .$_POST['yt_url_link']);
        $decord = json_decode($data, true);
        if($decord != ""){
        echo '<div class="yt_title">'.$decord["title"].'</div><br><div class="center_mo"><img class="image_thumbnail" src="'.$decord["thumbnail"].'"></div><br><br><div class="download_btn_list"><div class="center_align_download_btn">';
        if($_POST['format']=="Video"){
            
            for($i=0; $i<sizeof($decord['videos_url']['formats']); $i++){
                if($decord['videos_url']['formats'][$i]['qualityLabel'] !="144p"){
                echo '<a href="'.$decord['videos_url']['formats'][$i]['url'].'&title='.$decord["title"].'"><button class="Download_btn" style="width: 120px" type="button">'.$decord['videos_url']['formats'][$i]['qualityLabel'].' Fps:'.$decord['videos_url']['formats'][$i]['fps'].'</button></a><br>';
                }
            }
            
            for($i=0; $i<sizeof($decord['videos_url']['adaptiveFormats']); $i++){
                $data = str_split($decord['videos_url']['adaptiveFormats'][$i]['mimeType']);
                if($data[0] == "v"&&$v_not_rep != $decord['videos_url']['adaptiveFormats'][$i]['qualityLabel']){
                    echo '<a href="'.$decord['videos_url']['adaptiveFormats'][$i]['url'].'&title='.$decord["title"].'"><button class="Download_btn" style="width: 160px" type="button">'.$decord['videos_url']['adaptiveFormats'][$i]['qualityLabel'].' Fps:'.$decord['videos_url']['adaptiveFormats'][$i]['fps'].'<img class="mute_icon" src="icon/mute.png"></button></a><br>';
                    $v_not_rep = $decord['videos_url']['adaptiveFormats'][$i]['qualityLabel'];
                }
            }
        }
        elseif ($_POST['format']=="Audio") {
            for($i=0; $i<sizeof($decord['videos_url']['adaptiveFormats']); $i++){
                $audio_q = explode("_",$decord['videos_url']['adaptiveFormats'][$i]['audioQuality']);
                $data = str_split($decord['videos_url']['adaptiveFormats'][$i]['mimeType']);
                if($data[0] == "a"||$v_not_rep != $audio_q[2]){
                    echo '<a href="'.$decord['videos_url']['adaptiveFormats'][$i]['url'].'&title='.$decord["title"].'"><button class="Download_btn" style="width: 150px" type="button">'.$audio_q[2].' Bitrate:'.floatval($decord['videos_url']['adaptiveFormats'][$i]['bitrate'])/1000.0.'khz</button></a><br>';
                    $v_not_rep = $audio_q[2];
                }
            }
        }
        }
        else{
            echo '<div class="center_mo"><div class="error_window"><div id="error_404"><center><h1 style="color: white">Please Enter Correct Link</h1></center><center><h4 style="color: white">https://www.youtube.com/watch?v=example</h4></center><center><h2 style="color: white">OR</h2></center><center><h4 style="color: white">https://youtu.be/example</h4></center></div></div></div>';
        }
    }
?>
</div>
</div>
</body>
</html>