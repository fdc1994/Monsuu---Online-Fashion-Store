<?php


    include("ligacao.php");
    
    $sqlIncrement= "UPDATE visitors SET visitors = visitors + 1";
    if ($ligacao -> query ($sqlIncrement) === TRUE) {
        //echo( "sucesso");

    }
    else{
        //echo "não foi possivel escrever na BD";
    }
    
    
 ?>