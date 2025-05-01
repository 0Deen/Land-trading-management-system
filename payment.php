<?php include 'components/connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- Payment Section Starts -->
<section class="form-container">

   <form action="paymentp.php" method="POST">
      <h3>Payment Details</h3>
      <img src="images/cards.png" alt="cards" style="width: 100%; border-radius: 10px; margin: 10px 0;"><br>

      <label for="cardNo">Card Number</label>
      <input type="text" name="cardNo" pattern="[0-9]{10,14}" placeholder="Enter Valid Card Number" required class="box">

      <label for="expiryDate">Expiration Date</label>
      <input type="text" name="expiryDate" pattern="(0[1-9]|1[0-2])/[0-9]{2}" placeholder="MM/YY" required class="box">

      <label for="cvCode">CV Code</label>
      <input type="password" name="cvCode" pattern="[0-9]{3}" placeholder="CVC" required class="box">

      <label for="cardName">Card Owner</label>
      <input type="text" name="cardName" placeholder="Enter Card Owner Name" required class="box">

      <label for="amount">amount</label>
      <input type="text" name="amount" pattern="[0-9]{1,}" placeholder="Enter Amount" required class="box">

      <input type="submit" name="submit" class="btn" value="Confirm Payment">
   </form>

</section>
<!-- Payment Section Ends -->

<?php include 'components/footer.php'; ?>

<!-- Custom JS file -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>
