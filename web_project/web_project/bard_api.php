<html>
    <head>
        <title>bard api</title>
        <style>
            body{
                background: black;
            }
            /*.shadow {
                background: -webkit-gradient(linear, left top, left bottom, from(#B41D1D), to(#036CFB));
                background: -moz-linear-gradient(top, #950095, #3E00FF);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#ffffff');
                border-radius: 30px;
            }*/
            ::-webkit-scrollbar {
                display: none;  /* Safari and Chrome */
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
        </style>
    </head>
    <body>
        <div id="answer_part_st1">
            <div id="answer_part_st2">
                <div id="ans">
                        <?php
                            if(isset($_POST['question'])){
                                print_f($_POST['question']);
                                $temp_search_array=explode(" ", $_POST['question']);
                                $temp_search=$temp_search_array[0];
                                for($i=1; $i<sizeof($temp_search_array); $i++){
                                    $temp_search=$temp_search."%".$temp_search_array[$i];
                                }
                               $response = shell_exec("python bard_api.py " .$temp_search);
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
                                echo '<div class="ans_result">'.$data.'</div>';
                            }
                        ?>
                </div>
            </div>
        </div>
        <br>
        <div id="input_question">
            <form method="post">
                <input type="text" id="input_question_field" name="question" required>
                <input id="send_btn" type="submit" value="Send">
            </form>
        </div>
    </body>
</html>
