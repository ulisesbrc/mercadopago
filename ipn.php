<?php header("HTTP/1.1 200 OK");
$notifications=file_get_contents("php://input");

@mail('ulises4@gmail.com', 'webhooks '.date('h:i:s'), $notifications);
if (isset($_GET["id"]) and isset($_GET["topic"])) {
	require __DIR__ .  '/vendor/autoload.php';
	$token = '';
	MercadoPago\SDK::setAccessToken($token);
	MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");
	$url = "https://api.mercadopago.com/v1/payments/".$_GET["id"]."?access_token=$token";
	$handle = curl_init($url);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($handle, CURLOPT_URL, $url); 
	$result = curl_exec($handle);
	//$datos = json_decode($result);
	mail('ulises4@gmail.com', 'JSON '.date('h:i:s'), "Id:".$_GET["id"]." -- ".$result);
}
