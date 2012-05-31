<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta name="author" content="Till">
<meta name="editor" content="html-editor phase 5">
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<?php
echo "Was wir über dich wissen..:";
echo "<br> Angesprochener Server: ";
$host = $_SERVER["HTTP_HOST"];
$referer = $_SERVER["REFERER"];
$agent = $_SERVER["HTTP_USER_AGENT"];
$addr =$_SERVER["REMOTE_ADDR"];
echo $host;
//echo "<br>";
echo $referer;
echo "<br> Dein System: ";
echo $agent;
echo "<br> Deine IP Addresse: ";
echo $addr;
echo "<br>... und noch viel mehr - klick hier";
?>
</body>
</html>