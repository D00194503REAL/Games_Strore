<?php
session_start();
require_once ("header.php");
if ($_SESSION["access_level"]!=1) {
    header("Location: index.php");
}
?>
<?php
// pass control
require ("database.php");

//step 1 Write the query
$query = "SELECT * FROM categories ORDER BY categoryID";
//step 2 prepare the query
//more secure allows us to sanitise our query
$statement = $db->prepare($query);
//step 3 Executing the qouery
// query results returned are saved in $statement
$statement->execute();
//step 4 saving the results of the query in $categories
$categories = $statement->fetchALL();
//print_r($categories);
//step 5 Freeing the connection
$statement->closeCursor();
//check if category ID is set otherwise display category 1 
if (!isset($category_id)){
    $category_id = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT);
    if ($category_id == null || $category_id == false){
        $category_id = 1;
    }
}

//GET the category name using the above $category_id
//specify named parameter to :category_id
//it allows to swap out the dynamic data 
//bind value to a named parameter... NB :category_id in SELECT must match in bindValue
//
//after ->fetch()... make sure categoryName matches whats in the database 

$queryCategory = "SELECT categoryName FROM categories WHERE categoryID = :category_id";
$statement1 = $db -> prepare($queryCategory);
$statement1 -> bindValue(":category_id", $category_id);
$statement1 -> execute();
$category = $statement1->fetch();
$category_name = $category["categoryName"];
$statement1->closeCursor(); //close so that it keeps connection open for next query

$queryGame = "SELECT gameID, gameCode, gameName, listPrice, gameImage FROM games WHERE categoryID = :category_id";
$statement2 = $db -> prepare($queryGame);
$statement2 -> bindValue(":category_id", $category_id);
$statement2 -> execute();
$games = $statement2->fetchAll();
$statement2->closeCursor();


?>
<link href="css/main.css" rel="stylesheet" type="text/css"/>
<header><h1>Games Manager</h1></header>
        <main>
            <h1>Games List</h1>
            <aside>
                <nav>
                    <ul>
                        <!--Hardcoded version not using the foreach loop
                        <li>Guitar</li>
                        <li>Basses</li>
                        <li>Drums</li>
                        -->
                        <?php foreach ($categories as $category): ?>                        
                        <li>
                            <!--
                            anchor sends to category selected and display
                            -->
                            <a href="admin_panel.php.?category_id=<?php echo $category["categoryID"]; ?>">
                            <?php echo $category["categoryName"];?>
                            </a>
                            <?php endforeach;?>

                        </li>
                        
                    </ul>
                </nav>
            </aside>
            <section>
                <h2><?php echo $category_name; ?></h2>
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>
                    
                        <?php foreach ($games as $game): ?>
                    <tr>
                        <td><img style="width: 55px; height: 70px" src="images/<?php echo $game["gameImage"];?>" alt=""/></td>
                        <td><?php echo $game["gameCode"];?></td>
                        <td><?php echo $game["gameName"];?></td>
                        <td><?php echo $game["listPrice"];?></td> 
                        <td>
                            <form action="update_game_form.php" method="POST">
                                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>"/>
                                <input type="hidden" name="game_id" value="<?php echo $game["gameID"]; ?>"/>
                                <input type="submit" value="Update">
                            </form>
                        </td>
                        <td>
                            <form action="delete_game.php" method="POST">
                                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>"/>
                                <input type="hidden" name="game_id" value="<?php echo $game["gameID"]; ?>"/>
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                        <?php endforeach;?>                        
                    </tr>
                </table>
                <br>
                <a href="add_category_form.php" class="button" style="width: 8em; text-align: center;">Add Category</a>
                <br>
                <br>
                <a href="add_game_form.php" class="button" style="width: 8em; text-align: center;">Add Game</a>
            </section>

        </main>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> My Game Shop, Inc.</p>
        </footer> 

<?php require_once ("footer.php"); ?>