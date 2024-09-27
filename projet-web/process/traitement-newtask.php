<?php
    if(!(isset($_POST["name"]) && isset($_POST["deadline"]) && isset($_POST["description"]))){
        error();
    }
    session_start();

    $username = $_SESSION["nikname"];
    $name = $_POST["name"];
    $deadline = $_POST["deadline"];
    $desc = $_POST["description"];

    // nom de la tache  à ne pas dépasser
    if(strlen($name) > 100){
        header("Location: ../dashboard.php?err=3");
        exit;
    }

    // limite de caractere pour la description à ne pas dépasser
    if(strlen($desc) > 12000){
        header("Location: ../dashboard.php?err=2");
        exit;
    }

    // Date trop lointaine pour le systeme
    if($deadline > 2100 || $deadline < 1900){
        header("Location: ../dashboard.php?err=1");
        exit;
    }

    $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");

    $requete = "INSERT INTO tasks (name, description, deadline, status, owner) VALUES('$name', '$desc', '$deadline', 'A faire', '$username')";
    $res = mysqli_query($connexion, $requete);

    if(!$res){
        mysqli_close($connexion);
        $err = mysqli_error($connexion);
        echo "$err";
        error();
    }

    mysqli_close($connexion);

    header("Location: ../dashboard.php"); // on retourne au dashboard

    function error(){
        echo "une erreur est survenue, <a href=\"../dashboard.php\">retour</a>";
        exit;
    }
?>
