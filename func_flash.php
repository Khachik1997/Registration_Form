<?php

function setFlash($key, $val)
{
    $_SESSION[$key] = $val;
}

function getFlash($key)
{
    if (isset($_SESSION[$key])) {
        echo $_SESSION[$key];
        unset($_SESSION[$key]);
    }
}


function getWeather()
{
    require "open_connection.php";
    $query = "SELECT * FROM temp";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($result);

    if (!isset($data)) {
        return setWeather();
    } else {
        date_default_timezone_set("Asia/Yerevan");
        $seconds = (30 * 60); //30 minute
        $created_at = strtotime(date($data['created_at']));
        if((time() -  $created_at > $seconds )){
            return updateWeather();
        }else{
            return $data['temperature'];
        }
    }
}


function getTemperature(){
    $myCity = "Yerevan";
    $myKey = "08f300df584372b0c9c6f153b3c2bf7c";
    $ch = curl_init('api.openweathermap.org/data/2.5/weather?q=' . $myCity . '&appid=' . $myKey . '&units=metric');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_Json = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response_Json, true);
    return $result['main']['temp'];
}

function setWeather(){
    require "open_connection.php";
    $temperature = getTemperature();
    $sql = "INSERT INTO temp (temperature) VALUES ('$temperature')";

    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        return $temperature;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

function updateWeather(){
    require "open_connection.php";
    $temperature = getTemperature();
    $currentDate = date("Y-m-d H:i:s");
    $sql = "UPDATE temp SET temperature='$temperature', created_at='$currentDate' WHERE id=1";

    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        return $temperature;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}





