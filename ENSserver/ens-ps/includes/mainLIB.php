<?php
/**
 * Created by PhpStorm.
 * User: WhiteRabbit
 * Date: 2/6/14
 * Time: 2:21 AM
 */
//MySQL Query Database
function myquery($query) {
    mysql_connect(dbhost, dbuser, dbpass);
    mysql_select_db(dbname);
    $result = mysql_query($query);
    if (!mysql_errno() && @mysql_num_rows($result) > 0) {
    }
    else {
        $result="#not";
    }
    mysql_close();
    return $result;
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

function getHelpTopics($str){
    $result=myquery("SELECT COUNT(*) FROM `".dbprfx."help` WHERE `typekey` = '".$str."'");
    if(mysql_result($result,0) > 0) {
        $result2=myquery("SELECT * FROM `".dbprfx."help` WHERE `typekey` = '".$str."' LIMIT 1");
        $array2 = myarray($result2);
        return $array2['helpdata'];
    }
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