<?php 
session_start();
if(isset($_POST["terminer"])){
	header("location:../SRC/Termine_jeux.php");
}


	$informations=file_get_contents("../ASSET/JSON/questions.json"); 
	$recuper= json_decode($informations,true);

	if(isset($_COOKIE["fixe_question"])){

		$_SESSION["nombre"]=$_COOKIE["fixe_question"];
	}else{
		$_COOKIE["fixe_question"]=5;
	}

	if(isset($_POST["suivant"])){
		
		@$_SESSION["partie"][$_POST["num"]]["choix"]=@$_POST["Reponse"];

	
		$debut=$_SESSION['fin'];
		//désigne le nbre de question qui suit
		$fin=$_SESSION['fin']+1;
		
		
	}	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    
    
    
    <title>Page de jeux</title>

</head>
<body >

<div class="container">

<div class="violet">
    <div class="logo"><img src="../ASSET/IMG/logo-QuizzSA.png" alt="SA.logo" height="100px"></div>

    <div class="heading">
        <h2>le plaisir de jouer</h2>
    </div>
</div>
<div class="jeux_blanche">
	<span id="jeux_droite">
	<span class="t_score">
	<?php 
	
                $joueur_nom=[];
                $joueur_prenom=[];
                $score=[];
                    @$liste=file_get_contents("../ASSET/JSON/fichier.json");
                   
					@$liste=json_decode($liste,true);

					if(@$liste){
			$tab=[];
			foreach($liste as $value){
			if(@$value["Rolle"]=="user"){
			$tab[]=array
			(
			"nom"=>@$value["nom"],
			"prenom"=>@$value["prenom"],
			"score"=>@$value["score"],
	);
}
}
					}
					$colone=array_column($tab,"score");
					array_multisort($colone,SORT_DESC,$tab);
					echo "<a href='#Top scores'><em style='margin-left: 70px;'>Top scores</em></a>";
							 ?>
							 <table>
								 <td><strong>Nom</strong></td>
								 <td><strong>Prenom</strong></td>
								 <td><strong>score</strong></td>
								 <?php 
								 for($i=0;$i<5;$i++){
									 echo "<tr>";
									 echo "<td><br>".$tab[$i]["nom"]."</td>";
									 echo "<td><br>".$tab[$i]["prenom"]."</td>";
									 echo "<td><br>".$tab[$i]["score"]."Pts</td>";
									 echo "</tr>";
								 }
								 ?>
							 </table>
								

	</span>
	<span class="m_score">
		<?php 
		echo "<a href='#Mon meilleur score<'><em style='margin-left: 70px;'>Mon meilleur score</em></a>";
		?>
	</span>
	</span>
	<span id="jeux_gauche">
	<div class="jeux_admin"><img id="jeux_cercl" src="<?php echo  $_SESSION["user_image"];?>" alt="" /></div> 
	<div style="float: left;color:silver;font-weight:boldy;margin-left:10px"><?php ?></div>
		
	<div id="jeux_partie">
		<form action="" method="post">
			
		<?php 
