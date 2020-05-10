// var i=0;
// function createReponse(){
//     i++;
//     /*var form=document.getElementById("genere_question");
//     var choix=document.getElementById("t_reponse").value;
    
//     var newInput=document.createElement("div");

// newInput.setAttribute("class","row");
// newInput.setAttribute("id","row_"+i);

//  if(choix==="2"){
//     newInput.innerHTML=
//     ` 
//     <label for="simple" class="labell">Type Simple_${i}</label>
//        <input type="text"  class="g_input" >
//        <input type="radio" class="idem">
//        <button type="button"  name="supprime" class="idem" onclick="supprime(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

// ` ;
// }else if(choix==="3"){
//     newInput.innerHTML=
//     ` 
//     <label for="multiple" class="labell">Type multiple_${i}</label>
//        <input type="text" class="g_input"  name="multiple${i}">
//        <input type="checkbox" class="idem" >
//        <button type="button" class="idem" name="supprime" onclick="supprime(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>

// `;
// }else if(choix==="1"){
//     newInput.innerHTML=
//     ` 
//     <label for="words" class="labell">Type Texte_${i}</label>
//        <input type="text" class="g_input" name="ma_texte" id="ma_texte">
//        <button type="button"  name="supprime" class="idem" onclick="supprime(${i})"><img src="ic-supprimer.png" alt="supprime" ></button>


// ` ;

// }   
//     form.appendChild(newInput);
   
// }
// function supprime(n){
//     let supprime=document.getElementById("row_"+n);
    
//     setTimeout(function(){
//         supprime.remove();
//     },2000)
//     fadeOut("row_"+n);
   

//     }

//     function fadeOut(idTarget){
//         var supprime=document.getElementById(idTarget);
//         var effect=setInterval(function(){
//             if(!supprime.style.opacity){
//                 supprime.style.opacity=1;
//             }
//             if(supprime.style.opacity>0){
//                 supprime.style.opacity-=0.1
//             }else{
//                 clearInterval(effect);
//             }

//         },200)
//     }*/

    
var nbreLigne= 0 ;
function onAddInput()
{
    nbreLigne++;
var reponse=document.getElementById('reponse');
    var divInput=document.getElementById('inputs');

    var newInput=document.createElement('div');

    newInput.setAttribute('class','row');

    newInput.setAttribute('id','row_'+nbreLigne);

    newInput.style.marginTop="5px";
 
 
  if(reponse.value=="multiple"){
    
    var tot=document.getElementById('inputs').childNodes.length;
    tot-=1;
   if(tot==0){
    tot=1;
    }else{
   tot++;
   }
  
    newInput.innerHTML=`<strong style="font-size: 22px;">Réponse multiple </strong>
   <input type="text" name="requette`+tot+`" style=" height:35px;width:280px" >
   <input type="checkbox" name="chekbox" id="" >
   <button type="button" onclick="onDeleteInput(${nbreLigne})" style=" padding:0px"><img style="width:20px,height:20px" src="../ASSET/IMG/ic-supprimer.png" alt="

  `;

   divInput.appendChild(newInput);

    } else if(reponse.value=="simple"){
        
        var tot=document.getElementById('inputs').childNodes.length;
        tot-=1;
    if(tot==0){
        tot=1; 
    }else{
    tot++;
    }
    
    newInput.innerHTML=` <strong style="font-size: 22px;">Réponse simple </strong>
    <input type="text" name="requette`+tot+`" style=" height:35px;width:280px" >
    <input type="radio" name="radio" id="" >
    <button type="button" onclick="onDeleteInput(${nbreLigne})" style=" padding:0px"><img style="width:20px,height:20px" src="../ASSET/IMG/ic-supprimer.png" alt=

    `;
    
      divInput.appendChild(newInput);


     }else if(reponse.value=="texte") {
        
        //var bouton=document.getElementById("bouton");
        //bouton.disabled==true;

       newInput.innerHTML=` <strong style="font-size: 22px;">Réponse texte</strong>
       <input type="text" name="requettes" id="requette2" style=" height:40px;width:280px" >
       <button type="button" onclick="onDeleteInput(${nbreLigne})" style=" padding:0px"><img style="width:20px,height:20px" src="../ASSET/IMG/ic-supprimer.png" a
   
      `;

    divInput.appendChild(newInput);


      }else{}


}
 function onDeleteInput(n)
 {

    var target=document.getElementById('row_'+n);
    target.remove();
    

 }


var question=document.getElementById('question');
var question_error=document.getElementById('question_error');
var regex_question=/^[A-Z][^.;!:]+[.!:?]$/;

var point=document.getElementById('point');
var point_error=document.getElementById('point_error');


var reponse =document.getElementById('reponse');
var reponse_error=document.getElementById('reponse_error');

var validation= document.getElementById('validation');
validation.addEventListener('click',enregistrer);


function enregistrer(e){
if (question.value=="")
    {
       e.preventDefault();
       question.style.border=" solid 1px red";

    }else if(regex_question.test(question.value)==false)
      {
         e.preventDefault();
         question_error.innerHTML="Format incorrecte";

      }else{}


 if (point.value=="")
    {
       e.preventDefault();
       point.style.border=" solid 1px red";
    
    }else{}


 if(reponse.value=="")
        {
            e.preventDefault();
            reponse.style.border="solid 1px red";
        }else{}




}



  





































