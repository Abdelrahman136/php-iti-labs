<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Inter', sans-serif; /* Using Inter font */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 900px;
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
        .table {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden; /* For rounded corners on table */
        }
        .table thead {
            background-color: #4f46e5;
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #ffffff;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f8f9fa;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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
        <h2 class="text-center mb-4">Customer Records</h2>
        <?php
            session_start();
            if(isset($_GET['registration_success'])) {
                echo '<div class="alert alert-success" role="alert">Registration successful!</div>';
            } 

            if(isset($_GET['deleted_success'])){
                echo '<div class="alert alert-success" role="alert">Record deleted successfully!</div>';
            }

            $file_path = 'customer.txt';
            $customer_data = [];

            // Handle delete request
            if(isset($_GET['delete_index']) && isnumeric($_GET['delete_index'])) {
                $deleted_index = (int)$_GET['delete_index'];

                if(file_exists($file_path)) {
                    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINE);
                    $updated_lines = [];
                    foreach($lines as $index => $line) {
                        if($index != $deleted_indexl) {
                            $updated_lines[] = $line;
                        }
                    }

                    // rewrite updated file
                    if(file_put_contents($file_path, implode("\n", $updated_lines) . (empty($updated_lines) ? '' : "\n"))){
                        header("Location: display_customers.php?delete_success=1");
                        exit();
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error deleting record from file.</div>';
                    }
                
                } else {
                    echo '<div class="alert alert-warning" role="alert">Customer file not found for deletion.</div>';
                }
            }


            // read file
            if(file_exists($file_path)) {
                $file_handle = fopen($file_path, 'r');
                if($file_handle) {
                    while(!feof($file_handle)) {
                        $line = fgets($file_handle);
                        if(trim($line) != '') {
                            $data = explode("|", trim($line));

                            if(count($data) >= 9) {
                                $customer_data[] = [
                                    'firstName' => htmlspecialchars($data[0]),
                                    'lastName' => htmlspecialchars($data[1]),
                                    'email' => htmlspecialchars($data[2]),
                                    'address' => htmlspecialchars($data[3]),
                                    'country' => htmlspecialchars($data[4]),
                                    'gender' => htmlspecialchars($data[5]),
                                    'skills' => htmlspecialchars($data[6]), // Already comma-separated
                                    'username' => htmlspecialchars($data[7]),
                                    'department' => htmlspecialchars($data[8]),
                                ];
                            }
                        }
                    }
                    fclose($file_handle);
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: Unable to open customer file for reading.</div>';
            }
        } else {
            echo '<div class="alert alert-info" role="alert">No customer records found yet.</div>';
        }
            

        // Display customer data in a table
        if (!empty($customer_data)) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Name</th>';
            echo '<th>Email</th>';
            echo '<th>Address</th>';
            echo '<th>Country</th>';
            echo '<th>Gender</th>';
            echo '<th>Skills</th>';
            echo '<th>Username</th>';
            echo '<th>Department</th>';
            echo '<th>Actions</th>'; // For delete button
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach($customer_data as $index => $customer) {
                echo '<tr>';
                echo '<td>' . ($index + 1) . '</td';
                echo '<td>' . $customer['firstName'] . ' ' . $customer['lastName'] . '</td';
                echo '<td>' . $customer['email'] . '</td>';
                echo '<td>' . $customer['address'] . '</td>';
                echo '<td>' . $customer['country'] . '</td>';
                echo '<td>' . $customer['gender'] . '</td>';
                echo '<td>' . $customer['skills'] . '</td>';
                echo '<td>' . $customer['username'] . '</td>';
                echo '<td>' . $customer['department'] . '</td>';
                echo '<td><a href="?deleted_index' . $index .'" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }
        ?>
        <div class="text-center">
            <a href="registration.php" class="btn back-button">Go Back to Registration</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


