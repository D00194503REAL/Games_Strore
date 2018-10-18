<?php
    require_once("database.php");
    
    $game_id = filter_input(INPUT_POST, "game_id");
    $category_id = filter_input(INPUT_POST, "category_id");
    $code = filter_input(INPUT_POST, "code");
    $name = filter_input(INPUT_POST, "name");
    $price = filter_input(INPUT_POST, "price");
    
    $query = "UPDATE games SET categoryID = :np_category_id, gameCode = :np_code, gameName = :np_name, listPrice = :np_price WHERE gameID = :np_game_id";
    $statement = $db -> prepare($query);
    $statement -> bindValue(":np_category_id", $category_id);
    $statement -> bindValue(":np_code", $code);
    $statement -> bindValue(":np_name", $name);
    $statement -> bindValue(":np_price", $price);
    $statement -> bindValue(":np_game_id", $game_id);
    $statement -> execute();
    $statement -> closeCursor();
    
    include ("admin_panel.php");
?>

