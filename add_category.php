<?php
require_once ("header.php");
require_once ("database.php");

// get category_name from the form
$category_name = filter_input(INPUT_POST, "categoryName");

if(!isset($category_name))
{
    include("add_category_form.php");
    exit();
}

$queryInsertCategory = "INSERT INTO categories (categoryName) VALUES (:np_category_name)";
$statement = $db -> prepare($queryInsertCategory);
$statement -> bindValue(":np_category_name", $category_name);
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
            <h1>Add Category</h1>
            Category Added!
        </main>
        <br>
        <a href="admin_panel.php">Back</a>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> My Game Shop, Inc.</p>
        </footer>        
    </body>
</html>
<?php require_once ("footer.php"); ?>
