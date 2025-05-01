<?php  

session_start();  // Always start the session first!

include 'components/connect.php';

// Use session first, fallback to cookie
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    $_SESSION['user_id'] = $user_id;  // sync cookie to session
} else {
    header('location:login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
         $select_profile->execute([$user_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

         if ($fetch_profile) {
             echo "<h3>Welcome!</h3>";
             echo "<p>" . htmlspecialchars($fetch_profile['name']) . "</p>";
         } else {
             echo "<h3>User not found</h3>";
             echo "<p>Please log in again.</p>";
         }
      ?>
      <a href="update.php" class="btn">update profile</a>
      </div>

      <div class="box">
         <h3>filter search</h3>
         <p>search your dream land?</p>
         <a href="search.php" class="btn">search now</a>
      </div>

      <div class="box">
      <?php
        $count_properties = $conn->prepare("SELECT * FROM `property` WHERE user_id = ?");
        $count_properties->execute([$user_id]);
        $total_properties = $count_properties->rowCount();
      ?>
      <h3><?= $total_properties; ?></h3>
      <p>properties listed</p>
      <a href="my_listings.php" class="btn">view all listings</a>
      </div>

      <div class="box">
      <?php
        $count_requests_received = $conn->prepare("SELECT * FROM `requests` WHERE receiver = ?");
        $count_requests_received->execute([$user_id]);
        $total_requests_received = $count_requests_received->rowCount();
      ?>
      <h3><?= $total_requests_received; ?></h3>
      <p>requests received</p>
      <a href="requests.php" class="btn">view all requests</a>
      </div>

      <div class="box">
      <?php
        $count_requests_sent = $conn->prepare("SELECT * FROM `requests` WHERE sender = ?");
        $count_requests_sent->execute([$user_id]);
        $total_requests_sent = $count_requests_sent->rowCount();
      ?>
      <h3><?= $total_requests_sent; ?></h3>
      <p>requests sent</p>
      <a href="saved.php" class="btn">view saved lands</a>
      </div>

      <div class="box">
      <?php
        $count_saved_properties = $conn->prepare("SELECT * FROM `saved` WHERE user_id = ?");
        $count_saved_properties->execute([$user_id]);
        $total_saved_properties = $count_saved_properties->rowCount();
      ?>
      <h3><?= $total_saved_properties; ?></h3>
      <p>properties saved</p>
      <a href="saved.php" class="btn">view saved lands</a>
      </div>

      <div class="box">
   <?php
      $select_payments = $conn->prepare("SELECT * FROM `payments`");
      $select_payments->execute();
      $count_payments = $select_payments->rowCount();
   ?>
   <h3><?= $count_payments; ?></h3>
   <p>total payments</p>
   <a href="viewPayments.php" class="btn">view payments</a>
</div>
<div class="box">
   <?php
      $select_payments = $conn->prepare("SELECT * FROM `messages`");
      $select_payments->execute();
      $count_payments = $select_payments->rowCount();
   ?>
   <h3><?= $count_payments; ?></h3>
   <p>total messages</p>
   <a href="inbox.php" class="btn">view messages</a>
</div>
   </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
<?php include 'components/message.php'; ?>

</body>
</html>
