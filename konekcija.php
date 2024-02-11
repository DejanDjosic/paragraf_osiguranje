<?php
session_start();
$baza=mysqli_connect('localhost','root','','osiguranje');

if(mysqli_connect_errno())
{
    echo "Neuspešno povezivanje sa MySQL-om: ".mysqli_connect_error();
}

?>