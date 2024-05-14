<?php
//CONNECT DATABASE
$username = 'Massi';
$password = 'qa58WS05massinissa';
try 
{
    $data = new PDO("mysql:host=localhost;dbname=meetic", $username, $password);
} 

catch (PDOException $e)
{
    echo "Connection Failed." . $e->getMessage();
}
?>