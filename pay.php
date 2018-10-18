<!DOCTYPE html>
<html>
<head>
<title>Stripe Example</title>  

<link rel="stylesheet" href="assets/demo.css">
<link rel="stylesheet" href="assets/form-validation.css">
<link rel="stylesheet" href="assets/awesome.css">
<link href="assets/main.css" rel="stylesheet" type="text/css"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="./assets/dkit.png">


<script>
    function calculteCost()
    {
        var numberOfProductA = document.getElementById('numberOfProductA').value;
        var numberOfProductB = document.getElementById('numberOfProductB').value;
        var paymentAmount;
        
        paymentAmount = (25 * numberOfProductA) + (50 * numberOfProductB);
        
        document.getElementById('paymentAmount').value = paymentAmount;
        document.getElementById('paymentDetails').value = "€" + paymentAmount;

        if (paymentAmount > 0)
        {
            document.getElementById('paymentAmountError').style.visibility = "hidden";
        }
        else
        {
            document.getElementById('paymentAmountError').style.visibility = "visible";
        }
    }


    function atLeastOneProductBought()
    {
        if (document.getElementById('paymentAmount').value === '0')
        {
            document.getElementById('paymentAmountError').style.visibility = "visible";
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
</head>

<body>
<div class="main-content">

<form autocomplete="off" class="form-validation" id="dor_payment_form" onsubmit="return atLeastOneProductBought()" action="make_payment.php" method="post">
<img src="./assets/dkit.png" style="width:50px" alt=""/> <h1>Stripe Example</h1>
<h2>Step 1 of 3 (Calculate Cost)</h2>

<p>Product A €25 each.<br>
Product B €50 each.</p>

<label for="email">Email: </label>
<input type="email" id = "email" name = "email" required autofocus><br><br>

<label id="paymentAmountError">You must select at least one product</label><br>

<label for="numberOfProductA">Number Of Product A: </label>
<input type="number" id="numberOfProductA" name="numberOfProductA" min="0" max="10" value="0" onchange="calculteCost()"><br><br>

<label for="numberOfProductB">Number Of Product B: </label>
<input type="number" id="numberOfProductB" name="numberOfProductB" min="0" max="10" value="0" onchange="calculteCost()"><br><br>

<label for="paymentDetails">Cost: </label>
<input type="text" id = "paymentDetails" value = "€0" tabIndex="-1" readonly><br><br>
<input type="hidden" id="paymentAmount" name="paymentAmount" value="0">

<input type="submit" value="Step 2">
</form>

</div> 
</body>
</html>