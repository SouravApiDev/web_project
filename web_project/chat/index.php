<html>
    <head>
        <link rel="icon" type="image/x-icon" href="icon/favicon.ico">
        <title><?php echo("Chat-Bot: ".date('l'));?></title>
        
<?php
    function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    if(isMobile()){
        echo '<link rel="stylesheet" href="Mobile_style.css">';
    }
    else{
        echo '<link rel="stylesheet" href="Desktop_style.css">';
    }
?>
        <script>
            function loadingActive(){
                document.getElementById('loading').style = "display: flex";
            }
            function loadingDeActive(){
                document.getElementById('loading').style = "display: none";
            }
        </script>
        <meta name="viewport" content="user-scalable=no;user-scalable=0;"/>
    </head>
    <body>
        
        <div id="answer_part_st1">
            <div id="answer_part_st2">
                <div id="ans">
                    <div id="loading"><img id="loding_img"></div>
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
                               $result_S = explode("```", $result);
                               $result_SS = $result_S[0];
                               $temp_int=false;
                               for($i=1; $i<sizeof($result_S); $i++){
                                   if($temp_int==false){
                                       $result_SS = $result_SS.'<div class="shadow">'.$result_S[$i];
                                       $temp_int = true;
                                   }
                                   else if($temp_int==true){
                                       $result_SS = $result_SS.'</div>'.$result_S[$i];
                                       $temp_int = true;
                                   }
                               }
                               
                               if($_POST['question']!=""){
                                   print_f($result_SS);
                               }
                               else{
                                   print_f("Server_error");
                               }
                            }
                            else{
                                print_f("<br><br><h2>Hi,</h2> <h4><br>I'm Chat-Bot, your creative and helpful collaborator. I have limitations and won't always get it right, but your feedback will help me to improve Develop By Sourav.</h4><h6><br> Not sure where to start? You can try: .</h6><br><br><br>");
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
                <input type="text" id="input_question_field" name="question" placeholder="Enter question here" onfocus="return false" required>
                <input id="send_btn" type="submit" value="Send">
            </form>
        </div>
    </body>
</html>
