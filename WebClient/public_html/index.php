<?php
function proCHECK() { return TRUE; }
include("path.php");
include(pathrel."client-ps/config/config.php");
include(pathprivate."includes/clientLIB.php");
$_SESSION = initSession($_SESSION);
$_SESSION = agentSession($_SESSION,$_SERVER['HTTP_USER_AGENT']);
if (!isset($_SESSION['securethis'])) {
	$itx['securethis']=md5(uniqid(rand(), true));
	$_SESSION['securethis'] = $itx['securethis'];
}
define("securethis",$_SESSION['securethis']);
$itx['get'] = safeGet($_GET);
define("unixtime",time());
define("ip",$_SERVER["REMOTE_ADDR"]);
define("prettytime",getPrettyTime(unixtime,"GMT"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo siteNAME." - ".siteMOTTO; ?></title>
<meta name="keywords" content="<?php echo siteKEYWORDS; ?>">
<meta name="description" content="<?php echo siteMETADESC; ?>">
<meta name="author" content="<?php echo siteMETAAUTHOR; ?>">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main-style-index.css" rel="stylesheet" type="text/localization/english_US/css" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Jura' rel='stylesheet' type='text/css'>
<script src="jsAssets/jquery.min.js"></script>
<script src="jsAssets/jquery.playlist.js"></script>
<script src="jsAssets/fancywebsocket.js"></script>
<script src="jsAssets/fNode.js/fooStockCanvas.js"></script>
<script src="jsAssets/fNode.js/fooDHTML.js"></script>
<script src="jsAssets/three/three.min.js"></script>
<script src="jsAssets/three/js/stats.min.js"></script>
<script src="jsAssets/three/js/controls/FirstPersonControls.js"></script>
<script src="jsAssets/three/js/Detector.js"></script>
<script src="jsAssets/fNode.js/fooWebSocket.js"></script>
<script src="jsAssets/fNode.js/fooSYS.js"></script>

<script>
var audioINDEX = 0;
var audioARRAY = new array('376737_Skullbeatz___Bad_Cat_Maste.ogg','358232_j_s_song.ogg');
var USERname = '';
var USERpass = '';
var USERsessionKEY = '<?php echo securethis; ?>';
var ensSERVERip = '<?php echo ensSERVERip; ?>';
var ensSERVERport = '<?php echo ensSERVERport; ?>';
var ensSERVERdomain = '<?php echo ensSERVERdomain; ?>';
var assetSERVERip = '<?php echo assetSERVERip; ?>';
var assetSERVERport = '<?php echo assetSERVERport; ?>';
var assetSERVERdomain = '<?php echo assetSERVERdomain; ?>';
var nodeSERVERip = '';
var nodeSERVERport = '';
var nodeSERVERdomain = '';
var comKEY = '<?php echo comKEY; ?>';
var audioPlayer = document.getElementById('audioPLAYER');

function setAudioVolume(x) {
document.getElementById('audioPLAYER').volume=x;

}

</script> 

</head>
<body id="n0" onload="showSignInObject();setAudioVolume('0.5');">
<div id="container"></div>
<script>


    var camera, scene, renderer;
    var mesh;

    init();
    animate();



</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('audio').playlistParser();
    });
