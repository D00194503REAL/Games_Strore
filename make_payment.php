<?php
$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING)));
if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
{
    header("location: index.php"); // deal with invalid input
    exit();
}


$numberOfProductA = filter_input(INPUT_POST, "numberOfProductA", FILTER_SANITIZE_NUMBER_INT);
if (!isset($numberOfProductA))
{
    if (!filter_var($numberOfProductA, FILTER_VALIDATE_INT))
    {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}


$numberOfProductB = filter_input(INPUT_POST, "numberOfProductB", FILTER_SANITIZE_NUMBER_INT);
if (!isset($numberOfProductB))
{
    if (!filter_var($numberOfProductB, FILTER_VALIDATE_INT))
    {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}

$paymentAmount = filter_input(INPUT_POST, "paymentAmount", FILTER_SANITIZE_NUMBER_INT);
if (!isset($paymentAmount))
{
    if (!filter_var($paymentAmount, FILTER_VALIDATE_INT))
    {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Stripe Example</title>  

<link rel="stylesheet" href="assets/demo.css">
<link rel="stylesheet" href="assets/form-validation.css">
<link rel="stylesheet" href="assets/awesome.css">
<link href="assets/main.css" rel="stylesheet"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="./assets/dkit.png">
</head>

<body>
<div class="main-content">

<form class="form-validation" id="dor_payment_form">
<img src="./assets/dkit.png" style="width:50px" alt=""/> <h1>Stripe Example</h1> 
<h2>Step 2 of 3 (Payment)</h2>

<label>Email: </label>
<input type="text" value = "<?php echo $email ?>" tabIndex="-1" readonly><br><br>

<label>Number Of Product A: </label>
<input type="text" value = "<?php echo $numberOfProductA ?>" tabIndex="-1" readonly><br><br>

<label>Number Of Product B: </label>
<input type="text" id="numberOfProductB"  value = "<?php echo $numberOfProductB ?>" tabIndex="-1" readonly><br><br>

<label>Cost: </label>
<input type="text" value = "€<?php echo $paymentAmount ?>" tabIndex="-1" readonly><br><br>
</form>


<form  action="payment_confirmation.php" style="text-align: center" method="post">
<input type="hidden" name = "email" value = "<?php echo $email ?>">
<input type="hidden" name = "numberOfProductA" value = "<?php echo $numberOfProductA ?>">
<input type="hidden" name = "numberOfProductB" value = "<?php echo $numberOfProductB ?>">
<input type="hidden" name = "paymentAmount" value = "<?php echo $paymentAmount ?>">

<?php   require_once 'configuration.php'; ?>
<script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"    

    data-key="<?php echo $publicStripeKey ?>"
    data-email= "<?php echo $email ?>"
    data-currency="EUR"
    data-amount="<?php echo $paymentAmount . '00' ?>"
    data-name="The Company Name"
    data-description="Stripe Sales Example"
    data-image="./assets/dkit.png"
    data-locale="auto">
</script>

</form>
<form style="text-align: center">
<button type="button" class ="cancel_button" onclick = "window.history.back()"><span>Change Details</span></button>
</form><br>

</div> 
</body>
</html>