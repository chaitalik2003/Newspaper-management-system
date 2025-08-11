<?php
// Start session
session_start();

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

// Fetch customer details including locationArea
$sql_name_location = "SELECT name, locationArea FROM customers WHERE id = '$uid'";
$result_name_location = mysqli_query($connects, $sql_name_location);

// Initialize the customer data
$username = '';
$customer_location = '';

if ($row_name_location = mysqli_fetch_assoc($result_name_location)) {
    $username = $row_name_location['name'];
    $customer_location = $row_name_location['locationArea']; // Use locationArea for matching
}

// Fetch subscription details
$sql_subscription = "SELECT subscription_start, subscription_end, newspaper FROM customers WHERE id = '$uid'";
$result_subscription = mysqli_query($connects, $sql_subscription);

$subscription_start = '';
$subscription_end = '';
$subscribed_newspaper = '';

if ($row_subscription = mysqli_fetch_assoc($result_subscription)) {
    $subscription_start = $row_subscription['subscription_start'];
    $subscription_end = $row_subscription['subscription_end'];
    $subscribed_newspaper = $row_subscription['newspaper'];
}

// Fetch hawker details from the paperhawkers table based on locationArea
$sql_hawker = "SELECT name, contact, locationArea FROM paperhawkers WHERE locationArea = '$customer_location'";
$result_hawker = mysqli_query($connects, $sql_hawker);

$hawker_name = '';
$hawker_contact = '';
$hawker_location = '';

if ($row_hawker = mysqli_fetch_assoc($result_hawker)) {
    $hawker_name = $row_hawker['name'];
    $hawker_contact = $row_hawker['contact'];
    $hawker_location = $row_hawker['locationArea'];
}

// Fetch invoice details for the current session's ID (customer_id)
$sql_invoices = "SELECT id, customer_id, customer_name, contact_no, address, newspaper, rate_per_day, number_of_days, total_amount, payment_status, created_at 
                 FROM invoices_g 
                 WHERE customer_id = '$uid' AND payment_status = 'Unpaid'";
$result_invoices = mysqli_query($connects, $sql_invoices);

// Check if query executed successfully
if ($result_invoices === false) {
    die("Error in query: " . mysqli_error($connects));
}

// Check if any invoice details are found
$invoice_list = array();
if (mysqli_num_rows($result_invoices) > 0) {
    while ($row_invoice = mysqli_fetch_assoc($result_invoices)) {
        $invoice_list[] = $row_invoice; // Store each invoice in an array
    }
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
  <title></title>

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
                  <li><a href="index_cust.php">Home</a></li>
                  <li><a href="update_Profile_Cust.php">Profile</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li><a href="logout.php">logout</a></li>
                </ul>
              </nav>
              <!-- <a href="#" class="menu"><img src="assets/menu.png"></a> -->
              <div class="hero-text">
                <h1><span>Hi Reader, <i><?php echo htmlspecialchars($username); ?></i>
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
                <h4 class="sub-heading"></h4>
                <h1 class="heading purple" id="1st_head">Your Dashboard</h1>
                
                <!-- Subscription Details -->
                <h3>Your Subscription Details:</h3>
                <label for="userId">UserId:</label> <?php echo htmlspecialchars($uid); ?><br>
                <label for="start_date">Start Date:</label> <?php echo htmlspecialchars($subscription_start); ?><br>
                <label for="end_date">End Date:</label> <?php echo htmlspecialchars($subscription_end); ?><br>
                <label for="subscribed_newspaper">Subscribed Newspaper:</label> <?php echo htmlspecialchars($subscribed_newspaper); ?><br><br>
                
                <!-- Hawker Details -->
                <h3>Your Hawker Details:</h3>
                <label for="Hawker's Name">Hawker's Name:</label> <?php echo htmlspecialchars($hawker_name); ?><br>
                <label for="Hawker's Contact No">Hawker's Contact No:</label> <?php echo htmlspecialchars($hawker_contact); ?><br>
                <label for="Hawker's Location">Hawker's Location Area:</label> <?php echo htmlspecialchars($hawker_location); ?><br>
            </div>
        </div>
    </div>
</section>
<section class="testimonial">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="sub-heading">Your</h4>
                    <h1 class="heading pink" id="2nd_head"><span class="pink">Invoice</span></h1>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
          <div id="printableSection">
            <div class="invoice-box">
              <table cellpadding="0" cellspacing="0">
                  <tr class="top">
                      <td colspan="2">
                        <table>
                            </tr>
                            <!-- Subscription and Invoice Details -->
                            <?php if (!empty($invoice_list)): ?>
                    <?php foreach ($invoice_list as $invoice): ?>
                              <tr>
                                  <td class="title">
                                      <h4>Invoice</h4>
                                      <h2>CK-Papers</h2>
                                  </td>
                                  <td>
                                      Invoice #: <?php echo htmlspecialchars($invoice['id']); ?><br>
                                      Created: <?php echo htmlspecialchars($invoice['created_at']); ?><br>
                                      Payment Status: <strong><?php echo htmlspecialchars($invoice['payment_status']); ?></strong>
                                  </td>
                              </tr>
                          </table>
                      </td>
        
                  <!-- Customer Information -->
                  <tr class="information">
                      <td colspan="2">
                          <table>
                              <tr>
                                  <td>
                                      <strong>Customer Information</strong><br>
                                      <?php echo htmlspecialchars($invoice['customer_name']); ?><br>
                                      <?php echo htmlspecialchars($invoice['address']); ?><br>
                                      Contact: <?php echo htmlspecialchars($invoice['contact_no']); ?>
                                  </td>
                                  <td class="text-right">
                                      <strong>Hawker Information</strong><br>
                                      <?php echo htmlspecialchars($hawker_name); ?><br>
                                      Location: <?php echo htmlspecialchars($hawker_location); ?><br>
                                      Contact: <?php echo htmlspecialchars($hawker_contact); ?>
                                  </td>
                              </tr>
                              
                          </table>
                      </td>
                  </tr>
                
                  <!-- Subscription and Invoice Details -->
                  <tr class="heading">
                      <td>Newspaper Subscription</td>
                      <td></td>
                  </tr>
                  <tr class="item">
                      <td>Newspaper Name:</td>
                      <td><?php echo htmlspecialchars($invoice['newspaper']); ?></td>
                  </tr>
                  <tr class="item">
                      <td>Rate per Day:</td>
                      <td><?php echo htmlspecialchars($invoice['rate_per_day']); ?></td>
                  </tr>
                  <tr class="item">
                      <td>Number of Days:</td>
                      <td><?php echo htmlspecialchars($invoice['number_of_days']); ?></td>
                  </tr>
                  <tr class="item last">
                      <td>Total Amount:</td>
                      <td><?php echo htmlspecialchars($invoice['total_amount']); ?></td>
                  </tr>
                  
                  <!-- Total Amount -->
                  <tr class="total">
                      <td></td>
                      <td>Total: <?php echo htmlspecialchars($invoice['total_amount']); ?></td>
                  </tr>
              </table>
            </div>
          </div>
          <center><button onclick="printDiv('printableSection')" class="btn btn-lg btn-primary">Print</button></center>   
    <br>
    <?php endforeach; ?>
<?php else: ?>
    <h4><center>No unpaid invoices :)</center></h4>
<?php endif; ?>


            </div>
        </div>
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
      <script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); // Optionally reload the page to restore original content
    }
</script>
    </body>
    </html>
