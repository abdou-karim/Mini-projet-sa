<?php 
function test_phrase($phrase){
    $phrase_valide="";
    if(preg_match_all("#^[A-Z][-a-zA-Zâeîéèê0-9_,' ]+[!.?]$#",$phrase)){
        $phrase_valide=$phrase;

        return $phrase_valide;
    }
}

//retourner le nombre de caractere d une chaine
function nombre_caractere ($carractere){
    $nombre=0;
    for ($i=0; (isset($carractere[$i])); $i++) { 
       $nombre++;
    }
    return $nombre;
}
function supprime_espace($chaine){
    $new = '';
    for ($i=0; $i <nombre_caractere($chaine) ; $i++) { 
                if($chaine[$i] !=' '){

                    $new .=$chaine[$i];
                }
    }
    return $new;
}


//Fonction caractere numerique
function Numerique($valeur)
{
    $tab=['0','1','2','3','4','5','6','7','8','9',''];
    $resultat = 0;
    for ($i=0; $i < nombre_caractere($tab); $i++) { 
        
        for ($j=0; $j < nombre_caractere($valeur) ; $j++)
        { 
            
            if (isset($tab[$i]) && isset($valeur[$j]))
            {
                if ($valeur[$j] != $tab[$i] )
                {
                    $resultat = 1;
                    
                
                }
            }
        }
    }

    return $resultat;
}
function test_reponse(array $reponse){
    $reponse_valide[]="";
    for($index=0;$index<100;$index++){
    if(preg_match_all("#^[A-Z][-a-zA-Z0-9_, ]?+[!.,?]?$#",$reponse[$index])){
        $reponse_valide[]=$reponse[$index];

        return $reponse_valide;
    }
}
}



?>