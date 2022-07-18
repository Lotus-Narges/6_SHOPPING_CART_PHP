<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CDN - CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
    <title>Add your product</title>
</head>
    <body id="index-body">
        <div id="wrapper">
            <?php
            //?localhost:8888/ApplicationWEB-PANIER-PHP-Part6/index.php
            session_start();
            require 'countCart.php';
            ?>

            <header>
                <h2> WELCOME </h2>
                <nav id="index-Nav">
                    <a class="link" href="index.php">Home</a>
                    <a class="link" href="#">Products</a>
                    <a class="link" href="#">Contact</a>
                    <a class="link" href="#">About us</a>
                    <a class="link" href="recap.php">Cart<span><?= productNum() ?></span></a>
                </nav>
            </header>

            <?php
            // * action -> redirection throught the file when user submit the informations
            // * The HTTP method which the data are gonna transfer to the server
            // * HTTP --> As a request-response protocol, HTTP gives users a way to interact with web resources such as HTML files by transmitting hypertext messages between clients and servers.
            // * method POST --> save all the date in an array " $_POST[] " with key & the value --> Not show up in url
            // * All the inputs are saved in $_POST[] superglobal & we have access to them by their name
            // * $_POST[] --> input name = key / input value = value
            // * input submit -> Allow us to verify that the data is submited by the user
            // * session_start() --> A native PHP function which allow us start the session or to get all the informations that already exist
            ?>
            <main>
                <h1>Add a product: </h1>
                <form action="traitement.php?action=add" method="post">
                    <p>
                        <label>
                            <p class="paragraph" >Name of the product:</p>
                            <input type="text" name="name">
                        </label>
                    </p>
                    <p>
                        <label>
                            <p class="paragraph" >Price of the product:</p>
                            <input type="number" step="any" name="price">
                        </label>
                    </p>
                    <p>
                        <label>
                            <p class="paragraph" >Number of the product:</p>
                            <input type="number" name="qtt" value="1">
                        </label>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Add the product">
                    </p>
                </form>
            </main>
        </div>
    </body>
</html>