<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
require('../inc/fonctions.php');
$nom=$_GET['nom'];
$adresse=$_GET['mail'];
$genre=$_GET['genre'];
$ville=$_GET['ville'];
$mdp=$_GET['mdp'];
$dtn=$_GET['dtn'];
$connexion=mysqli_connect("localhost","root","","Network");
var_dump($mdp);
if($connexion){
    insert_new_User($nom,$adresse,$mdp,$ville,$genre,$dtn);
    header("Location:page_connection.php");
};

?>