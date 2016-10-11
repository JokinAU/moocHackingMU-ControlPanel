<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD></HEAD>
<BODY>
<H3>Comprobando sub-versiones de 0.8.8</H3>
<?php
function checkVersion($version, $url) {
	global $probable;
	$heads=get_headers($url, 1);
	echo "Version $version: $heads[0]<br />\n";
	if (strcmp($heads[0],'HTTP/1.1 200 OK')==0):
		$probable=$version;
	endif;
}

$ip=$_REQUEST['ip'];
$probable='0';

checkVersion('a',"http://$ip/cacti/install/0_8_8_to_0_8_8a.php");
checkVersion('b',"http://$ip/cacti/install/0_8_8a_to_0_8_8b.php");
checkVersion('c',"http://$ip/cacti/install/0_8_8b_to_0_8_8c.php");
checkVersion('d',"http://$ip/cacti/install/0_8_8c_to_0_8_8d.php");
checkVersion('e',"http://$ip/cacti/install/0_8_8d_to_0_8_8e.php");
checkVersion('f',"http://$ip/cacti/install/0_8_8e_to_0_8_8f.php");
checkVersion('g',"http://$ip/cacti/install/0_8_8f_to_0_8_8g.php");
checkVersion('h',"http://$ip/cacti/install/0_8_8g_to_0_8_8h.php");

if (strcmp($probable,'0')==0):
	echo "<H2>Error comprobando la versi&oacute;n</H2>\n";
else:
	echo "<H2>La versi&oacute;n probable es la 0.8.8$probable</H2>\n";
endif;
?>
</BODY>
</HTML>