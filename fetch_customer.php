<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establish database connection
$connects = mysqli_connect("localhost", "root", "", "newspapermanagement");

// Check connection
if (!$connects) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if customerId is sent
if (isset($_POST['customerId'])) {
    $customerId = mysqli_real_escape_string($connects, $_POST['customerId']);

    // Fetch customer details from the database
    $sql_customer = "SELECT name, contact, address FROM customers WHERE id = '$customerId'";
    $result_customer = mysqli_query($connects, $sql_customer);

    if ($result_customer && mysqli_num_rows($result_customer) > 0) {
        $row_customer = mysqli_fetch_assoc($result_customer);

        // Return customer details as JSON
        echo json_encode([
            'success' => true,
            'customerName' => $row_customer['name'],
            'contactNo' => $row_customer['contact_no'],
            'address' => $row_customer['address']
        ]);
    } else {
        // Return error if no customer is found
        echo json_encode(['success' => false]);
    }
}

// Close the database connection
mysqli_close($connects);
?>
