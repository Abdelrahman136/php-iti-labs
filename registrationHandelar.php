<?php
    // var_dump($_REQUEST);
    // var_export($_REQUEST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Your Information</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Inter', sans-serif; /* Using Inter font */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }
        h2 {
            color: #4f46e5; /* Indigo-700 equivalent */
            font-weight: bold;
            margin-bottom: 30px;
        }
        .info-item {
            margin-bottom: 15px;
            font-size: 1.1rem;
            color: #343a40;
        }
        .info-label {
            font-weight: bold;
            color: #4f46e5; /* Indigo-600 equivalent */
            display: inline-block;
            min-width: 120px; /* Align labels */
        }
        .back-button {
            background-color: #6c757d; /* Bootstrap secondary color */
            border-color: #6c757d;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none; /* Remove underline for anchor tag */
            display: inline-block; /* For padding and margin */
            margin-top: 30px;
        }
        .back-button:hover {
            background-color: #5a6268;
            border-color: #5a6268;
            transform: scale(1.05);
            color: #ffffff; /* Keep text white on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Review</h2>

        <!-- This section would dynamically display data from the form submission -->
        <!-- For a static HTML page, we'll use placeholder data -->
        <!-- <p class="mb-4">Thanks (Mr. or Miss selected by the gender type)! First Name + Last Name</p> -->
        <p class="mb-4">
            Thanks <?php echo ($_POST['gender'] ===  "Male") ? "Mr": "Miss"  ?>! <?php echo $_POST['firstName'] . " " . $_POST['lastName'] ?> 
        </p>
        <p class="mb-4">Please Review Your Information:</p>

        <div class="info-item">
            <span class="info-label">Name:</span> <?php echo $_POST['firstName'] . " " . $_POST['lastName']  ?>
        </div>
        <div class="info-item">
            <span class="info-label">Address:</span> <?php echo $_POST['address'] ?>
        </div>
        <div class="info-item">
            <?php
            foreach ($_POST['skills'] as $skill) {
                echo "<span class='info-label'>Your Skills:</span> " . htmlspecialchars($skill) . "<br>";
            }
            ?>
            <!-- <span class="info-label"></span> XXXXXXXXXX -->
        </div>
        <div class="info-item">
            <span class="info-label">Department:</span> <?php echo $_POST['department'] ?>
        </div>

        <div class="text-center">
            <a href="registration.php" class="btn back-button">Go Back to Registration</a>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
