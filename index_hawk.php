<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if session ID is set
if (!isset($_SESSION['id'])) {
    // die("Session ID not set.");
    header("location:http://localhost/newspaper_agency_system/login.php");
    exit;
}

// Get the session ID
$uid = $_SESSION['id'];

// Establish database connection using MySQLi
$connects = mysqli_connect("localhost", "root", "", "newspapermanagement");

// Check connection
if (!$connects) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch hawker details including locationArea
$sql_name_location = "SELECT name, locationArea FROM paperhawkers WHERE id = '$uid'";
$result_name_location = mysqli_query($connects, $sql_name_location);

// Initialize the hawker data
$username = '';
$hawker_location = '';

if ($row_name_location = mysqli_fetch_assoc($result_name_location)) {
    $username = $row_name_location['name'];
    $hawker_location = $row_name_location['locationArea']; // Use locationArea for matching
}

// Check if hawker location was fetched successfully
if (empty($hawker_location)) {
  die("Hawker location not set or not found in the database.");
  header("location:http://localhost/newspaper_agency_system/login.php");
    exit;
}

// Get today's date
$today = date('Y-m-d');

// Fetch customers who are within the subscription date range and match the hawker's location
$sql_customers = "SELECT name, address, contact, locationArea, newspaper FROM customers 
                  WHERE subscription_start <= '$today' 
                  AND subscription_end >= '$today' 
                  AND locationArea = '$hawker_location'";
$result_customers = mysqli_query($connects, $sql_customers);

// Check if query executed successfully
if ($result_customers === false) {
    die("Error in query: " . mysqli_error($connects));
}

// Check if any customers are found
$customers_list = array(); // Initialize customers list

if (mysqli_num_rows($result_customers) > 0) {
    while ($row_customer = mysqli_fetch_assoc($result_customers)) {
        $customers_list[] = $row_customer;  // Store each customer's details in an array
    }
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
      echo "<script>alert('Invoice generated successfully!');</script>";
  } else {
      echo "Error: " . mysqli_error($connects);
  }
}

// update Payment status

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['payment_status'])) {
  $invoice_id = mysqli_real_escape_string($connects, $_GET['id']);
  $payment_status = mysqli_real_escape_string($connects, $_GET['payment_status']);

  $sql_update_status = "UPDATE invoices_g SET payment_status = ? WHERE id = ?";
  $stmt_update = mysqli_prepare($connects, $sql_update_status);
  mysqli_stmt_bind_param($stmt_update, "si", $payment_status, $invoice_id);

  if (mysqli_stmt_execute($stmt_update)) {
      echo "<script>alert('Payment status updated successfully!');</script>";
  } else {
      echo "<script>alert('Error: " . mysqli_error($connects) . "');</script>";
  }

  mysqli_stmt_close($stmt_update);
}

