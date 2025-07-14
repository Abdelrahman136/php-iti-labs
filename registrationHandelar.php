<?php
    // var_dump($_REQUEST);
    // var_export($_REQUEST);

    session_start();

    $errors = [];
    $old_data = [];

    function clean_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = clean_data($_POST['firstName'] ?? '');
        $lastName = clean_data($_POST['lastName'] ?? '');
        $email = clean_data($_POST['email'] ?? '');
        $address = clean_data($_POST['address'] ?? '');
        $country = clean_data($_POST['country'] ?? '');
        $gender = clean_data($_POST['gender'] ?? '');
        $skills = isset($_POST['skills']) && is_array($_POST['skills']) ? array_map('clean_data', $_POST['skills']) : [];
        $username = clean_data($_POST['username'] ?? '');
        $password = $_POST['password'] ?? ''; // Password is not HTML escaped here as it will be hashed or not displayed directly
        $department = clean_data($_POST['department'] ?? '');
        $captcha_input = clean_data($_POST['captcha'] ?? '');
        $captcha_generated = clean_data($_POST['hiddenCaptcha'] ?? '');


        $old_data = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'address' => $address,
            'country' => $country,
            'gender' => $gender,
            'skills' => $skills,
            'username' => $username,
            'department' => $department,
            // Password is not stored in old_data for security reasons
        ];
        $_SESSION['old_data'] = $old_data;


        // validation
        if(empty($firstName)) {
            $errors[] = "First name is required";
        } elseif(!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $errors[] = "Only letters and white space allowed in First Name.";
        }

        if(empty($lastName)) {
            $errors[] = "Last name is required";
        } elseif(!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $errors[] = "Only letters and white space allowed in Last Name.";
        }

        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // Address validation
        if (empty($address)) {
            $errors[] = "Address is required.";
        }

        // Country validation
        if (empty($country)) {
            $errors[] = "Country is required.";
        }

        // Gender validation
        if (empty($gender)) {
            $errors[] = "Gender is required.";
        } elseif ($gender !== "Male" && $gender !== "Female") {
            $errors[] = "Invalid gender selected.";
        }

        // Username validation
        if (empty($username)) {
            $errors[] = "Username is required.";
        }

        // Password validation (basic check for non-empty)
        if (empty($password)) {
            $errors[] = "Password is required.";
        }
        // In a real application, you'd add complexity requirements (e.g., min length, characters)
        // and hash the password: $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Captcha validation
        // if (empty($captcha_input)) {
        //     $errors[] = "Captcha is required.";
        // } elseif (strtolower($captcha_input) !== strtolower($captcha_generated)) {
        //     $errors[] = "Invalid CAPTCHA. Please try again.";
        // }

        if(!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: registration.php');
            exit();
        } 

        $file_path = 'customer.txt';

        $file_handle = fopen($file_path, 'a');

        if($file_handle) {
            $skills_string = implode(",", $skills);

            $data_to_save = 
                $firstName . "|" .
                $lastName . "|" .
                $email . '|' .
                $address . '|' .
                $country . '|' .
                $gender . '|' .
                $skills_string . '|' .
                $username . '|' .
                $department . "\n";

            fwrite($file_handle, $data_to_save);
            fclose($file_handle);

            unset($_SESSION['old_data']);
            header('Location: display_customers.php?registration_success=1');
            exit();
        } else {
            $errors[] = "Error: Unable to open file for writing.";
            $_SESSION['errors'] = $errors;
            header('Location: registration.php');
            exit();
        }
    } else {
        header("Location: registration.php");
        exit();
    }
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Your Information</title> -->
    <!-- Bootstrap CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            color: #4f46e5; /* Indigo-700 equivalent */ -->
            /* font-weight: bold;
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
        <h2 class="text-center mb-4">Review</h2> */

        <!-- This section would dynamically display data from the form submission -->
        <!-- For a static HTML page, we'll use placeholder data -->
        <!-- <p class="mb-4">Thanks (Mr. or Miss selected by the gender type)! First Name + Last Name</p> -->
        <!-- <p class="mb-4">
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
            ?> -->
            <!-- <span class="info-label"></span> XXXXXXXXXX -->
        <!-- </div>
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
</html> -->
