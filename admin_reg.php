<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>

    <!-- ===== Custom CSS and Google Fonts ===== -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        /* Add the provided inline CSS here */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4070f4;
        }
        .container {
            position: relative;
            max-width: 900px;
            width: 100%;
            border-radius: 6px;
            padding: 30px;
            margin: 0 15px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        .container header {
            position: relative;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }
        .container header::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            height: 3px;
            width: 27px;
            border-radius: 8px;
            background-color: #4070f4;
        }
        .container form .title {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 500;
            margin: 6px 0;
            color: #333;
        }
        .container form .fields {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        form .fields .input-field {
            display: flex;
            width: calc(100% / 3 - 15px);
            flex-direction: column;
            margin: 4px 0;
        }
        /*... Other inline styles from the template */
    </style>
</head>
<body>
    <div class="container">
        <header>Admin Registration</header>

        <form name="admin_reg" action="" method="post">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Admin Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Admin ID</label>
                            <input type="number" id="id" name="id" placeholder="Enter Admin ID" required>
                        </div>

                        <div class="input-field">
                            <label>Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" required>
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                    </div>
                </div>

                <div class="buttons">
                    <button class="submit" type="submit" name="sbm" value="Register">
                        <span class="btnText">Register</span>
                        <i class="uil uil-navigator"></i>
                    </button>

                    <button class="submit" type="submit" name="sbm" value="Update">
                        <span class="btnText">Update</span>
                        <i class="uil uil-navigator"></i>
                    </button>

                    <button class="submit" type="submit" name="sbm" value="Delete">
                        <span class="btnText">Delete</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="script.js"></script>

    <!-- PHP Code -->
    <?php
    $connects = mysql_connect("localhost", "root");
    mysql_select_db("newspapermanagement", $connects);

    // Check if form is submitted
    if (isset($_POST['sbm'])) {
        $sb = $_POST['sbm'];

        if ($sb == "Register") {
            $sql = "INSERT INTO admins (id, name, email, password) VALUES ('$_POST[id]', '$_POST[name]', '$_POST[email]', '$_POST[password]')";
            mysql_query($sql, $connects);
            echo "Data stored...";
        } else if ($sb == "Update") {
            $sql = "UPDATE admins SET name='$_POST[name]', email='$_POST[email]', password='$_POST[password]' WHERE id='$_POST[id]'";
            mysql_query($sql, $connects);
            echo "Data updated...";
        } else if ($sb == "Delete") {
            $sql = "DELETE FROM admins WHERE id='$_POST[id]'";
            mysql_query($sql, $connects);
            echo "Records deleted...";
        }
    }

    // Close the database connection
    mysql_close($connects);
    ?>
</body>
</html>