// Close the database connection
mysqli_close($connects);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Hawker's page</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link rel="stylesheet" href="css/swiper.min.css">
  <link href="css/style.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Open+Sans:300,400,700" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
      <header class="hero">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-6 col-xs-12">
              <nav>
                <div id="menu-toggle">
                  <div class="hamburger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                  </div>
                  <div class="cross">
                    <span class="line"></span>
                    <span class="line"></span>
                  </div>
                </div>
                <ul class="main-nav">
                  <li><a href="index_hawk.php">Home</a></li>
                  <li><a href="update_Profile_hawker.php">Profile</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="contact.php">Contact</a></li>
                  <li><a href="logout.php">logout</a></li>
                </ul>
              </nav>
              <!-- <a href="#" class="menu"><img src="assets/menu.png"></a> -->
              <div class="hero-text">
              <h1><span>Hi Hawker, <i><?php echo htmlspecialchars($username); ?></i>

        </span><br>Welcome to CK-Papers.</h1>
                <h3>Stay Informed, Stay Engaged</h3>
                <a href="#1st_head" class="btn btn-lg btn-primary">Know More</a>
                <ul class="social-links">
                  <li class="label">Join me here</li>
                  <li><a href="Mailto:Kchaitali788@gmail.com"><img src="assets/gmail.png"></a></li>
                <li><a href="https://www.instagram.com/_chaitali_02?igsh=M2Jxendpamd5dXRh"><img src="assets/instagram.png"></a></li>
                <li><a href="tel:8923917371"><img src="assets/phone.png"></a></li>
                <li><a href="https://www.linkedin.com/in/chaitali-k-5138b022a"><img src="assets/linkedin.png"></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>

      <section class="case-study">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="heading purple" id="1st_head">Your Dashboard</h1>
          <h3>Todays customers list</h3>
          
          <!-- Display Customers -->
          <?php if (!empty($customers_list)): ?>
              <ul>
                <?php foreach ($customers_list as $customer): ?>
                  <li>
                    <b>Name:</b> <?php echo htmlspecialchars($customer['name']); ?> <br>
                    <b>Newspaper</b> <?php echo htmlspecialchars($customer['newspaper']); ?> <br>
                    <b>Address:</b> <?php echo htmlspecialchars($customer['address']); ?> <br>
                    <b>contact</b> <?php echo htmlspecialchars($customer['contact']); ?>

                  </li>
                  <br>
                <?php endforeach; ?>
              </ul>
          <?php else: ?>
              <p>No customers with active subscriptions found for today.</p>
          <?php endif; ?>
          
        </div>
      </div>
    </div>
  </section>


      <section class="testimonial">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h4 class="sub-heading">Generate</h4>
              <h1 class="heading pink" id="2nd_head"><span class="pink">Invoices</span></h1>
              <center>
        <h2>Invoice Generation</h2>
        <form name="Invoice" action="index_hawk.php" method="post">
            <table class="form-table" border="1">
                <tr>
                    <td><label for="customerId">Customer ID:</label></td>
                    <td><input type="text" name="customerId" id="customerId" placeholder="Enter Customer ID" required></td>
                </tr>
                <tr>
                    <td><label for="customerName">Customer Name:</label></td>
                    <td><input type="text" name="customerName" id="customerName" placeholder="Enter Customer Name" required></td>
                </tr>
                <tr>
                    <td><label for="contactNo">Contact Number:</label></td>
                    <td><input type="text" name="contactNo" id="contactNo" placeholder="Enter Contact Number" required></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" id="address" placeholder="Enter Address" required></td>
                </tr>
                <tr>
                    <td><label for="newspaper">Newspaper:</label></td>
                    <td>
                        <select name="newspaper" id="newspaper" required>
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
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="rate">Rate Per Day:</label></td>
                    <td><input type="number" name="rate" id="rate" placeholder="Enter Rate Per Day" required></td>
                </tr>
                <tr>
                    <td><label for="days">Number of Days:</label></td>
                    <td><input type="number" name="days" id="days" placeholder="Enter Number of Days" required></td>
                </tr>
                <tr>
                    <td><label for="paymentStatus">Payment Status:</label></td>
                    <td>
                        <select name="paymentStatus" id="paymentStatus" required>
                        <option value="" disabled selected>Select Payment Status</option>
                            <option value="Paid">Paid</option>
                            <option value="Unpaid">Unpaid</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br>
            <button type="submit" class="btn btn-lg btn-primary">Generate Invoice</button>
          </form>
        </center>
        
      </div>
      
            <h1>Update Payment Status</h1>
            <form name="paymentStatus" method="post" action="index_hawk.php">
    <table class="form-table">
        <tr>
            <td><label for="invoice_id">Invoice ID:</label></td>
            <td><input type="text" id="id" name="id" required></td>
        </tr>
        <tr>
            <td><label for="payment_status">Payment Status:</label></td>
            <td>
                <select id="payment_status" name="payment_status" required>
                    <option value="" disabled selected>Select Payment Status</option>
                    <option value="Paid">Paid</option>
                    <option value="Failed">Failed</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="button" onclick="updateStatus()">Update</button>
            </td>
        </tr>
    </table>
