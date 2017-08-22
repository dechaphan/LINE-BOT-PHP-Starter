<?php
$access_token = 'bf8thJdpUeyrq+7itXGC1jil3JZ3KQ2bmPUOw0rWSEpzJITvOyyVMjI/M/lBYp///vzRUpI6L2e9ubC01+qPs0Epor2PI0SZBwsf1W72rdomM+ETSa8lJMq/ekDUcsxwf0cvnUvXue4ln1ymRz6NyAdB04t89/1O/w1cDnyilFU=';
$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:8GxkUEXnPKM7dGj';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
            if($event['message']['text'] == "แฟนชื่อ"){
                $text = "พี่โต้ง";
            }else if($event['message']['text'] == "แฟนพี่โต้งชื่อ"){
                $text = "น้องนก";
            }else if($event['message']['text'] == "แล้วก็"){
                $text = "นอนหลับฝันดี ราตรีสวัสดิ์ รักน่ะ จุ๊บๆๆ";
            }else if($event['message']['text'] == "รักหนูไหม"){
                $text = "รักๆ";
            }else if($event['message']['text'] == "good night"){
                $text = "ฝันดีครับ คนสวย";
            }else if($event['message']['text'] == "สวัสดี"){
                $text = "สวัสดี ID คุณคือ ".$event['source']['userId'];
            }else if($event['message']['text']== "ชื่ออะไร"){
                $text = "ฉันยังไม่มีชื่อนะ";
            }else if($event['message']['text']== "ทำอะไรได้บ้าง"){
                $text = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
            }else{
                $text = "ฉันไม่เข้าใจคำสั่ง ".$event['message']['text'];
            }

			//$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";

