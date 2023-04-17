<head>
    <title><?php echo $_GET['title']; ?></title>
     <link rel="icon" type="image/x-icon" href="icon/favicon.ico">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .download_btn{
            border-radius: 30px;
            width: 120px;
            height: 40px;
            background-color: blue;
            color: white;
            border: none;
            margin: 5px;
        }
        a:link, a:visited, a:hover, a:active{ text-decoration: none; }
        #ytplayer{
            border-radius: 8px;
        }
        #center_align{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #player_download{
            color: white;
            background: #474949;
            border-radius: 30px;
            height: 40px;
            width: 100px;
            border: none;
        }
        #dec_player{
            color: #Cececf;
            width: 1000px;
            font-size: 10px;
        }
    </style>
    </head>
    <body bgcolor="#1c1c1c">
    
<?php
if(isset($_GET['videoid'])){
    $videoId = $_GET['videoid'];
    echo '<div id="center_align"><div id=""><iframe id="ytplayer" width="1200" height="640" src="https://www.youtube.com/embed/'.$videoId.'?modestbranding=1&autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe><div id="title"><h2 style="color: white">'.$_GET['title'].'</h2><div style="display: flex; justify-content: right; align-items: right; margin-right: 40px"><button id="player_download">Download</button></div>';
   
    
    
    $curl = curl_init();
    curl_setopt_array($curl, [
    	CURLOPT_URL => "https://youtube-video-download-info.p.rapidapi.com/dl?id=".$videoId,
    	CURLOPT_RETURNTRANSFER => true,
    	CURLOPT_FOLLOWLOCATION => true,
    	CURLOPT_ENCODING => "",
    	CURLOPT_MAXREDIRS => 10,
    	CURLOPT_TIMEOUT => 30,
    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	CURLOPT_CUSTOMREQUEST => "GET",
    	CURLOPT_HTTPHEADER => [
    		"X-RapidAPI-Host: youtube-video-download-info.p.rapidapi.com",
    		"X-RapidAPI-Key: efd0ea72cbmsha0e8e94023c02bdp1f0a62jsn28808a6ebd1b"
    	],
    ]);
    
    $response = json_decode(curl_exec($curl), true);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
    	echo "cURL Error #:" . $err;
    } else {
        $temp_data;
        
    	echo '<h4 id="dec_player">'.$response['description'].'</h4></div></div></div>
        <div id="Download_Windows" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>';
        for($i=0; $i<500; $i++){
            if(isset($response['link'][$i])){
                echo '<a href="'.$response['link'][$i]['0'].'" Download><button class="download_btn">'.$response['link'][$i]['3'].' '.$response['link'][$i]['1'].'</button></a>';
            }
            
        }
        echo '</div></div>';
    }
}
?>
<script>
    var modal = document.getElementById("Download_Windows");
    var btn = document.getElementById("player_download");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
    modal.style.display = "block";
    }
    span.onclick = function() {
    modal.style.display = "none";
    }
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
</script>

