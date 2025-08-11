<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Registration</title>
</head>
<body>
    <center>
        <div class="container">
            <h2>Delivery Registration</h2>
            <form name="deliveries" action="deliveries.php" method="post">
                <table>
                    <tr>
                        <td><label for="id">Delivery ID:</label></td>
                        <td><input type="number" id="id" name="id" required></td>
                    </tr>
                    <tr>
                        <td><label for="customer_id">Customer ID:</label></td>
                        <td><input type="number" id="customer_id" name="customer_id" required></td>
                    </tr>
                    <tr>
                        <td><label for="hawker_id">Hawker ID:</label></td>
                        <td><input type="number" id="hawker_id" name="hawker_id" required></td>
                    </tr>
                    <tr>
                        <td><label for="date">Delivery Date:</label></td>
                        <td><input type="date" id="date" name="date" required></td>
                    </tr>
                    <tr>
                        <td><label for="status">Status:</label></td>
                        <td>
                            <select id="status" name="status" required>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="delayed">Delayed</option>
                                <option value="canceled">Canceled</option>
                                <option value="in_transit">In Transit</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Submit" name="sbm">
                            <button type="button" onclick="updatedeliveries()">Update</button>
                            <button type="button" onclick="deletedeliveries()">Delete</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</body>
</html>


<?php // PHP DATABASE CONNECTION CODE STARTS FROM HERE?>
<?php

$connects= mysql_connect("localhost", "root");
mysql_select_db("newspapermanagement",$connects);

// Check if form is submitted
if (isset($_POST['sbm'])) {
    $sb = $_POST['sbm'];

    if ($sb == "Submit") {
        // Insert new customer record
        $sql = "INSERT INTO  deliveries (id, customer_id, hawker_id, date, status) VALUES ('$_POST[id]', '$_POST[customer_id]', '$_POST[hawker_id]', '$_POST[date]','$_POST[status]')";
        mysql_query( $sql, $connects);
            echo "Data stored...";
        
    } else if ($sb == "Update") {
        // Update existing customer record
        $sql = "UPDATE  deliveries SET customer_id='$_POST[customer_id]', hawker_id='$_POST[hawker_id]', date='$_POST[date]',status='$_POST[status]' WHERE id='$_POST[id]'";
        mysql_query( $sql, $connects);
            echo "Data updated...";
    
    } else if ($sb == "Delete") {
        // Delete customer record
        $sql = "DELETE FROM  deliveries WHERE id='$_POST[id]'";
        mysql_query( $sql, $connects);
            echo "Records deleted...";
    }
}

// Close the database connection
mysql_close($connects);
?>