</form>
          </div>  
        </div> <br><br>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            
          </section>


      <!-- Statistics -->
      <section class="stats">
        <div class="container">
          <div class="row">
            <div class="col-md-4 text-center stat-box">
              <h1 class="purple"><span class="counter">10,000</span></h1>
              <h3>Customers</h3>
            </div>
            <div class="col-md-4 text-center stat-box">
              <h1 class="blue counter">48</h1>
              <h3>Hawkers</h3>
            </div>
            <div class="col-md-4 text-center stat-box">
              <h1 class="pink"><span class="counter">23</span></h1>
              <h3>Types of Papers</h3>
            </div>
          </div>
        </div>
      </section>

      <!-- Contact Banner -->
      <section class="contact-banner">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <h1>Bringing News to Your Doorstep, One Story at a Time.</h1>
              <a href="#" class="btn btn-lg btn-primary">Stay Connected with Us!</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer>
        <div class="container-fluid">
          <div class="row footer">
            <div class="col-md-12 text-center">
              <img src="assets/reading.png" alt="" srcset="">
              
              <br><hr><h1><span>CK-Papers</span></h1>
              <ul class="social-links">
                <li><a href="Mailto:Kchaitali788@gmail.com"><img src="assets/gmail.png"></a></li>
                <li><a href="https://www.instagram.com/_chaitali_02?igsh=M2Jxendpamd5dXRh"><img src="assets/instagram.png"></a></li>
                <li><a href="tel:8923917371"><img src="assets/phone.png"></a></li>
                <li><a href="https://www.linkedin.com/in/chaitali-k-5138b022a"><img src="assets/linkedin.png"></a></li>
              </ul>
            </div>
          </div>
          <div class="row sub-footer">
            <div class="col-md-12 text-center">
              <p>Devloped by <a href="#" target="_blank">Chaitali N. Kulkarni</a> | Gmail <a href="mailto:Kchaitali788@gmail.com">here</a></p>
              <p>Designed by <a href="#" target="_blank">@realvjy</a> | Download <a href="http://designerdada.com/free-bootstrap-one-page-portfolio-template/">here</a></p>
            </div>
          </div>
        </div>
      </footer>

      <!-- Some Javascript -->
      <script src="js/jquery-2.1.1.js"></script>
      <script src="js/swiper.jquery.min.js"></script>
      <!-- Initialize Client Swiper -->
      <script>
      var swiper1 = new Swiper('.client-swiper', {
        slidesPerView: 3,
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 60,
        // Responsive breakpoints
        breakpoints: {
          // when window width is <= 320px
          320: {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: '.swiper-pagination'
          },
          // when window width is <= 480px
          480: {
            slidesPerView: 1,
            spaceBetween: 20
          },
          // when window width is <= 640px
          640: {
            slidesPerView: 1,
            spaceBetween: 30
          }
        }
      });
      // Initialize Testimonial Swiper
      var swiper2 = new Swiper('.testimonial-swiper', {
        slidesPerView: 3,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        spaceBetween: 30,
        grabCursor: true,
        freeMode: true,
        breakpoints: {
          // when window width is <= 320px
          320: {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          // when window width is <= 480px
          480: {
            slidesPerView: 1,
            spaceBetween: 10
          },
          // when window width is <= 640px
          640: {
            slidesPerView: 1,
            spaceBetween: 10
          }
        }
      });
      </script>
    <script>
        function updateStatus() {
            document.forms["paymentStatus"].action = "index_hawk.php?operation=update";
            document.forms["paymentStatus"].submit();
        }
    </script>

      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <script>
      // Counterup
      $('.counter').counterUp({
        time: 1000
      });

      // Main Navigation
      $('#menu-toggle').click(function(){
        $(this).toggleClass('open'),
        $('.main-nav').toggleClass('show-it');
      })
      </script>

      <!-- Google Analytics - You should remove this -->
      <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-29231762-2', 'auto');
      ga('send', 'pageview');

      </script>
    </body>
    </html>