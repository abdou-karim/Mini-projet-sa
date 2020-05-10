<?php 
session_start();
if(isset($_POST["deconnexion"])){
    
    header("location:../index.php");
    
    setcookie('login','');

setcookie('mdp','');
}
if(!isset($_COOKIE["login"]) || !isset($_COOKIE["mdp"])){

    header("location:../index.php");
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    <title>Liste joueur</title>
</head>
<body>
<div class="container">

<div class="violet">
    <div class="logo"><img src="../ASSET/IMG/logo-QuizzSA.png" alt="SA.logo" height="100px"></div>

    <div class="heading">
        <h2>le plaisir de jouer</h2>
    </div>
</div>
<div class="image">
<div class="bleut">
        <h2>creer et parametrer vos quizz</h2>
        <form action="" method="post" enctype="multipart/form-data" id="ma_form">
            <input class="deconnexion" type="submit" name="deconnexion" value="Deconnexion">
    </div>
    <div class="blanche">
    <span class="droite">
        <div class="droite_heading"><h3>liste des joueurs par score</h3></div>
        <div class="border_blu">
                <?php 
                $joueur_nom=[];
                $joueur_prenom=[];
                $score=[];
                    @$liste=file_get_contents("../ASSET/JSON/fichier.json");
                   
                    @$liste=json_decode($liste,true);

                     for($i=0;$i<=@count($liste);$i++){
                    
                        if(@$liste[$i]["Rolle"]=="user"){
                       $joueur_nom[]= $i." ".@$liste[$i]["nom"];
                       $joueur_prenom[]=@$liste[$i]["prenom"];
                       $score[]=@$liste[$i]["score"];
                            }
                        }
                        
                             ?>
                    <div class="liste_fiche">
                    <table>
                  
  <tr>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Score</th>
  </tr>
  <tr>
    <td><?php foreach($joueur_nom as $value){ echo $value."<br><br>"; }   ?></td>
    <td><?php foreach($joueur_prenom as $valeur){ echo $valeur."<br><br>"; } ?></td>
    <td><?php foreach($score as $val){ echo $val."<br><br>"; }  ?></td>
  </tr>
  </table>
                    </div>
                  

                  

                   
                   
                 
        </div>
        <div>
                        <input id="liste_suivant" type="submit"  value="suivant" name="liste_suivant">
                    </div>
    </span>
    <span class="gauche">
    <div class="avatar_blue">
    <div><span id="list_nom" ><?php  echo  " ".@$_SESSION["nomprenom"] ?></span></div>
    <div class="admin"><img id="cercl" src="<?php echo $_SESSION["admin_image"];?>" alt="" /></div>   
            </div>
            <div class="creation">
            <div class="label1"><a href="dashboard.php">Dashboard<img id="icone" src="../ASSET/IMG/Play-Games-icon.png" alt="logo.list" style="width: 10%;margin-left: 20px;"></a></div>
            <div class="label1"><a href="listes_questions.php">Liste question<img id="icone" src="../ASSET/IMG/ic-liste-active.png" alt="logo.list"></a></div>
                <div class="label1"><a href="creation_compte_admin.php">Créer admin<img id="icone" src="../ASSET/IMG/ic-ajout.png" alt="logo.ajoute"></a></div>
                <div class="label1"><a href="Liste_joueur.php">Liste joueur<img  id="icone" src="../ASSET/IMG/icone.jpeg" alt="logo.list"></a></div>
                <div class="label1"><a href="creer_question.php">Créer question<img id="icone" src="../ASSET/IMG/ic-ajout.png" alt="logo.ajoute"></a></div>
            </div>

            
        </span>
    </div>
</div>
</div>
</body>
</html>