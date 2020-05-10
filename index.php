<?php 
session_start();
if(isset($_POST["inscrire"])){
    header("location:./SRC/creer_compte_user.php");
   
    
    
}

$erreur="";
@$login=$_POST["login"];
@$pass=$_POST["password"];
@$submit=$_POST["submit"];

if(isset($submit)){

    @$fp=file_get_contents("./ASSET/JSON/fichier.json");
    @$fp=json_decode($fp,true);
    for($i=0;$i<@count($fp);$i++){  

if(@$fp[$i]["Rolle"]=="admin"){

    if($login==@$fp[$i]["login"] && md5($pass)===@$fp[$i]["pass"]){

        setcookie("login",$fp[$i]['login'],(time()+60*60*24*365));
        setcookie("mdp",$fp[$i]["pass"],(time()+60*60*24*365));

        $_SESSION["nomprenom"]=strtoupper($fp[$i]["prenom"]."<br />".$fp[$i]["nom"]);
            $_SESSION["id_admin"]=$fp[$i]["login"]." ".$fp[$i]["pass"];
            $_SESSION["admin_image"]=$fp[$i]["image"];

        header("location:./SRC/listes_questions.php");
    } elseif ($login!=@$fp[$i]["login"]) {

                $erreur="Vous n'êtes pas encore administrateur  Veuillez vous inscrire pour jouer";
             
             
             }elseif ($pass!=@$fp[$i]["pass"]) {
     
                $erreur="mot de passe invalide";
             
            }
        
}

if(@$fp[$i]["Rolle"]=="user"){

    if($login==@$fp[$i]["login"] && md5($pass)===@$fp[$i]["pass"]){

        setcookie("login_joueur",$fp[$i]['login'],(time()+60*60*24*365));

        setcookie("mdp_joueur",$fp[$i]["pass_joueur"],(time()+60*60*24*365));

        $_SESSION["nomprenom_joueur"]=strtoupper($fp[$i]["prenom"]." ".$fp[$i]["nom"]);
                   $_SESSION["id_joueur"]=$fp[$i]["login_joueur"]." ".$fp[$i]["pass_joueur"];
                   $_SESSION["user_image"]=$fp[$i]["image"];
                   header("location:./SRC/page_de_jeux.php");

}
elseif ($login!=@$fp[$i]["login"]){

           $erreur="Vous n'etes pas encore joueur Veuillez vous inscrire pour jouer";
         
         }

           
}
    
}
}

?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <title>MINI PROJET</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./ASSET/CSS/style.css">
</head>

<body>
    <div class="container">

        <div class="violet">
            <div class="logo"><img src="./ASSET/IMG/logo-QuizzSA.png" alt="SA.logo" height="100px"></div>

            <div class="heading">
                <h2>le plaisir de jouer</h2>
            </div>
        </div>
        <div class="image">

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">

                    <form class="contact-form" name="myForm" action="" method="post"  onsubmit="return validateForm()">
                        <div class="blue">
                            <p class="textform">Login Form</p>
                        </div>
                        <div class="form">
                            <div class="col-md-6">
                             <img class="logimg" src="./ASSET/IMG/ic-login.png" alt="login"><input class="taille" type="text" id="ma_login" name="login"  placeholder="Login" value="<?php echo $login?>">
                             <div id="login_error"></div>
                                <div class="messages_derreur"><?php echo $erreur?></div>
                            </div>
                            <div class="col-md-6">
                                <span><img class="logimg" src="./ASSET/IMG/ic-password.png" alt="password"><input id="ma_passe" class="taille" type="password" name="password"></span><br>
                                
                                <div class="buton">
                                    <div class="col-md-6">
                                        <input type="submit" class="button1" name="submit" value="Connexion">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="submit" id="valider" class="button" name="inscrire" value="S'inscrire pour jouer ?">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>


                </div>
            </div>
        </div>

    </div>


</body>

</html>