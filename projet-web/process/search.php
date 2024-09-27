<?php

  session_start();
  if(isset($_SESSION['nikname'])){
    $nikname = $_SESSION['nikname'];
  }
  else{
    echo "il y'a une erreur";
    exit; // si il y'a une erreur
  }

  //connexion a sql
  $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");

  $search = "";

  if(isset($_POST['search'])){
    $search = $_POST['search'];
    $searchInQuery = rtrim(preg_replace('/\s+/', "", $search), " "); // enlever les espaces blancs
    $requete = "SELECT * FROM tasks WHERE owner='".$_SESSION["nikname"]."' AND  name LIKE '%".$search."%'"; //verifier l'id , chaine de caractere comprise dans la grande chaine de caractere
  }

  if($search == ""){
    unset($_SESSION['search']);
  }else{
      $_SESSION['search'] = $requete;
  }

  header('Location: ../dashboard.php');
?>
