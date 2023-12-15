<?php

$url = "https://absen.madiunkab.go.id/index.php/service";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Content-Type: application/json",
    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 11; Galaxy S7 Build/RQ1A.210105.003)"
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "jsonrpc":2,
  "filter":1,
  "method":"POST",
  "object":"login",
  "param":
  	{
  		"email":"3519100306970001",
      	"password":"Jack03061997",
      	"latlong":"0,0",
      	"imei":"3be18a532c24ade2"
  	}
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
