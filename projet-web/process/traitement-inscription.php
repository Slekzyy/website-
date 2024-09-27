<?php
  if(isset($_POST['firstname']) && isset($_POST['lastname']) &&
  isset($_POST['nikname']) && isset($_POST['password'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nikname = strtolower($_POST['nikname']);
    $password = $_POST['password'];

    $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");

    $requete = "SELECT nikname FROM users WHERE(nikname = '$nikname')";
    $res = mysqli_query($connexion, $requete);

    $users = mysqli_fetch_array($res);

    if($users[0] == null){
      echo 'Création de compte ...';
      // Création du compte dans la base de donée
      $requete = "INSERT into users VALUES('$nikname','$password', '$firstname','$lastname')";
      $res = mysqli_query($connexion, $requete);
      if($res){
        // Ouverture de session;
        session_start();
        $_SESSION["nikname"] = $nikname;
        // Redirection ...
        header("Location: ../dashboard.php");
        exit;
      }else{
        // Code err = 2 = Erreur d'insertion dans la bdd
        header("Location: ../inscription.php?err=2");
      }
    }else{
      echo 'Déjà quelqu\'un avec ce nom';
      // Code err = 1 = Un utilisateur porte dejà ce pseudo
      header("Location: ../inscription.php?err=1");
    }
  }





  ?>
