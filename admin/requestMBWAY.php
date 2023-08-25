<?php

function requestMbWay($valor, $telemovel,$email,$orderNumber) {
//The url you wish to send the POST request to
$url = "https://www.ifthenpay.com/mbwayws/IfthenPayMBW.asmx/SetPedidoJSON";

//The data you want to send via POST
$fields = [
    'MbWayKey'      => "HCF-242328",
    'Canal' => "03",
    'referencia'         => $orderNumber,
    'valor'         => $valor,
    'nrtlm'         => $telemovel,
    'email'         => $email,
    'descricao'         => 'Pagamento Encomenda Monsuu Store',
];

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

//execute post
$result = curl_exec($ch);
echo $result;
}
?>