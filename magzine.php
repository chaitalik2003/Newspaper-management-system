<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazine Subscription</title>
</head>
<body>
    <center>
        <div class="container">
            <h2>Magazine Subscription</h2>
            <form name="magazine" action="magazine.php" method="post">
                <table>
                    <tr>
                        <td><label for="id">Magazine ID:</label></td>
                        <td><input type="number" id="id" name="id" required></td>
                    </tr>
                    <tr>
                        <td><label for="customer-name">Customer Name:</label></td>
                        <td><input type="text" id="customer-name" name="customer-name" required></td>
                    </tr>
                    <tr>
                        <td><label for="customer-email">Customer Email:</label></td>
                        <td><input type="email" id="customer-email" name="customer-email" required></td>
                    </tr>
                    <tr>
                        <td><label for="magazine-name">Magazine Name:</label></td>
                        <td><input type="text" id="magazine-name" name="magazine-name" required></td>
                    </tr>
                    <tr>
                        <td><label for="magazine-type">Magazine Type:</label></td>
                        <td>
                            <select id="magazine-type" name="magazine-type" required>
                                <option value="fashion">Fashion</option>
                                <option value="sports">Sports</option>
                                <option value="technology">Technology</option>
                                <option value="health">Health</option>
                                <option value="business">Business</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="delivery-frequency">Delivery Frequency:</label></td>
                        <td>
                            <select id="delivery-frequency" name="delivery-frequency" required>
                                <option value="weekly">Weekly</option>
                                <option value="biweekly">Biweekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button type="submit">Submit</button>
                            <button type="button" onclick="updatemagazine()">Update</button>
                            <button type="button" onclick="deletemagazine()">Delete</button>
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
        $sql = "INSERT INTO  magzine (id, customer_name, customer_email, magazine_name, magazine_type, delivery_frequency) VALUES ('$_POST[id]', '$_POST[customer_name]', '$_POST[customer_email]', '$_POST[magazine_name]','$_POST[magazine_type]','$_POST[delivery_frequency]')";
        mysql_query( $sql, $connects);
            echo "Data stored...";
        
    } else if ($sb == "Update") {
        // Update existing customer record
        $sql = "UPDATE  magzine SET customer_name='$_POST[customer_name]', customer_email='$_POST[customer_email]', magazine_name='$_POST[magazine_name]',magazine_type='$_POST[magazine_type]',delivery_frequency='$_POST[delivery_frequency]'WHERE id='$_POST[id]'";
        mysql_query( $sql, $connects);
            echo "Data updated...";
    
    } else if ($sb == "Delete") {
        // Delete customer record
        $sql = "DELETE FROM  magzine WHERE id='$_POST[id]'";
        mysql_query( $sql, $connects);
            echo "Records deleted...";
    }
}

// Close the database connection
mysql_close($connects);
?>
