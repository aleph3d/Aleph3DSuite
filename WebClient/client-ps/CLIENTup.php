<?php
// prevent the server from timing out
set_time_limit(0);
include('config/config.php');
include('lib/mainLIB.php');
// include the web sockets server script (the server is started at the far bottom of this file)
require 'lib/class.PHPWebSocket.php';

// when a client sends data to the server
function wsOnMessage($clientID, $message, $messageLength, $binary) {
    global $Server;
    $ip = long2ip( $Server->wsClients[$clientID][6] );

    // check if message length is 0
    if ($messageLength == 0) {
        $Server->wsClose($clientID);
        return;
    }
    if(preg_match("/\/##login::/",$message)) {
        $messageexplode=explode("::",$message);
        $result = myquery("SELECT COUNT(*) FROM `".dbprfx."auth-user` WHERE `username` = '".myescape($messageexplode[1])."'");
        if(mysql_result($result,0) > 0){
            $result2 = myquery("SELECT * FROM `".dbprfx."auth-user` WHERE `username` = '".myescape($messageexplode[1])."' LIMIT 1");
            $array2 = myarray($result2);
            if(md5($messageexplode[2].$array2['passsalt']) == $array2['passhash']) {
                myquery("UPDATE `".dbprfx."auth-user` SET `clientid` = '".$clientID."',`clientidassigntime` = '".time()."' WHERE `username` = '".myescape($messageexplode[1])."'");
                $user = $array2;
                $commandresponse = "You are now logged in as: ".$messageexplode[1];
            }
            else {
                $commandresponse = "ERROR: Incorrect Password";
            }
        }
        else {
            $commandresponse = "ERROR: Unknown User";
        }

        unset($messageexplode);

    }
    elseif(preg_match("/\/##register::/",$message)) {
        $messageexplode=explode("::",$message);
        $result = myquery("SELECT COUNT(*) FROM `".dbprfx."auth-user` WHERE `username` = '".myescape($messageexplode[1])."'");
        if(mysql_result($result,0) < 1) {
            $salt = gen_uuid();
            myquery("INSERT INTO `".dbprfx."auth-user` (`user-uuid`,`clientid`,`clientidassigntime`,`username`,`passhash`,`passsalt`,`userperms`) VALUES ('".gen_uuid()."','".$clientID."','".time()."','".myescape($messageexplode[1])."','".md5($messageexplode[2].$salt)."','".$salt."',';user-normal;')");
            $result2 = myquery("SELECT * FROM `".dbprfx."auth-user` WHERE `username` = '".myescape($messageexplode[1])."' LIMIT 1");
            $user = myarray($result2);
            $commandresponse = "You have successfully registered. You are now logged in as: ".$user['username'];
        }
        else {
            $commandresponse = "ERROR: Username already exists, please select another.";
        }
        unset($messageexplode);
    }
    elseif(preg_match("/\/##help/",$message)) {

        $commandresponse = getHelpTopics("ALL:MAIN");


    }


        //Send the message to everyone but the person who said it
        foreach ( $Server->wsClients as $id => $client )
            if ( $id != $clientID ){
                $result = myquery("SELECT COUNT(*) FROM `".dbprfx."auth-user` WHERE `clientid` = '".$clientID."'");
                if(mysql_result($result,0)>0){
                    $result2 = myquery("SELECT * FROM `".dbprfx."auth-user` WHERE `clientid` = '".$clientID."' ORDER BY `clientidassigntime` DESC LIMIT 1");
                    $user = myarray($result2);
                }
                if(isset($user['username'])){
                    $Server->wsSend($id, $user['username']." said \"$message\"");
                }
                else {
                $Server->wsSend($id, "Visitor $clientID  said \"$message\"");
                }
            }
            elseif (isset($commandresponse)) {
                $Server->wsSend($id, $commandresponse);
                unset($commandresponse);
            }
}

// when a client connects
function wsOnOpen($clientID)
{
    global $Server;
    $ip = long2ip( $Server->wsClients[$clientID][6] );

    $Server->log( "$ip ($clientID) has connected." );

    //Send a join notice to everyone but the person who joined
    foreach ( $Server->wsClients as $id => $client )
        if ( $id != $clientID )
            $Server->wsSend($id, "Visitor $clientID  has joined the room.");
}

// when a client closes or lost connection
function wsOnClose($clientID, $status) {
    global $Server;
    $ip = long2ip( $Server->wsClients[$clientID][6] );

    $Server->log( "$ip ($clientID) has disconnected." );

    //Send a user left notice to everyone in the room
    foreach ( $Server->wsClients as $id => $client )
        $Server->wsSend($id, "Visitor $clientID  has left the room.");
}

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
$Server->wsStartServer(SERVERip, SERVERport);

?>
