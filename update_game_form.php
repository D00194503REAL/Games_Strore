<?php
require_once ("header.php");
require_once ("database.php");

$category_id = filter_input(INPUT_POST, "category_id");
$game_id = filter_input(INPUT_POST, "game_id");

$queryGame = "SELECT * FROM games WHERE gameID = :np_game_id";
$statement = $db -> prepare($queryGame);
$statement -> bindValue(":np_game_id", $game_id);
$statement -> execute();
$game_array = $statement -> fetch();
$statement -> closeCursor();

$queryCategories = "SELECT * FROM categories";
$statement1 = $db -> prepare($queryCategories);
$statement1 -> execute();
$categories = $statement1 -> fetchAll();
$statement1 -> closeCursor();
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
            <h1>Update Game</h1>
            <form action="update_game.php" method="POST">
                <input type="hidden" name="game_id" value="<?php echo $game_id; ?>"/>
                <label>Category:</label>
                <select name="category_id">
                    <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category["categoryID"]; ?>">
                        <?php
                        if ($category["categoryID"] == $category_id) {
                            echo "selected";

                        }
                        ?>
                            
                        <?php echo $category["categoryName"]; ?>
                    </option> 
                    <?php endforeach; ?>
                </select>
                <input type="text" name="category_id" value="<?php echo $game_array["categoryID"]; ?>" /><br/>
                    <label>Category:</label>
                    <input type="text" name="code" value="<?php echo $game_array["gameCode"]; ?>"/><br/>
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo $game_array["gameName"]; ?>"/><br/>
                    <label>Price:</label>
                    <input type="text" name="price" value="<?php echo $game_array["listPrice"]; ?>"/><br/>
                    <input type="submit" value="Update Game" />
                </form>
        </main>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> My Game Shop, Inc.</p>
        </footer> 
    </body>
</html>
<?php require_once ("footer.php"); ?>

