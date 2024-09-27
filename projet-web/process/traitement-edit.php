<?php
  $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");

  $id = $_GET['id'];

  if(isset($_POST["name"])){
    $name = $_POST["name"];

    $requete = "UPDATE tasks SET name = '$name' WHERE id='$id'";
    $res = mysqli_query($connexion, $requete);
  }

  if(isset($_POST["description"])){
    $description = $_POST["description"];

    $requete = "UPDATE tasks SET description = '$description' WHERE id='$id'";
    $res = mysqli_query($connexion, $requete);
  }

  if(isset($_POST["deadline"])){
    $deadline = $_POST["deadline"];

    $requete = "UPDATE tasks SET deadline = '$deadline' WHERE id='$id'";
    $res = mysqli_query($connexion, $requete);
  }

  if(isset($_POST["status"])){
    $status = $_POST["status"];

    $requete = "UPDATE tasks SET status = '$status' WHERE id='$id'";
    $res = mysqli_query($connexion, $requete);
  }

  header("Location: ../dashboard.php");

?>
