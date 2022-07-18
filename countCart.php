<?php
//session_start();

// * How many elements we have in the cart
                
function productNum (){
    if (isset($_SESSION['products'])){
        $count = count($_SESSION['products']);
        return $count;
    }
}



?>