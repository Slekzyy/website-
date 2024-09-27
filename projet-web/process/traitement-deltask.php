<?php
  if(isset($_GET["id"])){
    $id = $_GET["id"];

    session_start();

    $nikname = $_SESSION["nikname"];

    $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");

    $requete = "DELETE FROM tasks WHERE id='$id' AND owner='$nikname' ";

    $res = mysqli_query($connexion, $requete);

    mysqli_close($connexion);

    if(!$res){
      echo " Il y a eu une erreur <a href='../dashboard.php'>retour en arrière</a>";
      exit;
    }

    header("Location: ../dashboard.php");
    exit;
  }
?>
