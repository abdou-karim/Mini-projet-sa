<?php 
setcookie('login','');
setcookie('mdp','');
session_start();
header("location:index.php");


foreach($recuper as $value){
    for($a=0;$a<count($recuper);$a++){
        
        echo $b."-".$value["question"]."<br><br>";
        $question[]=$value["question"];
        $b++;
    break;
        
    }
    for($i=0;$i<count($value["reponse"]);$i++){
        $reponse[]=$value["reponse"];
        ?>

     <?php   if($value["type_reponse"]=="multiple"){ ?>

            <input type="checkbox"  name="" checked value="<?php echo $value["Bonnereponse"][$i] ?>"><?php echo $value["reponse"][$i]?><br><br>

      <?php  }elseif($value["type_reponse"]=="simple"){ 
          
          ?>

            <input type="radio"   disabled checked  value=" <?php echo $value["Bonnereponse"][$i];  ?>" ><?php echo $value["reponse"][$i]; $k++; ?><br><br>

      <?php  }elseif($value["type_reponse"]=="texte"){ ?>
           
            <input type="texte"name="reponse[]" readonly value="<?php echo $value["reponse"][0]?>"><br><br>
           
        <?php } ?>

        

    <?php } ?>
     
<?php } ?>
<?php




?>