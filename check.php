<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
// This is a sample code in case you wish to check the username from a mysql db table

if(isSet($_POST['username']))
{
$username = $_POST['username'];

include("acessaBD.php");

$sql_check = mysql_query("SELECT usuario FROM cadastros WHERE usuario='$username'");

if(mysql_num_rows($sql_check))
{
echo '<font color="red">O nome de usuário <STRONG>'.$username.'</STRONG> já está em uso.</font>';
}
else
{
echo 'OK';
}

}
} 
?>