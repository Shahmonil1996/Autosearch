<?php
$original = 123;
$secure = rand(100,999).base64_encode($original).rand(100,999);
echo $secure."<br>";
$unsecure = substr($secure,3);
$length=strlen($unsecure);
$unsecure = substr($unsecure,-$length,$length-3);
$unsecure = base64_decode($unsecure);
echo $unsecure; // will display 123
?>