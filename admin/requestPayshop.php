<?php

function generatePayshop($valor, $limite, $orderNumber) {
// API URL
$url = 'https://ifthenpay.com/api/payshop/sandbox/';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST

$payload = json_encode(array(
    'payshopkey' => 'GKK-943760', 
    'id' => $orderNumber,
    'valor' => $valor,
    'validade' => $limite,));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);
$result  = json_decode($result, TRUE);

//$array =$result;
$_SESSION['refPayshop']['Reference'] = $result['Reference'];

//echo$result;
// Close cURL resource
curl_close($ch);



}


//generatePayshop("20", "20210226");
//echo($_SESSION['refPayshop']['Reference'])
?>