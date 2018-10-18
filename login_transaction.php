<?php
session_start();




/* Read posted data */
require_once "error_messages.php";  // contains a list of error messages that can be assigned to $_SESSION["error_message"]


$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)));
if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: index.php"); // deal with invalid input
    exit();
}

$password = ltrim(rtrim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING)));
if (empty($password))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: index.php"); // deal with invalid input
    exit();
}


/* Connect to the database */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* Check that user exists  */
$query = "SELECT id, name, email, password, access_level FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();


if ($statement->rowCount() > 0)
{
    $row = $statement->fetch(PDO::FETCH_OBJ);

    if (!password_verify($password, $row->password))
    {
        $_SESSION["error_message"] = $ERROR_MESSAGE_EMAIL_OR_PASSWORD_IS_INCORRECT;
        header("location: index.php"); // deal with invalid input
        exit();
    }
    else
    {
        // set session variables
        $_SESSION["user_id"] = $row->id;
        $_SESSION["user_name"] = $row->name;
        $_SESSION["user_email"] = $row->email;
        $_SESSION["access_level"] = $row->access_level;
    }
    
}


// keep password up-to-date
if (password_needs_rehash($password, PASSWORD_DEFAULT))
{
    // the password needs to be rehashed as it is not up-to-date
    $new_password = password_hash($password, PASSWORD_DEFAULT);

    // update the hash in the database
    $query = "UPDATE users SET password = :password WHERE id = :id";
    $statement = $dbConnection->prepare($query);
    $statement->bindParam(":password", $new_password, PDO::PARAM_STR);
    $statement->bindParam(":id", $_SESSION["user_id"], PDO::PARAM_INT);
    $statement->execute();
}


// set session variables
$_SESSION["user_id"] = $row->id;
$_SESSION["user_name"] = $row->name;
$_SESSION["user_email"] = $row->email;
$_SESSION["access_level"] = $row->access_level;

// keep password up-to-date
if (password_needs_rehash($row->password, PASSWORD_DEFAULT))
{
    // the password needs to be rehashed as it is not up-to-date
    $new_password = password_hash($password, PASSWORD_DEFAULT);

    // update the hash in the database
    $query = "UPDATE users SET password = :password WHERE id = :id";
    $statement = $dbConnection->prepare($query);
    $statement->bindParam(":password", $new_password, PDO::PARAM_STR);
    $statement->bindParam(":id", $_SESSION["user_id"], PDO::PARAM_INT);
    $statement->execute();
}



// Note that if the password fails, then the members_area.php webpage will automatically redirect the user back to the login webpage
header("location: members_area.php");
?>