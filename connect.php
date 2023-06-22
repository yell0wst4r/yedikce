<?php

$con=mysqli_connect('localhost', 'root', '', 'yedikce');
if(!$con){
    die("Error connecting to MySQl:" .mysqli_connect_error() );
}

?>