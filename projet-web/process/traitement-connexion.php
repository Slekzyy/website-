<?php
  if(isset($_POST['nikname']) && isset($_POST['password'])){
    $nikname = strtolower($_POST['nikname']);
    $password = $_POST['password'];

    $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");

    $requete = "SELECT * FROM users";
    $res = mysqli_query($connexion, $requete);

    while($user = mysqli_fetch_array($res)){
      if(strtolower($user["nikname"]) === strtolower($nikname) && $user["password"] === $password){
        // Bons identifiants

        session_start();

        $_SESSION["nikname"] = $user["nikname"];
        $_SESSION["lastname"] = $user["lastname"];
        $_SESSION["firstname"] = $user["firstname"];

        header("Location: ../dashboard.php"); // Erreur 1 : identifiants incorrecte
        exit;
      }else{
        // Mauvais identifiants
        header("Location: ../connexion.php?err=1"); // Erreur 1 : identifiants incorrecte
        exit;
      }
    }
  }
  ?>

