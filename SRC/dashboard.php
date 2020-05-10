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
$informations=file_get_contents("../ASSET/JSON/fichier.json");
$informations=json_decode($informations,true);

for($i=0;$i<=@count($informations);$i++){
                    
    if(@$informations[$i]["Rolle"]=="user"){
$score[]=$informations[$i]["score"];
$user[]=$informations[$i]["prenom"]." ".$informations[$i]["nom"];

    }
}
    $new_score=json_encode($score);
    file_put_contents("../ASSET/JSON/dashboard.json",$new_score);
    $new_user=json_encode($user);
    file_put_contents("../ASSET/JSON/dashboard.json",$new_user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
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
</div>
<div class="blanche">
    <span class="question_droite">
    <canvas id="myChart"  height="200px" width="200px"></canvas>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea,

    // The data for our dataset
   
    data: {
        labels: <?php echo $new_user?>,
        label: 'Evolution admin',
        datasets: [{
            label: 'Top performance joueur',
          
            backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            '#48d1ac'
          ],
            borderColor: 'rgba(255, 159, 64, 0.6)',
            data: <?php echo $new_score?>
        }]
    },

    // Configuration options go here
    options: {}
});
    </script>
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