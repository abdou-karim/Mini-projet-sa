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
$informations=file_get_contents("../ASSET/JSON/questions.json"); 
$recuper= json_decode($informations,true);

if(isset($_POST["submit"])){

	if( !empty($_POST["nombre"]) && is_numeric($_POST["nombre"]) && ($_POST["nombre"] >=5  && $_POST["nombre"]<=@count($recuper)) ) {

		$_SESSION["nombre"]=$nombre=$_POST["nombre"];
		
		setcookie("fixe_question",$_SESSION['nombre'],(time()+60*60*24*365));
		
	}else{

		$_SESSION["nombre"]=5;
	
	}

}
if(isset($_COOKIE["fixe_question"])){

	$_SESSION["nombre"]=$_COOKIE["fixe_question"];
}else{
	$_COOKIE["fixe_question"]=5;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    <title>Liste_questions</title>
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
        <form action="" id="ma_form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input class="deconnexion" type="submit" name="deconnexion" value="Deconnexion">
    </div>
    <div class="blanche">
    <span class="question_droite">
        <div class="nombre_question">
           <div class="nbr_question"><span>Nombre de question?</span><input class="input_nombre" type="number" min="0" value="<?php echo $_COOKIE["fixe_question"] ?>" name="nombre" placeholder="nombre de question"><strong><input class="ok" type="submit" name="submit" value="OK"></strong></div>

           <div class="les_question">
               <div class="list_quest">
                   
                       <div class="ma_form">
                       <table>
		<?php
		
		
		
		if (isset($_POST['suivant'] ) && $_SESSION['fin']<$_SESSION["nombre"]) {
			
						$debut=$_SESSION['fin'];

						$fin=$_SESSION['fin']+5;

					}elseif (isset($_POST['precedent']) && $_SESSION['fin']>10) {

						$debut=$_SESSION['fin']-10;

						$fin=$_SESSION['fin']-5;
					}else
					{
						$debut=0;
						$fin=5;
					}
					$_SESSION['j']=$debut+1;
			for ($i=$debut; $i <$fin ; $i++) {
				if ($i<count($recuper)) {
					if(@$recuper[$i]["type_reponse"]=="texte"){

						 $question=$recuper[$i]["question"];
						  $reponse=$recuper[$i]["T_reponse"];

						  echo " <div id='affiche_question'>".$question."</div><br>";
						echo  "<div id='affiche_reponse'><input type='texte' readonly value='$reponse' style='font-weight: bold;text-align: center;border-radius: 5%;height: 30px;'></div><br>";
					}
					elseif(@$recuper[$i]["type_reponse"]=="simple"){

						$question=$recuper[$i]["question"];
						echo " <div id='affiche_question'>".$question."</div><br>";
						for($k=1;$k<=10;$k++){
							if(isset($recuper[$i]["Reponse$k"])){

								if($recuper[$i]["Radioreponse"]==$k){

									$reponse=$recuper[$i]["Reponse$k"];
									echo "<div id='affiche_reponse'><input  type='radio' disabled checked value='$reponse'>".$reponse."</div><br>";

							}
							if($recuper[$i]["Radioreponse"]!=$k){

								$bien=$recuper[$i]["Reponse$k"];
								echo "<div id='affiche_reponse'><input type='radio' disabled  value='$bien'>".$bien."</div><br>";
							}
						}
					}
				}
				elseif(@$recuper[$i]["type_reponse"]=="multiple"){
                     $question=$recuper[$i]["question"]."<br>";
					 echo " <div id='affiche_question'>".$question."</div><br>";
					 for($k=1;$k<=10;$k++){
						if(isset($recuper[$i]["Reponse$k"])){

							if(@$recuper[$i]["chekReponse$k"]==$k){
								$bonne=$recuper[$i]["Reponse$k"];
								echo "<div id='affiche_reponse'><input  type='checkbox' disabled checked value='$bonne'>".$bonne."</div><br>";
						}
						if(@$recuper[$i]["chekReponse$k"]!=$k){

							$bien=$recuper[$i]["Reponse$k"];
							echo "<div id='affiche_reponse'><input type='checkbox' disabled  value='$bien'>".$bien."</div><br>";
						}
						}
					 }
				}


				$_SESSION['j']++;
			}
		}
		$_SESSION['fin']=$fin;
				if (isset($_POST['suivant']) || $_SESSION['fin']>=9) {
					echo "<button  name='precedent' class='precedent'> Precedent</button> ";
				}
				?>
				<?php
				if ($_SESSION['fin']<count($recuper) ) {

					echo "<button  name='suivant' class='suivant'> suivant</button> ";
				}

		        ?>
		</table>
                       </div>

                    
                   
                   </form>
        
    
           </div>

           <div>
               
           </div>
           </div>
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
<script>
function validateForm(e) {
	var nombre=document.forms["ma_form"]["nombre"].value;
	var nombre_regex=/[1-9]+/;
	var taille=<?php echo count($recuper)?>;

	if(nombre_regex.test(nombre) && (nombre>=5 && nombre<=taille) ){
		// var date=new Date(Date.now()+86400000*365);
		// date=date.toUTCString();
		sessionStorage.setItem("Mon_nombre",nombre);
		var nombre_cookie=document.cookie=+nombre;+"path=/;domaie=listes_questions.php;expires max-age=31536000";
		
		var nombre_session=sessionStorage.getItem("Mon_nombre");
		
	}else{
		nombre_session=5;
	}

	if(nombre_cookie){
		nombre_session=nombre_cookie
	}else{
		nombre_cookie=5;
	}
	
}
</script>
</body>
</html>