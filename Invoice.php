<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Generation</title>
</head>
<body>
    <center>
        <div class="container">
            <h2>Invoice Generation</h2>
            <form name="Invoice" action="Invoice.php" method="post">
            <div class="form-group">
                        <label for="customerId">Customer ID:</label>
                        <input type="text" name="customerId" id="customerId" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="customerName">Customer Name:</label>
                        <input type="text" name="customerName" id="customerName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="contactNo">Contact Number:</label>
                        <input type="text" name="contactNo" id="contactNo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="newspaper">Newspaper:</label>
                        <select name="newspaper" id="newspaper" class="form-control" required>
                                <option value="" disabled selected>Select Newspaper</option>
                                            <option value="Lokmat">Lokmat</option>
                                            <option value="Divya Marathi">Divya Marathi</option>
                                            <option value="Sakal">Sakal</option>
                                            <option value="PunyaNagari">PunyaNagari</option>
                                            <option value="Loksatta">Loksatta</option>
                                            <option value="Indian Express">Indian Express</option>
                                            <option value="Maharashtra Times">Maharashtra Times</option>
                                            <option value="Deshdut">Deshdut</option>
                                            <option value="Aapla Maharashtra">Aapla Maharashtra</option>
                                            <option value="Mumbai Chaufer">Mumbai Chaufer</option>
                                            <option value="Divya Bhaskar">Divya Bhaskar</option>
                            <!-- Add more newspapers as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate Per Day:</label>
                        <input type="number" name="rate" id="rate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="days">Number of Days:</label>
                        <input type="number" name="days" id="days" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentStatus">Payment Status:</label>
                        <select name="paymentStatus" id="paymentStatus" class="form-control" required>
                            <option value="Paid">Paid</option>
                            <option value="Unpaid">Unpaid</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Invoice</button>
                </form>

        </div>
    </center>
</body>
</html>


<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if session ID is set
if (!isset($_SESSION['id'])) {
    die("Session ID not set.");
}

// Establish database connection using MySQLi
$connects = mysqli_connect("localhost", "root", "", "newspapermanagement");

// Check connection
if (!$connects) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $customerId = mysqli_real_escape_string($connects, $_POST['customerId']);
    $customerName = mysqli_real_escape_string($connects, $_POST['customerName']);
    $contactNo = mysqli_real_escape_string($connects, $_POST['contactNo']);
    $address = mysqli_real_escape_string($connects, $_POST['address']);
    $newspaper = mysqli_real_escape_string($connects, $_POST['newspaper']);
    $rate = floatval($_POST['rate']);
    $days = intval($_POST['days']);
    $paymentStatus = mysqli_real_escape_string($connects, $_POST['paymentStatus']);

    // Calculate total amount
    $totalAmount = $rate * $days;

    // Insert invoice details into database
    $sql_invoice = "INSERT INTO invoices_g (customer_id, customer_name, contact_no, address, newspaper, rate_per_day, number_of_days, total_amount, payment_status) 
                    VALUES ('$customerId', '$customerName', '$contactNo', '$address', '$newspaper', '$rate', '$days', '$totalAmount', '$paymentStatus')";

    if (mysqli_query($connects, $sql_invoice)) {
        echo "Invoice generated successfully!";
    } else {
        echo "Error: " . mysqli_error($connects);
    }
}

// Close the database connection
mysqli_close($connects);
?>
