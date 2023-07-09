<html>
    <head>
        <title>bard api</title>
        <style>
            body{
                background: black;
            }
            ::-webkit-scrollbar {
                display: none;
            }
            #answer_part_st1{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            #answer_part_st2{
                background: #232323;
                width: 90%;
                margin-top: 20px;
                height: 600px;
                border-radius: 30px;
            }
            #ans{
                height: 575px;
                color: white;
                margin-top: 8px;
                margin-left: 20px;
                margin-right: 20px;
                overflow-y: scroll;
            }
            #input_question{
                display: flex;
                justify-content: center;
                align-content: center;
            }
            #input_question_field{
                width: 1200px;
                height: 40px;
                border-radius: 20px;
                color: white;
                background: black;
                border: 2px solid white;
                border-color: white;
                padding-left: 20px;
            }
            #send_btn{
                width: 100px;
                height: 40px;
                background: #232323;
                color: white;
                border-color: white;
                border: 2px solid white;
                border-radius: 30px;
            }
            .ans_result{
                background: #161616;
                border-radius: 20px;
                padding-right: 20px;
                padding-left: 20px;
                padding-top: 10px;
                padding-bottom: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            #loading{
                display: none;
                justify-content: center;
                align-content: center;
                margin-top: 100px;
            }
        </style>
        <script>
            function loadingActive(){
                document.getElementById('loading').style = "display: flex";
            }
            function loadingDeActive(){
                document.getElementById('loading').style = "display: none";
            }
        </script>
    </head>
    <body>
        <div id="answer_part_st1">
            <div id="answer_part_st2">
                <div id="ans">
                    <div id="loading"><img src="icon/loading2.gif" style="border-radius: 360px; width: 480px; height: 360px"></div>
                        <?php
                            if(isset($_POST['question'])){
                                print_f($_POST['question']);
                                $temp_search_array=explode(" ", $_POST['question']);
                                $temp_search=$temp_search_array[0];
                                for($i=1; $i<sizeof($temp_search_array); $i++){
                                    $temp_search=$temp_search."%".$temp_search_array[$i];
                                }
                               //$response = shell_exec("python bard_api.py " .$temp_search);
                               $response = file_get_contents('https://rizgigho.pythonanywhere.com/souravapi?q='.$temp_search);
                               $res = explode("\n", $response);
                               $result = $res[0];
                               for($i=1; $i<sizeof($res); $i++){
                                   $result = $result.'<br>'.$res[$i];
                               }
                               /*$result_S = explode("```", $result);
                               $result_SS = $result_S[0];
                               for($i=1; $i<sizeof($result_S); $i++){
                                   $result_SS = $result_SS.'<div class="shadow">'.$result_S[$i].'</div>';
                               }*/
                               if($_POST['question']!=""){
                                   print_f($result);
                               }
                               else{
                                   print_f("Server_error");
                               }
                            }
                            function print_f($data){
                                echo '<script>loadingDeActive();</script>';
                                echo '<div class="ans_result">'.$data.'</div>';
                            }
                        ?>
                </div>
            </div>
        </div>
        <br>
        <div id="input_question">
            <form method="post" onsubmit="loadingActive()">
                <input type="text" id="input_question_field" name="question" required>
                <input id="send_btn" type="submit" value="Send">
            </form>
        </div>
    </body>
</html>
