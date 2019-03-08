<?php
//session_start();

include_once("actoken.php");

$paypal= new MyPayPal();   

$token=$paypal->token();

$orderID=json_decode(htmlspecialchars_decode($_POST['orderID']),true);

//$orderID = $_POST["orderID"];
//echo $orderID;


$endpoint = "https://api.sandbox.paypal.com/v2/checkout/orders/"."$orderID"."/capture";

//$post_data = array (
//  'payer_id' => $PayerID,
//);

//var_dump ($post_data); 

$ch = curl_init();
      
      curl_setopt($ch, CURLOPT_URL, $endpoint);

      curl_setopt($ch, CURLOPT_VERBOSE, 1);
    
      // Turn off the server and peer verification (TrustManager Concept).
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
  
      // Set the request as a POST FIELD for curl.
      //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/json",
          "Authorization: Bearer".' '.$token["access_token"],
          ));
      $httpResponse = curl_exec($ch);

      //$_SESSION["httpResponse"]=$httpResponse;

      //echo $_SESSION["httpResponse"];

      print_r($httpResponse);

