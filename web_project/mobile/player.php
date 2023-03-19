<head>
    <title><?php echo $_GET['title']; ?></title>
    <style>
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
        
    	echo '<h4 id="dec_player">'.$response['description'].'</h4></div></div></div>';
    }
}
?>

