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
        echo "Train Name:-".$data["0"]["display"];
        echo "<br><br>Sourace Name:-".$data["0"]["source_name"];
        echo "<br><br>Destination Name:-".$data["0"]["destination_name"];

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //$dd = var_dump(json_decode($response));
           // echo $data["0"]["display"];
        }
}
?>