<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

//$to = 'to@example.com';
$to = 'oki2a24@gmail.com';
$subject = "テスト"; // 題名
$body = "これはテストです。\n"; // 本文
//$from = "xxxxxx@example.com";
$from = "xxxxxx@oki2a24.com";
$header = "From: $from\nReply-To: $from\n";

$ret =  mb_send_mail($to, $subject, $body, $header);
var_export($ret);