</script>
<audio src="http://<?php echo assetSERVERdomain; ?>/assets/sounds/376737_Skullbeatz___Bad_Cat_Maste.ogg" id="audioPLAYER" controls autoplay  preload="auto" style="visibility: hidden; height: 0px;">
</audio>
<div id="chat" class="chat" style="width: 100%; margin-bottom: 10%; visibility: hidden;">
<div style="visibility: hidden;z-index: 3; bottom: 100px; margin-left: 10%; width: 400px; height: 400px; position: absolute; background-color:rgba(80,80,80,0.5); color: #efefef;" id='log' name='log' readonly='readonly'></div><br/>
<input style="visibility: hidden;color: #000; z-index: 3; margin-right: 10%; bottom: 70px; position: absolute; margin-left: 10%; height: 15px; width: 390px;" type='text' id='message' name='message' />
</div>
<div id="toolbar" class="toolbar" style="z-index: 3; background-color: #313f49; position: fixed; padding:4px; width:100%; bottom: 0px; visibility: visible;">
<input type="image" src="media/textures/5050t.png" style="background-image: url('media/textures/icons.png'); background-position: -2.25px 291.75px; width: 48px; height: 48px; vertical-align: middle;" id="web" class="web" />
<input type="image" src="media/textures/5050t.png" style="background-image: url('media/textures/icons.png'); background-position: 196.0px 147.75px; width: 48px; height: 48px; vertical-align: middle;" id="web" class="web" />
<input type="image" src="media/textures/5050t.png" style="background-image: url('media/textures/icons.png'); background-position: 196.0px 387.75px; width: 48px; height: 48px; vertical-align: middle;" id="web" class="web" />
<input type="image" src="media/textures/5050t.png" style="background-image: url('media/textures/icons.png'); background-position: 69.5% 90.25%; width: 50px; height: 48px; vertical-align: middle;" id="web" class="web" />
    <input id="addressBar" type="text" class="addressBar" length="300" maxlength="600" style="margin-left: 30px; width: 500px; height: 20px; vertical-align: middle;"/>
</div>
<div id="n2" style="visibility: hidden; opacity: 0.7; background-color:#000; z-index: 4; width: 100%; height: 100%; position: fixed;top:0;bottom:0;left:0;right:0;margin:auto;">&nbsp;</div>
<div id="n3" style="padding: 18px; opacity: 0.7; visibility: hidden; background-color:#00B2EE; z-index: 5; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;">
&nbsp;
</div>
<div id="n4" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;">

    <h1><?php echo siteNAME." - ".siteMOTTO; ?></h1>
<h2 >Login/Register</h2>
<a href="#" onclick="showInlineObject('registerINLINE');" style="color: #afafaf;">Register for an Account</a>
<div id="registerINLINE" style="visibility: hidden; height:0px; overflow: hidden;" >
<form action="#" >
<span style="font-size: 75%;"><a href="#" onclick="hideInlineObject('registerINLINE');">(close)</a></span>
<input type="text" id="regusername" maxlength=255 style="margin-right: 10%; margin-left: 10%; width: 80%; border: solid 1px #fff; background-color:rgba(0,0,0,0.3); color: #fff;" />
<input type="password" id="regpassword1" maxlength=255 style="margin-right: 10%; margin-left: 10%; width: 80%; border: solid 1px #fff; background-color:rgba(0,0,0,0.3); color: #fff;" />
<input type="password" id="regpassword2" maxlength=255 style="margin-right: 10%; margin-left: 10%; width: 80%; border: solid 1px #fff; background-color:rgba(0,0,0,0.3); color: #fff;" />
<input type="image" src="media/textures/5050t.png" style="margin-top: 18px; margin-right: 10%;float: right;background-image: url('media/textures/icons.png'); background-position: -4.5px 387.5px; width: 47px; height: 47px;"  class="web" onclick="fooWSRegister();"/>
</form>
</div>
<form method="post" action="auth.php">
<input type="hidden" id="loadTOKEN" name="loadTOKEN" value="<?php echo loadTOKEN; ?>" />
<h3>Username:</h3>
<input type="text"  id="loginUSER" name="loginUSER" maxlength=255 style="margin-right: 10%; margin-left: 10%; width: 80%; border: solid 1px #fff; background-color:rgba(0,0,0,0.3); color: #fff;" />
<h3>Password:</h3>
<input type="password"  id="loginPASSWORD" name="loginPASSWORD" maxlength=255 style="margin-right: 10%; margin-left: 10%; width: 80%; border: solid 1px #fff; background-color:rgba(0,0,0,0.3); color: #fff;" />
<input type="image" src="media/textures/5050t.png" style="margin-top: 18px; margin-right: 10%;float: right;background-image: url('media/textures/icons.png'); background-position: -4.5px 387.5px; width: 47px; height: 47px;" id="loginSUBMIT" class="web" />
</form>
<div id="sysmessage" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n20" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n21" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n22" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n23" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n24" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n25" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n26" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n27" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n28" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n29" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>
    <div id="n30" style="color: #fff; font-weight: bold; padding: 18px; visibility: hidden; background-color:rgba(0,0,0,0.0); z-index: 6; width: 600px; height: 450px; position: fixed; top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></div>

</div>
</body>
</html>
