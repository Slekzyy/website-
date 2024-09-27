<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/inscription.css">
  </head>

  <body>
    <header>
        <div class ="style">
            <a href = "index.html" class = "logo">ANGOMA</a>
        </div>
    <header>
    <div class ="centrage">
    <form method="post" action="process/traitement-connexion.php">
        <h1 class="titre">Connexion</h1><br>
        <div class ="input">
          <input type="text" name = "nikname" placeholder="pseudo" required>
        </div><br>
          <div class ="input">
            <input type = "password" name="password" placeholder="mot de passe" required>
          </div><br>
          <button class="bouton">Se connecter</button><br>
        <div class = "titre"><br>
        <p>Vous n'avez pas de compte ? <a href="inscription.php" class="link"> créer en uns</a></p><br>
        <?php
          if(isset($_GET["err"])){
            switch($_GET["err"]){
              case 1:
                echo "<p id='err'>identifiants  et mot de passe incorrecte</p>";
                break;
            }
          }
        ?>
       </div>
    </form>
    </div>
  </body>
</html>

