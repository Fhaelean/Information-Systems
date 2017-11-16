<?php
$db = mysql_connect ("localhost","root","");
mysql_select_db ("users",$db);
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b');
?>