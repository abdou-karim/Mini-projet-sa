
var nbreLigne= 0 ;

function onAddInput()
{
    nbreLigne++;
   

    var divInput=document.getElementById('affiche');
    var reponse=document.getElementById("type_reponse")
   

    var newInput=document.createElement('div');

    newInput.setAttribute('class','row');

    newInput.setAttribute('id','row_'+nbreLigne);

    newInput.style.marginTop="5px";
 
 
  if(reponse.value=="multiple"){
    
    newInput.innerHTML=`<label for="" class="labell">Type Multiple</label>
   <input type="text" name="Reponse${nbreLigne}" class="g_input" >
   <input type="checkbox" name="chekReponse${nbreLigne}"  value="${nbreLigne}" id="t_checkbox">
   <button type="button" onclick="onDeleteInput(${nbreLigne})" ><img src="ic-supprimer.png" alt="supprime" ></button> 
    

  `;

   divInput.appendChild(newInput);

    } else if(reponse.value=="simple"){
       
    
    newInput.innerHTML=` <label for="" class="labell">Type Simple</label>
    <input type="text" name="Reponse${nbreLigne}"  class="g_input">
    <input type="radio" name="Radioreponse" id="t_radio" value="${nbreLigne}" >
    <button type="button" onclick="onDeleteInput(${nbreLigne})" ><img src="ic-supprimer.png" alt="supprime" ></button> 

    `;
    
      divInput.appendChild(newInput);


     }else if(reponse.value=="texte") {

       newInput.innerHTML=` <label for="" class="labell">Type Texte</label>
       <input type="text" name="T_reponse" id="requette2"  class="g_input">
       <button type="button" onclick="onDeleteInput(${nbreLigne})" ><img src="ic-supprimer.png" alt="supprime" ></button> 
   
      `;

    divInput.appendChild(newInput);


      }


}
 function onDeleteInput(n){
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
   


var question=document.getElementById('question');
var reponse =document.getElementById('type_reponse');
var score=document.getElementById('point');
var answer2=document.getElementById('requette2');
var regex_question=/^[A-Z][a-zA-Zéè ]+[.!?]$/;
var regex_answer=/[a-zA-Zêéèâî':,;]+[.!:?]?/;






var reponse_erreur=document.getElementById('reponse_error');
var question_erreur=document.getElementById('question_error');
var score_erreur=document.getElementById('score_error');

var validation= document.getElementById('btn');
validation.addEventListener('click',enregistrer);


function enregistrer(e){
if (question.value=="")
 {
       e.preventDefault();
       question.style.border=" solid 1px red";
       question_erreur.innerHTML="Champs obligatoire*!"

    }else if(regex_question.test(question.value)==false)
      {
         e.preventDefault();
         question_erreur.innerHTML="Format incorrecte";
         question.style.border=" solid 1px green";

      }


 if (score.value=="")
    {
       e.preventDefault();
       score_erreur.innerHTML="Champs obligatoire*!"
       score.style.border=" solid 1px red";
    
    }else{
        score.style.border=" solid 1px green";
    }


 if(reponse.value=="defaut")
        {
            e.preventDefault();
            reponse.style.border="solid 1px red";
            reponse_erreur.innerHTML="Champs obligatoire*!"
           
        }
        else{
            reponse.style.border="solid 1px green";
        }




}