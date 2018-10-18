<?php
require_once ("header.php");
require_once ("database.php");

$query = "SELECT * FROM categories";
$statement = $db -> prepare($query);
$statement -> execute();
$categories_array = $statement->fetchAll();
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
            <h2>Add Game</h2>
            <form action="add_game.php" method="POST">
                <label>Category</label>
                <!-- CREATE A DYNAMIC DROP-DOWN LIST -->
                <select name="category_id">
                    <?php foreach ($categories_array as $category_row) : ?>
                    <option value="<?php echo $category_row["categoryID"]; ?>">
                        <?php echo $category_row["categoryName"]; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                    <br/>
                    <label>Code:</label>
                    <input type="text" name="code" /><br/>
                    <label>Name:</label>
                    <input type="text" name="name" /><br/>
                    <label>Price:</label>
                    <input type="text" name="price" /><br/>
                    <label>Image:</label>
                    <input type="text" name="image" /><br/>
                    <input type="submit" value="Add Game" />
            </form>
        </main>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
        </footer> 
    </body>
</html>
<?php require_once ("footer.php"); ?>
