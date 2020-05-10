var i=0;
function createReponse(){
    i++;
    var form=document.getElementById("mes_kestions");
    var choix=document.getElementById("creer_select").value;
    
    var newInput=document.createElement("div");
     newInput.innerHTML=
     ` 
        <input type="text" id="text_a" class="creerReponse" name="entrerReponse">
        <input type="radio" id="radio_a"  class="crerReponse" name="radioReponse">
        <input type="checkbox" id="checkbox_a"  class="crerReponse" name="checkboxReponse">
        <button type="button" id="button_a" name="supprime" class="crerReponse" onclick="g(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

`

newInput.setAttribute("class","row");
newInput.setAttribute("id","row_"+i);

 if(choix==="simple"){
    newInput.innerHTML=
    ` 
       <input type="text" id="text_a" class="creerReponse" name="entrerReponse">
       <input type="radio" id="radio_a"  class="crerReponse" name="radioReponse">
       <button type="button" id="button_a" name="supprime" class="crerReponse" onclick="g(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

` 
}else if(choix==="multiple"){
    newInput.innerHTML=
    ` 
       <input type="text" id="text_a" class="creerReponse" name="entrerReponse">
       <input type="checkbox" id="checkbox_a"  class="crerReponse" name="checkboxReponse">
       <button type="button" id="button_a" name="supprime" class="crerReponse" onclick="g(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

`
}else if(choix==="texte"){
    newInput.innerHTML=
    ` 
       <input type="text" id="text_a" class="creerReponse" name="reponse_texte">
       <button type="button" id="button_a" name="supprime" class="crerReponse" onclick="g(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>


` 
form.appendChild(newInput);
}   
    form.appendChild(newInput);
   
}
function supprime(n){
    let supprime=document.getElementById("row_"+n);
    
    setTimeout(function(){
        supprime.remove();
    },2000)
    fadeOut("row_"+n);
   

    }

    function fadeOut(idTarget){
        var supprime=document.getElementById(idTarget);
        var effect=setInterval(function(){
            if(!supprime.style.opacity){
                supprime.style.opacity=1;
            }
            if(supprime.style.opacity>0){
                supprime.style.opacity-=0.1
            }else{
                clearInterval(effect);
            }

        },200)
    }
    function onDeleteInput(n)
//  {

//     var target=document.getElementById('row_'+n);
//     target.remove();
    

//  }
   
// function type_reponse(value){
//     i++;
//     var form=document.getElementById("mes_kestions");
//     var newInput=document.createElement("div");
//     newInput.setAttribute("class","row");
//     newInput.setAttribute("id","row_"+i);

//   switch(value){
//       case "1":
       
//         newInput.innerHTML=
//      ` 
//         <input type="text" id="text_a" class="creerReponse" name="entrerReponse">
//         <div class="message_derreur" id="reponse_error"></div>
//         <input type="radio" id="radio_a"  class="crerReponse" name="radioReponse">
//         <button type="button" id="button_a" name="supprime" class="crerReponse" onclick="g(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

// ` 
//  form.appendChild(newInput);
//         break;
//         case "2":
//             newInput.innerHTML=
//      ` 
//         <input type="text" id="text_a" class="creerReponse" name="entrerReponse">
//         <div class="message_derreur" id="reponse_error"></div>
//         <input type="checkbox" id="checkbox_a"  class="crerReponse" name="checkboxReponse">
//         <button type="button" id="button_a" name="supprime" class="crerReponse" onclick="g(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

// `
// form.appendChild(newInput);
//             break;
//             case "3":
//                 newInput.innerHTML=
//      ` 
//         <input type="text" id="text_a" class="creerReponse" name="entrerReponse">
//         <div class="message_derreur" id="reponse_error"></div>
//         <button type="button" id="button_a" name="supprime" class="crerReponse" onclick="g(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

// ` 
//  form.appendChild(newInput);
//                 break;
//                 default:
                    
//                 alert("ok");       
//   }
// }
function validateForm(e){
    i++;
    var questions = document.forms["ma_form"]["creer_question"].value;
    var score=document.forms["ma_form"]["creer_nombre"].value;
    var select=document.forms["ma_form"]["selection"];
    var reponse=document.forms["ma_form"]["entrerReponse"];
    

    var questions_erreur=document.getElementById("questions_error");
    var score_erreur=document.getElementById("nombre_error");
    var select_erreur=document.getElementById("select_error");
    var reponse_erreur=document.getElementById("reponse_error");

    if(questions==""){
        
        questions_erreur.textContent="champ obligatoire* !";

        return false;
    }    
    else if(score==""){
        score_erreur.textContent="champ obligatoire* !";

        return false;
    }
    else if(select.selectedIndex==0){

        select_erreur.textContent="champ obligatoire* !";

        return false;
    }
    else if(reponse==""){

        reponse_erreur.textContent="champ reponse obligatoire* !";
        
        return false;
    }
}
















