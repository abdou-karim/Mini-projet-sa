<?php 
session_start();
if(isset($_POST["rejouer"])){
    header("location:../ASSET/SRC/page_de_jeux.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ASSET/CSS/style.css">
    <title>Jeux_terminer</title>
</head>
<body>
<div class="containerR">

<div class="violet">
    <div class="logo"><img src="../ASSET/IMG/logo-QuizzSA.png" alt="SA.logo" height="100px"></div>

    <div class="heading">
        <h2>le plaisir de jouer</h2>
    </div>
    <form action="" method="post">
    <input class="rejouer" type="submit" name="rejouer" value="Retour">
    </form>
</div>
<div id="jeux_end">
    <span id="termine_gauche">
<?php 
$final=file_get_contents("../ASSET/JSON/reponse.json");
$final=json_decode($final,true);
for($i=0;$i<count($final);$i++){
  $question[]=@$final[$i]["Question"];
  $correcte[]=@$final[$i]["BonneReponse"];

  for($a=0;$a<@count($final["$i"]["GoodReponse"]);$a++){

      $correcte[]=@$final[$i]["GoodReponse"][$a];
  }

  $mauvaise[]=@$final[$i]["MauvaiseReponse"];
  for($b=0;$b<@count($final["$i"]["BadReponse"]);$b++){

    $mauvaise[]=@$final[$i]["BadReponse"][$b];
  }
}



?>
<div id="jeux_affichage">
  <table>
                  
                  <tr>
                  
                    <th class="ab">Joueur</th>
                    <th class="ab">Questions</th>
                    <th class="ab">Bonnes reponses</th>
                    <th class="ab">Mauvaises reponses</th>
                    <th class="ab">Score</th>
                  </tr>
                  <tr>
                    <td><?php echo  $_SESSION["nomprenom_joueur"] ?></td>
                    
                    <td><?php foreach($question as $quest){ echo $quest."<br>"; }  ?></td>
                    <td><?php foreach($correcte as $corect){ echo $corect."<br>"; }   ?></td>
                    <td><?php foreach($mauvaise as $mauvai){ echo $mauvai."<br>"; }  ?></td>
                    <td><?php echo @$_SESSION["score"]."<br>";   ?></td>
                  </tr>
                  </table>
                  </div>
    </span>
   
</div>
</div>

</body>
</html>