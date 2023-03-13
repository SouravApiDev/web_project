<html>
    <head>
      <title>My Page Title</title>
      <link rel="icon" type="image/x-icon" href="icon/favicon.ico">
      <link rel="stylesheet" href="styles.css">
      <style>
          .train_search_bar_bg{
           background-image: linear-gradient(30deg, red, yellow);
            width: 1350px;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 5%;
            margin-left: 5%;
            border-radius: 50px;
        }
        .train_search_bar{
            width: 900px;
            height: 60px;
            border-radius: 60px;
            border: none;
            padding-left: 20px;
            font-size: 15px;
        }
        .train_GET_INFO{
            background-color: blue;
            height: 60px;
            width: 120px;
            border-radius: 50px;
            border: none;
            border-color: blue;
            color: white;
            display: inline-block;
            font-size: 15px;
            margin-left: 8px;
        }
        .train_data_bar{
            background-image: linear-gradient(30deg, red, blue);
            width: 720px;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25%;
            margin-left: 25%;
            border-radius: 50px;
            margin-bottom: 10px;
        }
        .scroll_bar_train_info{
            overflow-y: auto;
            height: 450px;
        }
        .example::-webkit-scrollbar {
            display: none;
        }

        
      </style>
    </head>
    <body><div class="data1"></div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="train_search_bar_bg">
                <input class="train_search_bar" type="text" name="train_number" placeholder="Train Number/Train Name" required><br>
                <input class="train_GET_INFO" type="submit" name="SUB" value="GET INFO">
            </div>
        </form>
    <div class="scroll_bar_train_info">

<?php
if(isset($_POST["SUB"])){
        $number = $_POST["train_number"];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://indian-railway-irctc.p.rapidapi.com/getTrainId?trainno=".$number."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: indian-railway-irctc.p.rapidapi.com",
                "X-RapidAPI-Key: efd0ea72cbmsha0e8e94023c02bdp1f0a62jsn28808a6ebd1b"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $data = json_decode($response, true);
        

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            for($i=0; $i<sizeof($data); $i++){
                echo '<div class="train_data_bar"><div id="temp_train_data_bar"><h2 style="color: white">Train Name:-'.$data[$i]["display"].'</h3>';
                echo '<h4 style="color: white">Sourace Name:-'.$data[$i]["source_name"];
                echo '<br>Destination Name:-'.$data[$i]["destination_name"].'</h4></div></div>';
            }
        }
}
?>
</div>
</body>
</html>