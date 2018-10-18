<?php require_once ("header.php"); ?>
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
        <header><h1>Game Manager</h1></header>
        <main>
            <h1>Add Category</h1>
            <form action="add_category.php" method="POST">
                <label>Category Name:</label>
                <input type="text" name="categoryName" /><br/>
                <input type="submit" value="Add Category">
            </form>
        </main>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> My Game Shop, Inc.</p>
        </footer>        
    </body>
</html>
<?php require_once ("footer.php"); ?>
