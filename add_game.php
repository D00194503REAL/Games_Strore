<?php
require_once ("header.php");
require_once ("database.php");

// get the values from the form
$category_id = filter_input(INPUT_POST, "category_id");
if(!isset($category_id))
{
    include("add_game_form.php");
    exit();
}
$code = filter_input(INPUT_POST, "code");
$name = filter_input(INPUT_POST, "name");
$price = filter_input(INPUT_POST, "price");
$image = filter_input(INPUT_POST, "image");
        
$insertQuery = "INSERT INTO games (categoryID, gameCode, gameName, listPrice, gameImage)"
        . " VALUES (:np_category_id, :np_code, :np_name, :np_price, :np_image)";
$statement = $db -> prepare($insertQuery);
$statement -> bindValue(":np_category_id", $category_id);
$statement -> bindValue(":np_code", $code);
$statement -> bindValue(":np_name", $name);
$statement -> bindValue(":np_price", $price);
$statement -> bindValue(":np_image", $image);
$statement -> execute();
$statement -> closeCursor();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header><h1>Game Manager</h1></header>
        <main>
            <h1>Add a Game</h1>
            Game Added!
        </main>
        <br>
        <a href="admin_panel.php">Back</a>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
        </footer>
    </body>
         
</html>
<?php require_once ("footer.php"); ?>
