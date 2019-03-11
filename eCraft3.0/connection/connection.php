<?php

//connesione al database

//$database = "ecraft";

$link = mysql_connect("localhost", "admin", "ecraft") or die(mysql_error());

/*if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}*/

if(!$link){
  echo "Failed to connect to MySQL: " . mysql_error();
  }

 mysql_select_db("ecraft", $link) or die(mysql_error());

?>
