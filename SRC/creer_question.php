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
$question_error=$reponse_error=$score_error=$texte_reponse="";

if(!empty($_POST)){
    $tab=[];
    unset($_POST["enregistrer"]);
    unset($_POST["deconnexion"]);
    $tab=$_POST;
   
    $data=file_get_contents("../ASSET/JSON/questions.json");
    $data=json_decode($data,true);

    $data[]=$tab;
    $data=json_encode($data);
   

    file_put_contents("../ASSET/JSON/questions.json",$data);
}elseif(isset($_POST["enregistrer"]) && empty($_POST["question"]) && empty($_POST["type_reponse"]) && empty($_POST["score"]) ){

    $reponse_error="Champ obligatoire";
    $question_error="Champ obligatoire";
    $score_error="Champ obligatoire";
    
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    <title>CREER QUESTIONS</title>
</head>
<body>
<div class="container">
        <div class="violet">
        <div class="logo"><img src="../ASSET/IMG/logo-QuizzSA.png" alt="SA.logo" height="100px"></div>
    
    <div class="heading">
        <h2>le plaisir de jouer</h2>
    </div>
    <div class="qustionaire_bleut">
            <h2>creer et parametrer vos quizz</h2>
           <form action="" method="post">
                <input class="deconnexion" type="submit" name="deconnexion" value="Deconnexion">
                </form>
        </div>
        
        <div class="question_blanche">
        
        <span class="questionaire_droite">
       
    <label for="parametre" id="setting"><h3>parametrer votre question</h3></label>
    
    <div class="genere" >
    <label for="question" class="label">Questions</label>
    <form action="" method="post"  id="affiche" >
    <div class="input">
        <div class="affiche_geber" ></div>
    <input type="text" name="question" id="question" >
    <div class="message_derreur" id="question_error"><?php echo @$question_error?></div>
                </div>
                <label for="score" class="label">Nbre de points</label>
                <div class="input">
                <select  name="score"  id="point">
                         <option > </option>
                         <option > 1</option>
                         <option >3</option>
                         <option >5</option>
                         <option >7</option>
                         <option >9</option>
                         <option >10</option>
                    </select>                            
                    <div class="message_derreur" id="score_error"><?php echo @$score_error?></div>
                </div>
                <label for="t_reponse" class="label">Type de Reponse</label>
                <div class="input">
                <select  name="type_reponse" id="type_reponse">
                         <option value="defaut">Donner le type de réponse</option>
                         <option   value="simple">Choix simple</option>  
                         <option  value="multiple" > Choix multiple</option>  
                         <option value="texte">Réponse texte </option>   
                     </select>  
                     <div class="message_derreur" id="reponse_error"><?php echo @$reponse_error?></div>
                     <span id="ajoute"><button type="button"  onclick="onAddInput()"><img id="ajoute_reponse" src="../ASSET/IMG/ic-ajout-réponse.png" alt="ajoute"></button></span>
                </div>
               
                <div class="submit" >
                    <input type="submit" id="btn" name="enregistrer" value="Enregistrer">
                    </form >
                </div>
                
    </div>

        </span>
        <span class="gauche">
                <div class="avatar_blue">
                <div><span id="list_nom" ><?php  echo  " ".@$_SESSION["nomprenom"] ?></span></div>
                <div class="admin"><img id="cercl" src="<?php echo @$_SESSION["admin_image"] ;?>"  /></div>
                </div>
                <div class="questionaire_creation">
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
    <script src="../ASSET/JS/mes_questions.js"></script>
</body>
</html>