<!-- /*if(isset($_POST)){
    var_dump($_POST);
        if(!empty($_POST["question"]) && !empty($_POST["point"]) && ($_POST["reponse"]=="texte") && !empty($_POST['requettes'])){
    
    $question=$_POST['question'];
    $point=$_POST['point'];
    $reponse=$_POST['reponse'];
    $texte=$_POST['requette'];
    
    $creer_question=[
    "question"=>"$question",
    "point"=>"$point",
    "reponse"=>"$reponse",
    "texte"=>"$requettes",
    
    ];
    $fichier=('questions.json');
    $js=file_get_contents($fichier);
    $json=json_decode($js,true);
    
    $json[]=$creer_question;
    $encode=json_encode($json);
    file_put_contents($fichier,$encode);
    
    
    
    
    
    
            //echo "<h1>CA MARCHE BIEN</h1>";
        }
    }
    
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css\style.css">
        <title>questionaire</title>
    </head>
    <body>
    <div class="container">
        <div class="violet">
        <div class="logo"><img src="images\logo-QuizzSA.png" alt="SA.logo" height="100px"></div>
    
    <div class="heading">
        <h2>le plaisir de jouer</h2>
    </div>
    <div class="qustionaire_bleut">
            <h2>creer et parametrer vos quizz</h2>
            <form action="" method="post" enctype="multipart/form-data" id="ma_form"   onsubmit="return validateForm()">
                <input class="deconnexion" type="submit" name="deconnexion" value="Deconnexion">
        </div>
        <div class="question_blanche">
    
        <span class="questionaire_droite">
    <label for="parametre" id="setting"><h3>parametrer votre question</h3></label>
            <div class="genere">
                <form action="" method="post">
                <label for="question" class="label">Questions</label>
                <div class="input">
                    <input type="text" name="question" id="question">
                </div>
    
                <label for="score" class="label">Nbre de points</label>
                <div class="input">
                    <input type="text" name="point" id="point">
                </div>
    
                <label for="t_reponse" class="label">Type de Reponse</label>
             <div class="inputs">
                <div class="row" id="row_0">
                    <select name="reponse" id="reponse">
                        <option value=""></option>
                        <option value="texte">type Texte</option>
                        <option value="simple">type Simple</option>
                        <option value="multiple">type Multiple</option>
                    </select>
                    <span id="ajoute"><button type="button"  onclick="onAddInput()"><img id="ajoute_reponse" src="images\Icônes\ic-ajout-réponse.png" alt="ajoute"></button></span>
                </div>
    
             </div>
    
                <div class="submit">
                    <input type="submit" id="btn" name="enregistrer" value="Enregistrer">
                </div>
                </form>
            </div>
        </span>
        <span class="gauche">
                <div class="avatar_blue">
                <div class="admin"><img id="cercl" src="avatar/admin/<?php echo @$_SESSION["avatar"];?>" style="width:100%" alt="" /></div>
                    <div><span id="list_nom" ><?php  echo  " ".@$_SESSION["nomprenom"] ?></span></div>
                </div>
                <div class="questionaire_creation">
                <div class="label1"><a href="listes_questions.php">Liste question<img id="icone" src="images\Icônes\ic-liste-active.png" alt="logo.list"></a></div>
                    <div class="label1"><a href="creation_compte_admin.php">Créer admin<img id="icone" src="images\Icônes\ic-ajout.png" alt="logo.ajoute"></a></div>
                    <div class="label1"><a href="Liste_joueur.php">Liste joueur<img  id="icone" src="images\Icônes\icone.jpeg" alt="logo.list"></a></div>
                    <div class="label1"><a href="ceer_question.php">Créer question<img id="icone" src="images\Icônes\ic-ajout.png" alt="logo.ajoute"></a></div>
                </div>
    
                
            </span>
    
        </div>
        </div>
    </div>
    </div>
    <script src="css\questionaire.js"></script>
    </body>
    </html>*/ -->