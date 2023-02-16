<?php
$curl=$curl_init();
$requesttype='GET';
$url='https://www.imdb.com/chart/boxoffice';

curl_setopt_array($curl,[
	CURLOPT_URL=>$url,
	CURLOPT_CUSTOMREQUEST=>$requesttype,
    CURLOPT_TIMEOUT=>30
]);
$response=curl_exec($curl);
curl_close($curl);
echo $response;
?>