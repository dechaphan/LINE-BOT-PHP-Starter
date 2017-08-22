<?php
$access_token = 'bf8thJdpUeyrq+7itXGC1jil3JZ3KQ2bmPUOw0rWSEpzJITvOyyVMjI/M/lBYp///vzRUpI6L2e9ubC01+qPs0Epor2PI0SZBwsf1W72rdomM+ETSa8lJMq/ekDUcsxwf0cvnUvXue4ln1ymRz6NyAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
