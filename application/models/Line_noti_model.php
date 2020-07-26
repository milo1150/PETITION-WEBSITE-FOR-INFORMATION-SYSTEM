<?php
Class Line_noti_model extends CI_Model {
    function line_noti($str){
        $token = "iMzEdYiD7Obes96oF92sqyngrJ0AWSTwJPUfT6h7Wng";
        // $token = "do0NI5DOV0X6mX0YPuXly6RarhLqdDZNpcolRPst3Pm";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://notify-api.line.me/api/notify",
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "message=".$str,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token,
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);      
        //echo $response;  
        return $response;
    }










}



?>