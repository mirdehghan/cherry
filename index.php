<?php
 
//Reduce errors
error_reporting(~E_WARNING);
 
//Create a UDP socket
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}
 
//echo "Socket created \n";
 
// Bind the source address
if( !socket_bind($sock, "0.0.0.0" , 5678) )
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not bind socket : [$errorcode] $errormsg \n");
}
 
//echo "Socket bind OK"."<br/>";
 
//Do some communication, this loop can handle multiple clients
$i=5;
while($i>0)
{
   
/*    //Receive some data
    $r = socket_recvfrom($sock, $buf, 1024, 0, $remote_ip, $remote_port);
    echo "$remote_ip" ."<br/>";
    echo $buf;
    //Send back the data to the client
    socket_sendto($sock, "OK " . $buf , 100 , 0 , $remote_ip , $remote_port);*/
    if (false !== ($bytes = socket_recv($sock, $buf, 2048, MSG_WAITALL))) {
    echo "Read $bytes bytes from socket_recv(). Closing socket...";
} else {
    echo "socket_recv() failed; reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}
socket_close($sock);

echo $buf . "\n";
echo "OK.\n\n";

    $i--;
}
 
//socket_close($sock);
