<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $barcode_id = $_POST['barcode_id'];

  // Check if the barcode exists in the database
  $stmt = $pdo->prepare("SELECT * FROM scanned_barcodes WHERE barcode_id = ?");
  $stmt->execute([$barcode_id]);
  $barcode = $stmt->fetch();

  if ($barcode) {
    // If barcode exists and hasn't been scanned before (scanned = 0)
    if ($barcode['scanned'] == 0) {
      // Update the scanned flag to 1
      $updateStmt = $pdo->prepare("UPDATE scanned_barcodes SET scanned = 1 WHERE barcode_id = ?");
      $updateStmt->execute([$barcode_id]);
      header('location: ./succes.html');
    } else {
      // Barcode has already been scanned before
      header('location: ./already.html');
    }
  } else {
    // Barcode not found in the database
    header('Location: ./failed.html');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/utama.css">
  <title>Barcode Scanner</title>
  <style>
    /* General reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #81ecec, #6c5ce7);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Arial', sans-serif;
      color: #fff;
    }

    .header {
      position: absolute;
      top: 20px;
      text-align: center;
    }

    .logo-container img {
      width: 130px;
      height: auto;
      margin-bottom: 10px;
    }

    .ml4 {
      position: relative;
      font-weight: 900;
      font-size: 2.5em;
      text-align: center;
      margin-bottom: 20px;
    }

    .ml4 .letters {
      position: absolute;
      margin: auto;
      left: 0;
      top: 0.3em;
      right: 0;
      opacity: 0;
      margin-top: 20px;
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 15px;
      padding: 30px;
      width: 400px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      animation: fadeIn 0.5s ease-in-out;
    }

    .container img {
      width: 250px;
      height: auto;
      margin-bottom: 20px;
      filter: drop-shadow(0px 5px 10px rgba(0, 0, 0, 0.5));
    }

    h2 {
      font-size: 24px;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    h3 {
      font-size: 18px;
      margin-bottom: 20px;
      font-weight: normal;
      color: rgba(255, 255, 255, 0.9);
    }

    #barcode_id {
      position: absolute;
      opacity: 0;
      pointer-events: none;
    }

    .copyright {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 14px;
      color: rgba(255, 255, 255, 0.7);
      text-align: center;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
  <script>
    let scanned = false;
    document.addEventListener("DOMContentLoaded", () => {
      const barcodeInput = document.getElementById("barcode_id");
      const form = document.getElementById("scan-form");
      const messageElement = document.getElementById("message");

      // Focus on the hidden input when the page loads
      barcodeInput.focus();

      // Listen for the "Enter" key
      barcodeInput.addEventListener("keydown", (event) => {
        if (scanned) return;
        scanned = true;
        if (event.key === "Enter" && barcodeInput.value.trim().length > 0) {
          event.preventDefault(); // Prevent default Enter behavior
          messageElement.innerText = "Scanning..."; // Change message to "Scanning"
          setTimeout(() => {
            form.submit(); // Submit the form after a short delay
          }, 500); // 1-second delay for message visibility
        }
      });
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</head>

<body>
  <div class="container">
    <h2>Tiket Scanner</h2>
    <img src="./img/scanning.gif" alt="Barcode Scanning">
    <h3 id="message">Tolong scan QR Code pada gelang!</h3>
    <form method="POST" action="index.php" id="scan-form">
      <input type="text" id="barcode_id" name="barcode_id" autofocus>
    </form>
  </div>

  <div class="copyright">
    &copy; <?php echo date("Y"); ?> Nobiyyan. All Rights Reserved.
  </div>
</body>

</html>