if(empty($_SESSION["partie"])){
	$informations=file_get_contents("../ASSET/JSON/questions.json"); 
	$recuper= json_decode($informations,true);
	
	$_SESSION["partie"]=$recuper;
}


		if (isset($_POST['suivant'] ) && $_SESSION['fin']<count($_SESSION["partie"])) {
		}elseif (isset($_POST['precedent']) && $_SESSION['fin']>2) {

			$debut=$_SESSION['fin']-2;

			$fin=$_SESSION['fin']-1;
			
		}else
		{
			$debut=0;
			$fin=1;
		}
		$_SESSION['j']=$debut+1;
		for($i=$debut;$i<$fin;$i++){ 

			$_SESSION["question"]=$recuper[$i]["question"];
			
			?>
					
			<div class="jeux_question"><label id="labquest" for="">Question <?php echo $i."/".$_COOKIE["fixe_question"]?></label></div>
			
			
		<?php	if($i<$_COOKIE["fixe_question"]){ 
			
			
			?>

			<div id="afficher_question"><label id="labquestion" for=""><?php echo $_SESSION["partie"][$i]["question"] ?></label></div>
			<div id="mon_score"><?php echo $_SESSION["partie"][$i]["score"]?></div>
			<input type="hidden" name="num" value="<?php echo $i?>" >
			<?php	if($_SESSION["partie"][$i]["type_reponse"]=="texte"){  $reponse=$_SESSION["partie"][$i]["T_reponse"];
				
				if(isset($_SESSION["partie"][$i]["choix"])){
					

					if($_SESSION["partie"][$i]["choix"]==$_SESSION["partie"][$i]["T_reponse"]){
						$_SESSION["score"]=$_SESSION["score"]+ $_SESSION["partie"][$i]["score"];
						$_SESSION["Mes_reponses"]=[
							"Question"=> $_SESSION["partie"][$i]["question"],
							"BonneReponse"=>$_SESSION["partie"][$i]["T_reponse"],
							
						];
					}else{
						$_SESSION["Mes_reponses"]=[
							"Question"=> $_SESSION["partie"][$i]["question"],
							"MauvaiseReponse"=> $_SESSION["partie"][$i]["choix"],
							"BonneReponse"=>$_SESSION["partie"][$i]["T_reponse"],
						];
					}
					
					
				
				?>

					
					<div id="jeux_Treponse"><input id="Treponse" type="texte" name="Reponse" value="<?php echo $_SESSION["partie"][$i]["choix"] ?>" style="font-weight:bold;color:;text-align:center;height: 40px;width:30%;border-radius:5%;"></div>

				<?php	}else{ ?>

	<div id="jeux_Treponse"><input id="Treponse" type="texte" name="Reponse" value="" style="height: 40px;width:30%;border-radius:5%;"></div>
		<?php		}
			
		}elseif($_SESSION["partie"][$i]["type_reponse"]=="simple"){ 
				
				for($k=1;$k<=10;$k++){

					if(isset($_SESSION["partie"][$i]["Reponse$k"])){
					// if(($recuper[$i]["Radioreponse"]==$k)){

						$justeS=$_SESSION["partie"][$i]["Reponse$k"] ;

						

						

						if(isset($_SESSION["partie"][$i]["choix"]) && "Reponse".$_SESSION["partie"][$i]["choix"]=="Reponse$k"){

						 $r=$_SESSION["partie"][$i]["choix"];
						 $numj=$_SESSION["partie"][$i]["Radioreponse"] ;
							echo $_SESSION["partie"][$i]["Reponse$r"];

							$_SESSION["score"]=$_SESSION["score"]+ $_SESSION["partie"][$i]["score"];
							if($_SESSION["partie"][$i]["choix"]==$_SESSION["partie"][$i]["Radioreponse"]){
								$_SESSION["Mes_reponses"]=[
									"Question"=> $_SESSION["partie"][$i]["question"],
									"BonneReponse"=> $_SESSION["partie"][$i]["Reponse$r"],
								];
							}else{
								$_SESSION["Mes_reponses"]=[
									"Question"=> $_SESSION["partie"][$i]["question"],
									"BonneReponse"=> $_SESSION["partie"][$i]["Reponse$numj"],
									"MauvaiseReponse"=>$_SESSION["partie"][$i]["Reponse$r"]
								];
							}
						 
						
						?>

<div id="jeux_reponse"><input class='mput' type="radio" name="Reponse" checked value="<?php echo $k ?>"><label class="reslabe" for="Reponse"><?php echo $justeS."<br>"?></label></div>
			<?php	}else{
				
				//}
					// if($recuper[$i]["Radioreponse"]!=$k){

					// 	$autreReponse=$recuper[$i]["Reponse$k"]; ?>
<div id="jeux_reponse"><input  class='mput' type="radio" name="Reponse" value="<?php echo $k ?>"><label class="reslabe" for="Reponse"><?php echo $justeS."<br>"?></label></div>

					<?php	}	//}

					
}
					

				}
			

			 }elseif($recuper[$i]["type_reponse"]=="multiple"){

				for($k=1;$k<=10;$k++){

					if(isset($_SESSION["partie"][$i]["Reponse$k"])){

						// if(@$recuper[$i]["chekReponse$k"]==$k){

					$justeC=$_SESSION["partie"][$i]["Reponse$k"]; 
					
				 $chek=@$_SESSION["partie"][$i]["chekReponse$k"];
					if(isset($_SESSION["partie"][$i]["choix"]) && in_array($k,$_SESSION["partie"][$i]["choix"] )){
				
				foreach($_SESSION["partie"][$i]["choix"] as $value){
				
					if($value==@$_SESSION["partie"][$i]["chekReponse$k"]){
					$checktable[]=$_SESSION["partie"][$i]["Reponse$chek"];
					$chekt[]=$_SESSION["partie"][$i]["Reponse$value"];
					$_SESSION["score"]=$_SESSION["score"]+ $_SESSION["partie"][$i]["score"];
						$_SESSION["Mes_reponses"]=[
							"Question"=> $_SESSION["partie"][$i]["question"],
							"GoodReponse"=>$checktable,
								
							
						];
					}else{
						$_SESSION["Mes_reponses"]=[
							"Question"=> $_SESSION["partie"][$i]["question"],
							"GoodReponse"=>$checktable,
							"BadReponse"=> $chekt,
							
						];
					}
					
				}
					
						
					?>

					<div id="jeux_reponse"><input class='mput'type="checkbox" name="Reponse[]" checked value="<?php echo $k?>"><label class="reslabe" for="Reponse"><?php echo $justeC."<br>"?></label></div>

				<?php	
					}else{
						
					 //}
					// if(@$recuper[$i]["chekReponse$k"]!=$k){

					// 	$autreReponseC=$recuper[$i]["Reponse$k"]; ?>

<div id="jeux_reponse"><input class='mput' type="checkbox" name="Reponse[]" value="<?php echo $k?>"><label class="reslabe" for="Reponse"><?php echo $justeC."<br>"?></label></div>
					<?php	}	//}
					}
				}

			 }
			 $_SESSION['j']++;

			}
			if(isset($_POST["suivant"]) || isset($_POST["terminer"])){

				$js=file_get_contents("../ASSET/JSON/reponse.json");

				$js=json_decode($js,true); 
					   
					$js[]=$_SESSION["Mes_reponses"];
					$js=json_encode($js);
					file_put_contents("../ASSET/JSON/reponse.json",$js);
	
			}
			
		
	}
		$_SESSION['fin']=$fin;
		?>

		<?php	if (isset($_POST['suivant']) ||  $_SESSION["fin"]>=3) { ?>

					<button id="previous" name='precedent'> Precedent</button>

		<?php		}
			
				
				if ($i<$_COOKIE["fixe_question"]){ ?>

					<button id="next"  name='suivant'> suivant</button>

			<?php	}elseif($i=$_COOKIE["fixe_question"]){ ?>

					<button  name='terminer' id="termine"  >Terminer</button>

		<?php		 
			}




				?>
				</form>
	</div>
	

	</span>

</div>


</div>>
</body>
</html>