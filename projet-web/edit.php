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
  </head>

  <body>
    <header>
        <a class = "bouton" href="process/traitement-deconnexion.php">Se déconnecter</a>
    </header>
    <h1 class ="titre">My to do list</h1>

    <div id="forms">
      <div id="edit-task">
          <form method="POST" action="process/traitement-edit.php?id=<?php echo $_GET['id'];?>">
              <fieldset id="new_task_field">
                  <legend><h3>Modification</h3></legend>
                  <label>Name : </label><input type="text" name="name"/>
                  <label>Deadline: </label><input type="date" name="deadline"/>
                  <label>Status :</label>
                  <select name="status">
                    <option value="">-- Status --</option>
                    <option value="A faire">A faire 🟣</option>
                    <option value="En cours">En cours 🔵</option>
                    <option value="Termine">Terminé 🟢</option>
                  </select>
                  <label>Desciption : </label><textarea name="description" id="" cols="30" rows="5"></textarea>
                  <input type="submit" value="valider"/>
              </fieldset>
          </form>
      </div>
    </div>

    <hr/>

    <div id="tasks-preview">
      <?php
        $connexion = mysqli_connect("inf-mysql.univ-rouen.fr", "zianisam", "28092005", "zianisam");

        $id = $_GET['id'];

        $requete = "SELECT * FROM tasks WHERE id='$id' AND owner='".$_SESSION['nikname']."'";
        $res = mysqli_query($connexion, $requete);

        while ($task = mysqli_fetch_array($res)) {
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
          echo "</fieldset>";
          echo "</div>";
      }

      ?>
    </div>
      <a href="dashboard.php" class ="bouton1">Retour à la création</a>
  </body>
</html>
