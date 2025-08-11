<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
</head>
<body>
    <center>
        <div class="container">
            <h2>Generate Report</h2>
            <form name="reports" action="reports.php" method="post">
                <table>
                    <tr>
                        <td><label for="report_date">Report Date:</label></td>
                        <td><input type="date" id="report_date" name="report_date" required></td>
                    </tr>
                    <tr>
                        <td><label for="total_deliveries">Total Deliveries:</label></td>
                        <td><input type="number" id="total_deliveries" name="total_deliveries" required></td>
                    </tr>
                    <tr>
                        <td><label for="successful_deliveries">Successful Deliveries:</label></td>
                        <td><input type="number" id="successful_deliveries" name="successful_deliveries" required></td>
                    </tr>
                    <tr>
                        <td><label for="missed_deliveries">Missed Deliveries:</label></td>
                        <td><input type="number" id="missed_deliveries" name="missed_deliveries" required></td>
                    </tr>
                    <tr>
                        <td><label for="delays">Delays:</label></td>
                        <td><input type="number" id="delays" name="delays" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button type="submit">Submit</button>
                            <button type="button" onclick="updatereports()">Update</button>
                            <button type="button" onclick="deletereports()">Delete</button>
                            <button type="button" onclick="displayreports()">Display</button>
                            <button type="button" onclick="searchreports()">Search</button>
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
        $sql = "INSERT INTO  reports (id,report_date,total_deliveries,successful_deliveries,missed_deliveries,delays) VALUES ('$_POST[id]','$_POST[report_date]', '$_POST[total_deliveries]', '$_POST[successful_deliveries]', '$_POST[missed_deliveries]','$_POST[delays]')";
        mysql_query( $sql, $connects);
            echo "Data stored...";
        
    } else if ($sb == "Update") {
        // Update existing customer record
        $sql = "UPDATE  reports SET report_date='$_POST[report_date]',total_deliveries='$_POST[total_deliveries]', successful_deliveries='$_POST[successful_deliveries]', missed_deliveries='$_POST[missed_deliveries]',delays='$_POST[delays]' WHERE id='$_POST[id]'";
        mysql_query( $sql, $connects);
            echo "Data updated...";
    
    } else if ($sb == "Delete") {
        // Delete customer record
        $sql = "DELETE FROM  reports WHERE id='$_POST[id]'";
        mysql_query( $sql, $connects);
            echo "Records deleted...";
        } else if ($sb == "Display") {
            // Check if an ID is provided
            if (!empty($_POST['id'])) {
                // Display the specific record with the provided ID
                $search_id = $_POST['id'];
                $sql = "SELECT * FROM reports WHERE id='$search_id'";
                $result = mysql_query($sql, $connects);
        
                if (mysql_num_rows($result) > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>ID</th><th>Report date</th><th>Total Deliveries</th><th>Successful Deliveries</th><th>Missed Deliveries</th><th>Delays</th></tr>";
                    while ($row = mysql_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['report_date']}</td>
                                <td>{$row['total_deliveries']}</td>
                                <td>{$row['successful_deliveries']}</td>
                                <td>{$row['missed_deliveries']}</td>
                                <td>{$row['delays']}</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No records found for ID: $search_id";
                }
            } else {
                // No ID provided
                echo "Please provide an ID to display the records.";
            }
        
        
        } else if ($sb == "Search") {
            // Check if an ID is provided
            if (!empty($_POST['id'])) {
                // Search for the specific record with the provided ID
                $search_id = $_POST['id'];
                $sql = "SELECT * FROM reports WHERE id='$search_id'";
                $result = mysql_query($sql, $connects);
        
                if (mysql_num_rows($result) > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>ID</th><th>Report date</th><th>Total Deliveries</th><th>Successful Deliveries</th><th>Missed Deliveries</th><th>Delays</th></tr>";
                    while ($row = mysql_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['report_date']}</td>
                                <td>{$row['total_deliveries']}</td>
                                <td>{$row['successful_deliveries']}</td>
                                <td>{$row['missed_deliveries']}</td>
                                <td>{$row['delays']}</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No records found for ID: $search_id";
                }
            } else {
                // No ID provided
                echo "Please provide an ID to search for the records.";
            }
        }
        
    }
// Close the database connection
mysql_close($connects);
?>



