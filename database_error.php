<?php require_once ("header.php");?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header><h1>My Games Store</h1></header>
        <main><h1>Database Error</h1>
        <?php
            echo '$error_message';
        ?>
        </main>
        <footer>
            <p>&copy; <?php echo date("Y") ?> My Games Store</p>
        </footer>
    </body>
</html>
<?php require_once ("footer.php"); ?>
