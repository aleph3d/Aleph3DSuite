<?php

//MySQL Query Database
function myquery($query) {
	mysql_connect(dbhost, dbuser, dbpass);
	mysql_select_db(dbname);
	$result = mysql_query($query);
	if (!mysql_errno() && @mysql_num_rows($result) > 0) {
}
else {
$result="not";
}
	mysql_close();
	return $result;
}
// MySQL Execute Batch Query
function mybatchquery ($str) {
$str2 = explode("\n",$str);
$str3 = "";
$xx = 0;
while(isset($str2[$xx])) {
if(preg_match("/(.)*insert(.)+/",$str2[$xx]) OR preg_match("/(.)*DROP(.)+/",$str2[$xx]) OR preg_match("/(.)*CREATE(.)+/",$str2[$xx])) {
$str3 = $str3.$str2[$xx];
} else {
$str2[$xx] = preg_replace("/(\p{Zs}|\040|\w)*\/\*(\p{Zs}|\040|\w)+`(\p{Zs}|\040|\w|-)+`(\p{Zs}|\040|\w)* \*\//","",$str2[$xx]);
$str3 = $str3.$str2[$xx];
}
$xx++;
}
$str4 = explode(";",$str3); 
$x=0;
while (isset($str4[$x])) {
if (preg_match("/insert(\p{Zs}|\040|\w|\W)+/",$str4[$x]) OR preg_match("/DROP(\p{Zs}|\040|\w|\W)+/",$str4[$x]) OR preg_match("/CREATE(\p{Zs}|\040|\w|\W)+/",$str4[$x])) {
myquery($str4[$x]);
}
$x++;
}
return TRUE;
}
// MySQL Num Rows
function myrows($result) {
	$rows = @mysql_num_rows($result);
	return $rows;
}
// MySQL fetch array
function myarray($result) {
	$array = mysql_fetch_array($result);
	return $array;
}
// MySQL escape string
function myescape($query) {
	$escape = mysql_escape_string($query);
	return $escape;
}
//Initilize Session
function initSession($session) {
	if (!isset($session['initiated'])) {
		session_regenerate_id();
		$session['initiated'] = true;
	}
	return $session;
}
//Agent Session
function agentSession($session,$agent) {
	$fingerprint = md5($agent . secretPUBLIC);
	if (isset($session['HTTP_USER_AGENT'])) {
		if ($session['HTTP_USER_AGENT'] != $fingerprint) {
			die();
			exit;
		}
	} else {
		$session['HTTP_USER_AGENT'] = $fingerprint;
	}
	return $session;
}

