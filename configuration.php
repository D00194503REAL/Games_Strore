<?php
/* * ************************ You need to set the values below to match your project ************************ */

// localhost website and localhost database
$localHostSiteFolderName = "gamesstore";

$localhostDatabaseName = "D00194503";
$localHostDatabaseHostAddress = "localhost";
$localHostDatabaseUserName = "root";
$localHostDatabasePassword = "";



// remotely hosted website and remotely hosted database       /* you will need to get the server details below from your host provider */
$serverWebsiteName = "http://mysql02.comp.dkit.ie/D00194503"; /* use this address if hosting website on the college students' website server */

$serverDatabaseName = "D00194503";
$serverDatabaseHostAddress = "mysql02.comp.dkit.ie";         /* use this address if hosting database on the college computing department database server */
$serverDatabaseUserName = "D00194503";
$serverDatabasePassword = "&&95b1BB";




$useLocalHost = true;      /* set to false if your database is NOT hosted on localhost */
$useTestStripeKey = true;

if ($useTestStripeKey == true)
{
    $privateStripeKey = "sk_test_LxkQaj9mm3RmskUNXMneilbt"; 
    $publicStripeKey = "pk_test_xsNmgZ3ieRwp7bvIM5ncW4VD"; 
}
else // live system
{
    $privateStripeKey = "place your private live key"; 
    $publicStripeKey = "place your public live key here"; 
}


/* * ******************************* WARNING                                 ******************************** */
/* * ******************************* Do not modify any code BELOW this point ******************************** */

if ($useLocalHost == true)
{
    $siteName = "http://localhost/" . $localHostSiteFolderName;
    $dbName = $localhostDatabaseName;
    $dbHost = $localHostDatabaseHostAddress;
    $dbUsername = $localHostDatabaseUserName;
    $dbPassword = $localHostDatabasePassword;
}
else  // using remote host
{
    $siteName = $serverWebsiteName;
    $dbName = $serverDatabaseName;
    $dbHost = $serverDatabaseHostAddress;
    $dbUsername = $serverDatabaseUserName;
    $dbPassword = $serverDatabasePassword;
}



chmod("configuration.php", 0600); // do not allow anyone to view this file
?>