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


$prenom_error=$nom_error=$login_error=$pass_error=$repass_erro=$image_error="";
$prenom=$nom=$login=$pass=$repass="";

@$prenom=$_POST["prenom"];
@$nom=$_POST["nom"];
@$login=$_POST["login"];
@$pass=$_POST["pass"];
@$repass=$_POST["repass"];
@$submit=$_POST["submit"];
@$deconnexion=$_POST["deconnexion"];
@$image=$_POST["image"];

if(isset($submit)){
    unset($_SESSION["admin"]);

    if(!preg_match("#^[a-zA-Z \-éàè]+$#",$prenom)){
        $prenom_error="Prenom invalide";
    }
    elseif(!preg_match("#^[a-zA-Z \-éàè]+$#",$nom)){
        $nom_error="Nom invalide";
    }
    
    elseif(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$login)){

        $login_error="Email invalide!";
    }
    elseif(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$pass)){

                     $pass_error="Mot de passe invalide!";
       
    }elseif($repass!=$pass){
                     $repass_erro="Mot de passe non identiques!";
    }elseif(empty($_FILES["image"])){
        $repass_erro="image manquant*!";
    }
    else {

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
          {
             
          //1mega octet mo=1000000 d'octets(on verifi si notre image est <3mega octets)
          //pathinfo va garder sous forme de tableau t les infos de notre image
          
          if($_FILES['image']['size']<=3000000)
          {
          $informationsimage = pathinfo($_FILES['image']['name']);
          
          $extensionimage = $informationsimage['extension'];
          
          $extensionarray = array('png','jpeg');
          
          
          if (in_array($extensionimage,$extensionarray)) {
          
              move_uploaded_file($_FILES['image']['tmp_name'],'../avatar/admin/'.$_SESSION["admin"]=basename($_FILES["image"]["name"]));

              $chemin='../avatar/admin/'.$_SESSION["admin"]=basename($_FILES["image"]["name"]);
          
                                     
                 
          
          }else{

              $repass_erro="format non pris en charge";
          }
          }
          
              
          }
        
       
        $informations=[
        "Rolle"=>"admin",
        "prenom"=>$prenom,
        "nom"=>$nom,
        "login"=>$login,
        "pass"=>md5($pass),
        "repass"=>md5($repass),
        "image"=> $chemin,
        ];

        $js=file_get_contents("../ASSET/JSON/fichier.json");

        $js=json_decode($js,true); 
               
            $js[]=$informations;
            $js=json_encode($js);
            file_put_contents("../ASSET/JSON/fichier.json",$js);
          }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    <title>Creer Compte Admin</title>
</head>
<body>
<div class="container">
    <div class="violet">
    <div class="logo"><img src="../ASSET/IMG/logo-QuizzSA.png" alt="SA.logo" height="100px"></div>

<div class="heading">
    <h2>le plaisir de jouer</h2>
</div>
    </div>
    <div class="bleut">
        <h2>creer et parametrer vos quizz</h2>
        <form action="" method="post" enctype="multipart/form-data" id="ma_form"   onsubmit="return validateForm()">
            <input class="deconnexion" type="submit" name="deconnexion" value="Deconnexion">
    </div>
    <div class="blanche">
       
        <span class="droite">
            <div class="inscire">S'inscrire<br><strong>Pour proposez des quizz</strong></div>
           
            <div class="label">Prénom</div>
            <div class="input">
                <input class="les_input" type="text" name="prenom" placeholder="votre prenom" value="<?php echo $prenom?>">
                <div class="message_derreur" id="prenom_error"><?php echo $prenom_error?></div>
            </div>
            <div class="label">Nom</div>
            <div class="input">
                <input class="les_input" type="text" name="nom" placeholder="votre nom" value="<?php echo $nom?>">
                <div class="message_derreur" id="nom_error"><?php echo $nom_error?></div>
            </div>
            <div class="label">Login</div>
            <div class="input">
                <input class="les_input type="text" name="login" placeholder="pseudo" value="<?php echo $login?>">
                <div class="message_derreur" id="login_error"><?php echo $login_error?></div>
            </div>
            <div class="label">Mot de passe</div>
            <div class="input">
                <input class="les_input" type="password" name="pass" value="<?php echo $pass?>">
                <div class="message_derreur" id="passe_error"><?php echo $pass_error?></div>
            </div>
            <div class="label">Confirmation de mote de passe</div>
           
            <div class="input">
                <input class="les_input" type="password" name="repass" value="<?php echo $repass?>">
                <div class="message_derreur" id="repasse_error"><?php echo $repass_erro?></div>
            </div>
            <div class="avatar">
               <!-- Nous avons ici notre label et l'input afférent -->
                        <label for="file" class="label-file">Choisir une image</label>
                        <input id="file" class="input-file" name="image" type="file" value="<?php echo $image;?>" accept="image/png,image/jpeg" onchange="loadFile(event)">
                        <div class="message_derreur"><?php echo $image_error?></div>
            </div>
            <div class="creer_comte">
                <input class="compte" type="submit" name="submit" value="Creer compte">
            </div>

        </span>
        <span class="gauche">
            <div class="avatar_blue">
            <div><span id="list_nom" ><?php  echo  " ".@$_SESSION["nomprenom"] ?></span></div>
            <div class="admin"><img id="cercl" src="<?php echo $_SESSION["admin_image"];?>"  alt="" /></div> 
            <div class="Cr_admin"><img id="cre_admin" src="avatar/admin/<?php echo $_SESSION["admin"];?>"  alt="" /></div> 
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
     </form>
     <script >
        function validateForm(e) {
    var prenom = document.forms["ma_form"]["prenom"].value;
    var nom = document.forms["ma_form"]["nom"].value;
    var login = document.forms["ma_form"]["login"].value;
    var passe = document.forms["ma_form"]["pass"].value;
    var repasse = document.forms["ma_form"]["repass"].value;

    var prenom_regex=/^[a-zA-Z \-éàè]+$/;
    var nom_regex=/^[a-zA-Z \-éàè]+$/;
    var login_regex=/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    var pass_regex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
   

    var prenom_erreur=document.getElementById("prenom_error");
    var nom_erreur=document.getElementById("nom_error");
    var login_erreur=document.getElementById("login_error");
    var pass_erreur=document.getElementById("passe_error");
    var repass_erreur=document.getElementById("repasse_error");
    

    if(prenom_regex.test(prenom)==false){

        prenom_erreur.textContent = "Prenom manquant";
                
     
        return false;
       
    }
    else if(nom_regex.test(nom)==false){
        nom_erreur.textContent = "Nom manquant";
       
        return false;
        
    }
    else if(login_regex.test(login)==false){
        login_erreur.textContent = "Login manquant";
               
        return false;
    }
    else if(pass_regex.test(passe)==false){
        pass_erreur.textContent = "Mot de passe manquant";
               
        return false;
    }
    else if(repasse!=passe){
        
        repass_erreur.textContent = "Mot de passe non identique";
               
        return false;
    }else{
        return true;
    }
    
}
  var loadFile = function(event) {
    var output = document.getElementById('cre_admin');
    cre_admin.src = URL.createObjectURL(event.target.files[0]);
    cre_admin.onload = function() {
      URL.revokeObjectURL(cre_admin.src) // free memory
    }
  };
     </script>
</div>  
</body>
</html>