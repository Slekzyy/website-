<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title>inscription</title>
    <link rel="stylesheet" href="css/inscription.css">
  </head>

  <body>
    <header>
        <div class ="style">
            <a href = "index.html" class = "logo">ANGOMA</a>
        </div>
    <header>
    <div class ="centrage">
        <form method = "POST" action ="process/traitement-inscription.php">
                <h1 class="titre">Inscription</h1><br>
                <div class ="input">
                <input type ="text" name ="firstname" placeholder="prénom" required>
                </div><br>
                <div class ="input">
                <input type = "text" name ="lastname" placeholder="nom" required>
                </div><br>
                <div class ="input">
                <input type="text" name ="nikname" placeholder="pseudo" required>
                </div><br>
                <div class ="input">
                <input type = "password" name ="password" placeholder="mot de passe" required>
                </div><br>
            <button class="bouton">créer le compte</button><br>
            <div class = "titre"><br>
                <p>vous avez dèja un compte ? <a href="connexion.php" class="link"> Connectez vous</a></p><br>
                <?php
                if(isset($_GET["err"])){
                  switch($_GET["err"]){
                    case 1:
                      echo "<p id='err'>Un utilisateur possède déjà ce pseudo</p>";
                      break;
                    case 2:
                      echo "<p id='err'>Erreur de base de donée</p>";
                      break;
                  }
                }
                ?>
            </div>
        </form>
    </div>
  </body>
</html>
