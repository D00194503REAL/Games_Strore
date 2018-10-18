<?php
require_once ("database.php");

$game_id = filter_input(INPUT_POST, "game_id");
$category_id = filter_input(INPUT_POST, "category_id");
if(!isset($game_id))
{
    include("admin_panel.php");
    exit();
}

//query the database
$deleteQuery = "DELETE FROM games WHERE gameID = :np_game_id";
$statement = $db -> prepare($deleteQuery);
$statement -> bindValue(":np_game_id", $game_id);
$statement -> execute();
$statement -> closeCursor();

include("admin_panel.php");