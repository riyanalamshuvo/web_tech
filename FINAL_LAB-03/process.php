<?php  
$fullName = $_POST['fullName'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';
$location = $_POST['location'] ?? '';
$zip = $_POST['zip'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$country = $_POST['country'] ?? '';
$gender = $_POST['gender'] ?? '';
$thoughts = $_POST['thoughts'] ?? '';
$termsAccepted = isset($_POST['terms']) ? 'Yes' : 'No';

// ✅ Set favorite color as cookie (if submitted)
$favoriteColor = $_POST['color'] ?? '#ffffff';
setcookie('favoriteColor', $favoriteColor, time() + (86400 * 30), "/");

// ✅ Retrieve cookie if available
$backgroundColor = $_COOKIE['favoriteColor'] ?? $favoriteColor;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Result</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: <?= htmlspecialchars($backgroundColor) ?>;
    }

    .result-box {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      text-align: left;
      max-width: 600px;
      width: 100%;
    }

    .result-box h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .result-box p {
      margin: 8px 0;
      font-size: 16px;
      color: #111;
    }

    .result-box strong {
      font-size: 16px;
      color: #222;
    }

    .button-container {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }

    .confirm-button, .cancel-button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .confirm-button {
      background-color: #4CAF50;
      color: white;
    }

    .confirm-button:hover {
      background-color: #45a049;
    }

    .cancel-button {
      background-color: #f44336;
      color: white;
    }

    .cancel-button:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>

  <div class="result-box">
    <h2>Registration Received Data</h2>
    <p><strong>Full Name:</strong> <?= htmlspecialchars($fullName) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Location:</strong> <?= htmlspecialchars($location) ?></p>
    <p><strong>Zip Code:</strong> <?= htmlspecialchars($zip) ?></p>
    <p><strong>Birthdate:</strong> <?= htmlspecialchars($birthdate) ?></p>
    <p><strong>Country:</strong> <?= htmlspecialchars($country) ?></p>
    <p><strong>Gender:</strong> <?= htmlspecialchars($gender) ?></p>
    <p><strong>Your Thoughts:</strong> <?= nl2br(htmlspecialchars($thoughts)) ?></p>
    <p><strong>Terms Accepted:</strong> <?= $termsAccepted ?></p>
    <p><strong>Favorite Color:</strong> <?= htmlspecialchars($favoriteColor) ?></p>

    <div class="button-container">
      <button class="cancel-button" onclick="cancelAction()">Cancel</button>
      <button class="confirm-button" onclick="confirmAction()">Confirm</button>
    </div>
  </div>

  <script>
    function confirmAction() {
      alert("Thank you! Your registration has been confirmed.\nYour background color preference is saved for 30 days.");
      // Optional: redirect to homepage
      // window.location.href = "home.php";
    }

    function cancelAction() {
      history.back(); // Go back to the previous page
    }
  </script>

</body>
</html>
