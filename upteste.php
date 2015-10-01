<?php
$string = file_get_contents("http://www.angelfire.com/ri2/DMX/data.txt", "r");
$myFile = "myFile.txt";
$fh = fopen($myFile, 'w') or die("Could not open: " . mysql_error());
fwrite($fh, $string);
fclose($fh);

$sql = mysql_connect("localhost", "root", "root");
if (!$sql) {
    die("Could not connect: " . mysql_error());
}
mysql_select_db("recomendador-test");
$result = mysql_query("LOAD DATA INFILE '$myFile'" .
                      " INTO TABLE areas_conhecimento FIELDS TERMINATED BY '|'");
if (!$result) {
    die("Could not load. " . mysql_error());
}
 
?>