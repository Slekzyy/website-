<!DOCTYPE html>

<?php
  session_start();
  if(!(isset($_SESSION["nikname"]))){
    header("Location: index.html");
  }

?>


<html>
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>

  <body>
    <header>
        <a class = "bouton" href="process/traitement-deconnexion.php">Se déconnecter</a>
    </header>
    <h1 class ="titre">My to do list</h1>

    <div id="forms">
      <div id="newtask">
          <form method="POST" action="process/traitement-newtask.php">
              <fieldset id="new_task_field">
                  <legend><h3>Creation</h3></legend>
                  <label>Name : </label><input type="text" name="name" required/>
                  <label>Deadline: </label><input type="date" name="deadline" required/>
                  <label>Desciption : </label><textarea name="description" id="" cols="30" rows="5" required></textarea>
                  <input type="submit" value="valider"/>
              </fieldset>
          </form>
      </div>
    </div>
    <div class ="recherche">
      <form action="process/search.php" method ="POST" class ="post">
        <input type="search" id ="bouton" name="search" placeholder="recherche de tache">
        <button type="submit"><icon class="fa fa-search"></icon></button>
      </form>
    </div>

    <hr/>

    <div id="tasks-container">
      <?php
        $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");
        if(isset($_SESSION['search'])){
          $requete = $_SESSION['search'];
        }else{
          $requete = "SELECT * FROM tasks WHERE owner='".$_SESSION["nikname"]."'";
        }
        $res = mysqli_query($connexion, $requete);


        while ($task = mysqli_fetch_array($res)) {
          echo "<div class=\"case\">";
          echo "<div class=\"item\">";
          echo "<fieldset class=\"task\">";
          echo "  <legend class=\"legend-task\"><h3>".$task["name"]."</h3></legend>";
          echo "  <p><strong>Description</strong> : ".$task["description"]."</p>";
          $deadline = date("l, F jS Y", strtotime($task["deadline"]));
          echo "  <p><strong>Date limite</strong> : ".$deadline."</p>";
          $cur_date = date("l, F jS Y");
          $remain = (strtotime($deadline) - strtotime($cur_date))/60/60/24;
          if($remain > 0){
              echo "  <p><strong>Temps restant</strong> : ".$remain." days</p>";
          }else if($remain === 0){
              echo "  <p><strong>Temps restant</strong> : <strong>today</strong></p>";
          }else{
              echo "  <p><strong>Temps restant</strong> : elapsed</p>";
          }

          if($task["status"] == "A faire"){
              echo "  <p><strong>Status</strong> : ".$task["status"]." 🟣</p>";
          }else if($task["status"] == "En cours"){
              echo "  <p><strong>Status</strong> : ".$task["status"]." 🔵</p>";
          }else if($task["status"] == "Termine"){
              echo "  <p><strong>Status</strong> : ".$task["status"]." 🟢</p>";
          }
          echo "  <p><a href=\"edit.php?id=".$task["id"]."\"><button>edit</button></a></p>";
          echo "  <p><a href=\"process/traitement-deltask.php?id=".$task["id"]."\"><button>delete</button></a></p>";
          echo "</fieldset>";
          echo "</div>";
          echo "</div>";
      }

      ?>
    </div>
  </body>
</html>
