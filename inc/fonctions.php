<?php
require('connexion.php');

function insert_new_User($nom,$adresse,$mdp,$ville,$genre,$dtn){
    $rqt=sprintf("INSERT into membre_empObj(nom,date_naissance,genre,email,ville,mdp) values('%s','%s','%s','%s','%s','%s');",$nom,$dtn,$genre,$adresse,$ville,$mdp);
    var_dump($rqt);
        var_dump($mdp);

    $resultat=mysqli_query(dbconnect(),$rqt);
}
function get_all_object(){
    $rqt="SELECT * from objet_empObj";
    $resultat=mysqli_query(dBconnect(),$rqt);
    return $resultat;

}
function get_all_object_emprunter($id_obj){
    $rqt=sprintf("SELECT * from V_emprunt_obj where id_objet = %d",$id_obj);
    $resultat=mysqli_query(dBconnect(),$rqt);
    return $resultat;

}
function get_all_object_per_category($nom_cat){
    $rqt=sprintf("SELECT * from V_objet_categorie where nom_categorie = '%s'",$nom_cat);
    $resultat=mysqli_query(dBconnect(),$rqt);
    return $resultat;
}
function get_all_category(){
    $rqt=sprintf("SELECT * from categorie_objet_empObj");
    $resultat=mysqli_query(dBconnect(),$rqt);
    return $resultat;
}

 ?>