function mymime($filename){


    $mime_types = array(

        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'docx' => 'application/msword',
        'xlsx' => 'application/vnd.ms-excel',
        'pptx' => 'application/vnd.ms-powerpoint',


        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

    $explode = explode('.',strtolower($filename));
$x = 0;
	while(isset($explode[$x])) {
	$myreturn = $explode[$x];
	$x++;


}
return $myreturn;
}

function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

function safeGet($get) {
	if (isset($get['com']) AND preg_match("/(\w|\-)+/",$get['com'])) {
		$get['com'] = $get['com'];
	}
	else { $get['com'] = "front"; }
	if (isset($get['action']) AND preg_match("/(\w|\-)+/",$get['action'])) {
		$get['action'] = $get['action'];
	}
	else { $get['action'] = "view"; }
	if (isset($get['itemid']) AND preg_match("/\d/",$get['itemid']) AND $get['itemid'] < 18446744073709551615) {
		$get['itemid'] = $get['itemid'];
	}
	else { $get['itemid'] = 0; }
	if (isset($get['id']) AND preg_match("/\d/",$get['id']) AND $get['id'] < 18446744073709551515) {
		$get['id'] = $get['id'];
	}
	else { $get['id'] = 1; }
	if (isset($get['switch']) AND preg_match("/\w/",$get['switch'])) {
		$get['switch'] = $get['switch'];
	}
	else { $get['switch'] = "not"; }
	if (isset($get['skip']) AND preg_match("/\d/",$get['skip']) AND $get['skip'] < 18446744073709551515) {
		$get['skip'] = $get['skip'];
	}
	else { $get['skip'] = 0; }
	if (isset($get['refid']) AND preg_match("/\d/",$get['refid']) AND $get['refid'] < 18446744073709551615) {
		$get['refid'] = $get['refid'];
	}
	else { $get['refid'] = 0; }
if (isset($get['ob1id']) AND preg_match("/\d/",$get['ob1id']) AND $get['ob1id'] < 18446744073709551615) {
		$get['ob1id'] = $get['ob1id'];
	}
	else { $get['ob1id'] = 0; }
if (isset($get['ob2id']) AND preg_match("/\d/",$get['ob2id']) AND $get['ob2id'] < 18446744073709551615) {
		$get['ob2id'] = $get['ob2id'];
	}
	else { $get['ob2id'] = 0; }
	if (isset($get['ob3id']) AND preg_match("/\d/",$get['ob3id']) AND $get['ob3id'] < 18446744073709551615) {
		$get['ob3id'] = $get['ob3id'];
	}
	else { $get['ob3id'] = 0; }
if (isset($get['ob4id']) AND preg_match("/\d/",$get['ob4id']) AND $get['ob4id'] < 18446744073709551615) {
		$get['ob4id'] = $get['ob4id'];
	}
	else { $get['ob4id'] = 0; }
if (isset($get['ob1']) AND preg_match("/\w/",$get['ob1'])) {
		$get['ob1'] = $get['ob1'];
	}
	else { $get['ob1'] = "not"; }
if (isset($get['ob2']) AND preg_match("/\w/",$get['ob2'])) {
		$get['ob2'] = $get['ob2'];
	}
	else { $get['ob2'] = $itt['$varkey']['master']['def']['ob2']; }
	if (isset($get['ob3']) AND preg_match("/\w/",$get['ob3'])) {
		$get['ob3'] = $get['ob3'];
	}
	else { $get['ob3'] = "not"; }
if (isset($get['ob4']) AND preg_match("/\w/",$get['ob4'])) {
		$get['ob4'] = $get['ob4'];
	}
	else { $get['ob4'] = "not"; }
	if (isset($get['room']) AND preg_match("/\w/",$get['room'])) {
		$get['room'] = $get['room'];
	}
	else { $get['room'] = "not"; }
	if (isset($get['sortby']) AND preg_match("/\w/",$get['sortby'])) {
		$get['sortby'] = $get['sortby'];
	}
	else { $get['sortby'] = "not"; }
	if (isset($get['xtplfile']) AND preg_match("/\w/",$get['xtplfile'])) {
		$get['xtplfile'] = $get['xtplfile'];
	}
	else { $get['xtplfile'] = "not"; }
	return $get;
}

function getPrettyTime($foo,$timezone) {
// New Timezone Object 
$timez = new DateTimeZone($timezone); 

// New DateTime Object 
$date =  new DateTime('@'.$foo, $timez);    


// You can still set the timezone though like so...        
$date->setTimezone($timez); 

// This will now output 2011-05-23 00:00:00 
return $date->format('l, F jS, Y g:i A');
}
function getLocalConfig($object) {

$keyarray = explode(";",$object);
// TYPE;SCRIPT;ACTIONSCRIPT
	$countresult = myquery("SELECT COUNT(*) FROM `".dbprfx."master-config` WHERE `key` LIKE ';".$keyarray[0].";".$keyarray[1].";".$keyarray[2].";%'");
	$count = mysql_result($countresult, 0);
	if($count < 1) {
	return FALSE;
	}
	else {	
	$result = myquery("SELECT * FROM `".dbprfx."master-config` WHERE `key` LIKE ';".$keyarray[0].";".$keyarray[1].";".$keyarray[2].";%'");
	$x = 1;
	while($x <= $count) {	
	$resultarray = myarray($result);
	$splitarraykey = explode("~",$resultarray['key']);
	$splitarrayresult = explode("|",$resultarray['data']);
	if($splitarrayresult[0] != "") {
	$foo[$splitarraykey[1]][$splitarraykey[2]][$splitarraykey[3]] = ($splitarrayresult[0] +1) - 1;
	}
	elseif($splitarrayresult[1] != "") {
	if($splirarrayresult[1] == "TRUE") {
$foo[$splitarraykey[1]][$splitarraykey[2]][$splitarraykey[3]] = TRUE;
	}
else {
$foo[$splitarraykey[1]][$splitarraykey[2]][$splitarraykey[3]] = FALSE;
	}
	}
	elseif($splitarrayresult[2] != "") {
	$foo[$splitarraykey[1]][$splitarraykey[2]][$splitarraykey[3]] = $splitarrayresult[2];
	}
	else {
	$foo[$splitarraykey[1]][$splitarraykey[2]][$splitarraykey[3]] = "not";
	}
	unset($splitarrayresult);
	$x++;
	}
}
		
	return $foo;
}