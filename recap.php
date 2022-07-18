<?php
// * recap.php --> shows us all the products saved in $_SESSION[] & the price total
// * Here we need to be able to browse the $_SESSION[] table
// * We verify 2 condition: 1- $_SESSION[] --> Doesn't exist, 2- $_SESSION[] --> is empty
// * number_format() --> Allows us to modify the way the numbers will show up (Accept 2 or 4 parameters)
// * string number_format ( float $number , int $decimals = 0 )
// * string number_format ( float $number , int $decimals = 0 , string $dec_point = '.' , string $thousands_sep = ',' )
/*  number_format(
Variable to format,
Define the decimal numbers, 
Define the decimal separator, 
Define the thousand separator
);
*/
// * Calculating total price 


session_start();
require 'countCart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CDN - CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Summary of the products</title>
</head>

<div id="wrapper">
    <body id="recap-body">
        <header>
            <nav id="recap-Nav">
                <a class="link" href="index.php">Home</a>
                <a class="link" href="#">Products</a>
                <a class="link" href="#">Contact</a>
                <a class="link" href="#">About us</a>
                <a class="link" href="recap.php">Cart<span><?= productNum() ?></span></a>
            </nav>
        </header>
        <main>

            <?php

                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                    echo "<p>No product in session ...</p>";
                }else{
                    echo "<table id='table' class='table table-dark table-striped'>",
                            "<thead>",
                                "<tr>",
                                    "<th>#</th>",
                                    "<th>Name</th>",
                                    "<th>Price</th>",
                                    "<th>Quantity</th>",
                                    "<th>Total</th>",
                                    "<th>Remove</th>",
                                    "<th>Add one</th>",
                                    "<th>Remove one</th>",
                                "</tr>",
                            "</thead>",
                            "<tbody>";
                    $totalGeneral = 0;
                    foreach($_SESSION['products'] as $index => $product){
                        echo "<tr>",
                                "<td>" . $index . "</td>",
                                "<td>" . $product['name'] . "</td>",
                                "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                                "<td>" . $product['qtt'] . "</td>",
                                "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
                                "<td><a class='cart-button' href='traitement.php?action=remove&id=$index'>Remove</a></td>",
                                "<td><a class='cart-button' href='traitement.php?action=up-qty&id=$index'>  +1  </a></td>",
                                "<td><a class='cart-button' href='traitement.php?action=down-qty&id=$index'>  -1  </a></td>",
                            "</tr>";
                        $totalGeneral += $product['total'];
                    }
                    echo "<tr>",
                            "<td colspan=4>Total price : </td>",
                            "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
                            "<td colspan=3><a class='cart-button' href='traitement.php?action=remove-all&id=$index'>Remove all</a></td>",
                        "</tr>",
                    "</tbody>",
                    "</table>";}

                // * The function which shows the different messages
                    if(isset($_SESSION['message'])){
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                }
                
                //var_dump($_SESSION)

            ?>
        </main>
    </body>
</div>
</html>