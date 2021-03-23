<?php
include "func_flash.php";


session_start();
if(isset($_POST['citi_name']) && !empty($_POST['citi_name'])){
    $myCity = $_POST['citi_name'];
    $tempType = $_POST['tempType'];


}else{

    $myCity ="Yerevan";
}
$tempType = 'metric';
$myKey = "08f300df584372b0c9c6f153b3c2bf7c" ;
$ch = curl_init('api.openweathermap.org/data/2.5/weather?q='.$myCity.'&appid='.$myKey.'&&units='.$tempType.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$response_Json = curl_exec($ch);
curl_close($ch);
$result = json_decode($response_Json,true);
if(isset($result['message'])){
    setError('error' , "Citi not Found");
    header("location:comments.php");
}
else {
    $temp = $result['main']['temp'];
    $_SESSION['temp'] = $temp;
    header("location:comments.php");

}







