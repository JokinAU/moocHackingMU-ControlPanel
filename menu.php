<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
	<HEAD>
		<META http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<META http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
		<META http-equiv="Pragma" content="no-cache" />
		<META name="robots" content="noarchive" />
		<STYLE type="text/css">
			h3 {
				margin-top: 7px;
				margin-bottom: 1px;
			}
			h4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			ul {
				margin-top: 0px;
				margin-bottom: 0px;
			}
		</STYLE>
		<SCRIPT language="JavaScript" type="text/javascript">
			function getIP() {
				return document.getElementById("serverSelect").value;
			}

			function loadWeb(path, title) {
				var ip=getIP();
				var url='http://' + ip + path;
				top.frames['content'].location.href=url;
				top.frames['title'].document.getElementById("titulo").innerHTML=ip + ' - ' + title;
				return true;
			}

			function loadFTP() {
				var ip=getIP();
				var url='ftp://' + ip + '/';
				top.frames['title'].document.getElementById("titulo").innerHTML=ip + ' - FTP';
				top.frames['content'].location.href=url;
				return true;
			}

			function checkCactiVersion() {
				var ip=getIP();
				var url='cacti-version.php?ip=' + ip;
				top.frames['content'].location.href=url;
				top.frames['title'].document.getElementById("titulo").innerHTML=ip + ' - Check cacti version';
				return true;
			}

			function exploitGitListRCE() {
				var ip=getIP();
				var url='gitlist-rce-inyect.php?ip=' + ip;
				top.frames['title'].document.getElementById("titulo").innerHTML=ip + ' - Exploit RCE';
				top.frames['content'].location.href=url;
				return true;
			}

			function exploitGitListRCECommand() {
				var ip=getIP();
				top.frames['title'].document.getElementById('titulo').innerHTML=ip + ' - GitList RCE run remote shell/get remote GPG files/clean injection';
				top.frames['content'].location.href='gitlist-rce-command.php?ip=' + ip;
				return true;
			}
		</SCRIPT>
	</HEAD>
<BODY leftmargin="0" topmargin="0" marginwidth="0">
	<H3>SERVERS</H3>
	<select id="serverSelect">
<?php
		$servershandle=fopen('resources/servers.txt', 'r');
		if ($servershandle):
			while (($fileline=fgets($servershandle)) !== false):
				$ip=trim($fileline);
				echo '<option value="'.$ip.'">'.$ip.'</option>';
			endwhile;
		
			fclose($servershandle);
		else:
			die('Error opening the server list file');
		endif;
?>
	</select>
	<ul>
		<li><a href="#" title="Victim's main web" OnClick="loadWeb('/', 'Main Web')">Main web</a></li>
	</ul>

	<hr>
	<H4>Cacti</H4>
	<ul>
		<li><a href="#" title="Victim's Cacti site" OnClick="loadWeb('/cacti/', 'Main Web')">Victim's site</a></li>
		<li><a href="http://www.cacti.net/" title="Cacti's official web" target="_blank">Official web</a></li>
		<li><a href="#" title="Check cacti version" OnClick="checkCactiVersion()">Check version</a></li>
	</ul>

	<hr>
	<H4>GitList</H4>
	<ul>
		<li><a href="#" title="Victim's GitList site" OnClick="loadWeb('/gitlist/', 'GitList')">Victim's site</a></li>
		<li><a href="http://gitlist.org/" title="GitList's official web" target="_blank">Official web</a></li>
		<li>RCE Exploit
			<ul>
				<li><a href="http://hatriot.github.io/blog/2014/06/29/gitlist-rce/" title="RCE Exploit web" target="_blank">Official web</a></li>
				<li><a href="#" title="Inject client/run remote commands..." OnClick="exploitGitListRCECommand()">Exploit panel</a></li>
			</ul>
		</li>
	</ul>

	<hr>
	<H4>FTP</H4>
	<ul>
		<li><a href="#" title="Victim's FTP site" OnClick="loadFTP()">Victim's site</a></li>
	</ul>
</BODY>
</HTML>