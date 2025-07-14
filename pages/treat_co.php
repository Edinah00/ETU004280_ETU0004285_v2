<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$adresse=$_GET['mail'];
$mdp=$_GET['mdp'];
$connexion=mysqli_connect("localhost","root","","emprunt_objets");
if($connexion){
    $rqt="select * from membre_empObj where email='%s' and mdp='%s';";
    $ok=sprintf($rqt,$adresse,$mdp);
    $resultat=mysqli_query($connexion,$ok);
    if ($donnee=mysqli_fetch_assoc($resultat)) {
        session_start();
        $_SESSION['nom']=$donnee['nom'];
        $_SESSION['ville']=$donnee['ville'];
        $_SESSION['genre']=$donnee['genre'];
        $_SESSION['mdp']=$donnee['mdp'];
        $_SESSION['adresse']=$donnee['email'];
        $_SESSION['dtn']=$donnee['dtn'];
        $_SESSION['id_membre']=$donnee['id_membre'];
        header("Location:listes_obj.php"); 
    }
    else {
        header("Location:page_connection.php?num=1"); 
    }
}

?>