<?php


function modulo( $limit) {

    for($i=1; $i <=$limit;$i++){
        if($i%15 == 0){
            echo "MeinFernbusFlixBus\n";
        }elseif($i%3 == 0){
            echo "MeinFernbus\n";
        }elseif($i%5 == 0){
            echo "FlixBus\n";
        }else{
            echo "{$i}\n";
        }
    }

}

$__fp = fopen("php://stdin", "r");

fscanf($__fp, "%d", $_limit);

modulo($_limit);



