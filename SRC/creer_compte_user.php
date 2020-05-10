<?php 
session_start();
            $prenom_error=$nom_error=$login_error=$pass_error=$repass_error="";
            $prenom=$nom=$login=$pass=$repass="";

@$prenom=$_POST["prenom"];
@$nom=$_POST["nom"];
@$login=$_POST["login"];
@$pass=$_POST["pass"];
@$repass=$_POST["repass"];
@$submit=$_POST["submit"];
@$image=$_POST["image"];

    if(isset($submit)){
        
       
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
                         $repass_error="Mot de passe non identiques!";
        }
        else{

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
          
              move_uploaded_file($_FILES['image']['tmp_name'],'../avatar/joueur/'.$_SESSION["joueur"]=basename($_FILES["image"]["name"]));

              $chemin='../avatar/joueur/'.$_SESSION["joueur"]=basename($_FILES["image"]["name"]);
          
                                     
                 
          
          }else{

              $repass_erro="format non pris en charge";
          }
           
            $informations=[
                "Rolle"=>"user",
                "prenom"=>$prenom,
                "nom"=>$nom,
                "login"=>$login,
                "pass"=>md5($pass),
                "repass"=>md5($repass),
                "image"=>$chemin,
                ];
            
           
        $js=file_get_contents("../ASSET/JSON/fichier.json");
        $js=json_decode($js,true);
            $js[]=$informations;
        $js=json_encode($js);
        file_put_contents("../ASSET/JSON/fichier.json",$js);

        header("location:../index.php");

       

        }
        
        }

    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    <title>Compte_User</title>
</head>
<body>
<div class="container">

<div class="violet">
    <div class="logo"><img src="../ASSET/IMG/logo-QuizzSA.png" alt="SA.logo" height="100px"></div>

    <div class="heading">
        <h2>le plaisir de jouer</h2>
    </div>
</div>
<div class="white_inscire">S'inscrire<br><strong>Pour proposez des quizz</strong></div>
<div class="white">

<div class="white_form">

                                   
    <form action="" method="post" name="myForm" enctype="multipart/form-data"  onsubmit="return validateForm()">
    
    <div class="white_label">Prénom</div>
    <div class="white_input">
        <input class="les_inputs" type="text" name="prenom" value="<?php echo $prenom?>" placeholder="Votre prenom">       
        <div class="message_derreur"  id="prenom_error"><?php echo $prenom_error?></div>
    </div>
    <div class="white_label">Nom</div>
    <div class="white_input">
        <input  class="les_inputs" type="text" name="nom" value="<?php echo $nom?>" placeholder="Votre nom">
        <div class="message_derreur" id="nom_error"><?php echo $nom_error?></div>
    </div>
    <div class="white_label">Login</div>
    <div class="white_input">
        <input  class="les_inputs" type="text" name="login" value="<?php echo $login?>" placeholder="pseudo">
        <div class="message_derreur" id="login_error"><?php echo $login_error?></div>
    </div>
    <div class="white_label">Mot de passe</div>
    <div class="white_input">
        <input  class="les_inputs" type="password" name="pass" value="<?php echo $pass?>">
        <div class="message_derreur" id="passe_error"><?php echo $pass_error?></div>
    </div>
    <div class="white_label">Comfirmation de mot de passe</div>
    <div class="white_inputs">
        <input  class="les_inputs" type="password" name="repass" value="<?php echo $repass?>">
        <div class="message_derreur" id="repasse_error"><?php echo $repass_error?></div>
    </div>
    <div class="avatar">
               <!-- Nous avons ici notre label et l'input afférent -->
                        <label for="file" class="label-file">Choisir une image</label>
                        <input  id="file" class="input-file" name="image"  value="<?php echo $image;?>" type="file" accept="image/*" onchange="loadFile(event)" >
            </div>
            <div class="cree_comte">
                <input class="compte" type="submit" name="submit" value="Creer compte">
            </div>
            <div class="ma_cercle"><img id="cerclee" src="<?php echo $_SESSION["joueur"];?>" alt="" /></div>
            </form>
</div>
</div>
</div>
    <script>

function validateForm(e) {
    var prenom = document.forms["myForm"]["prenom"].value;
    var nom = document.forms["myForm"]["nom"].value;
    var login = document.forms["myForm"]["login"].value;
    var passe = document.forms["myForm"]["pass"].value;
    var repasse = document.forms["myForm"]["repass"].value;

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
    var output = document.getElementById('cerclee');
    cerclee.src = URL.createObjectURL(event.target.files[0]);
    cerclee.onload = function() {
      URL.revokeObjectURL(cerclee.src) // free memory
    }
  };
    </script>
</body>
</html>

