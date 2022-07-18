<?php
// * Treat the query which provoked by index.php (<form action=" ..." )
// * we start the SESSION by session_start() to access to data stored in $_SESSION[] in the page --> Ends as soon as you close the browser
// * COOKIE[] --> Has a time limit & we can set the time limit
// * isset() --> Verify that the variable is declared (exists) and not NULL
// * Filtering the input dataType for the reason of security in the POST function
// * header("location: ... ") --> Redirect us to index.php if the condition of if statement is false (Code 302)
// * HEADER --> Before header we should not have echo/ print 
// * HEADER --> Should not stop the execution of the current script (Always last instruction or call the functions exit() / die() after).
// * Source: https://www.php.net/manual/fr/filter.filters.php (Validation dataType)
// * Saving the data in $_SESSION[] --> we create an associative array to store data
// * Registering the associative array in $_SESSION[] --> $_SESSION['products'][] = $product;
  

session_start();

  //! First security condition, we receive the data just by $_POST[submit] superglobal
  // ? we normally put all the codes here (in the function)

if(isset($_GET['action'])){
  switch($_GET['action']){
    case "add":
      if(isset($_POST['submit'])){

        //!Filter the input data type
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        // * FILTER_FLAG_ALLOW_FRACTION --> Allow us to accept "," or "." in float number
    
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
        // * FILTER_VALIDATE_INT --> Doesn't accept 0 = NULL
    
        if($name && $price && $qtt){
    
            //!Enregistrement du produit en session
            $product = [
              "name" => $name,
              "price" => $price,
              "qtt" => $qtt,
              "total" => $price * $qtt
            ];
    
            // * $_SESSION['products'][] = $product; --> the empty bracket [] --> Allows us to stock new products in array
            $_SESSION['products'][] = $product; 
        }
        //! Second security condition: if condition -> false / Null --> we enter traitement.php from index.php but we return to index.php
        header ("Location:index.php");
        }
    break;

//---------------------------------------------------------------------------------------------------------------------------------- 

    case "remove-all":
      unset($_SESSION['products']);
      // * We put the message befor redirection
      // * We create ['message'] & we associate a value to it in the same time
      $_SESSION['message'] = "All the products have been removed.";
      header ("Location:recap.php");
    break;

//---------------------------------------------------------------------------------------------------------------------------------- 

    case "remove":
      // * Remove A product from the cart
      unset($_SESSION['products'][$_GET['id']]);
      $_SESSION['message'] = "Product has been removed.";
      header ("Location:recap.php"); 
    break;

//-------------------------------------------------------------------------------------------------------------------------------- 

    case "up-qty":
      if(isset($_SESSION['products'])){
        $_SESSION['products'][$_GET['id']]['qtt']++;
        $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];
        $_SESSION['message'] = "Product added.";
        header ("Location:recap.php"); die;
      }
    break;

//---------------------------------------------------------------------------------------------------------------------------------- 

    case "down-qty":

      if($_SESSION['products'][$_GET['id']]['qtt'] > 1){
        $_SESSION['products'][$_GET['id']]['qtt']--;
        $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];
      }else{
        unset($_SESSION['products'][$_GET['id']]);
      }
      $_SESSION['message'] = "Product removed.";
      header ("Location:recap.php"); die;   
    break;


  }

}

  
  
?>