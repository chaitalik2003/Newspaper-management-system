<?php
$invalid_msg = ""; // Initialize the variable to store the invalid message

$cn = mysql_connect("localhost", "root");
mysql_select_db("newspapermanagement", $cn);

if (isset($_POST['sbm'])) { // Check if the form has been submitted
    $ui = $_POST['ui'];
    $ps = $_POST['ps'];

    // Check for admin credentials
    if ($ui == "admin" && $ps == "admin") {
        session_start();
        $_SESSION['id'] = $ui;
        header("Location: http://localhost/newspaper_agency_system/index_ad.php");
        exit();
    }
    
    // Check customer credentials
    $sql = "SELECT COUNT(*) FROM customers WHERE id='$ui' AND password='$ps'";
    $result = mysql_query($sql, $cn);
    $row = mysql_fetch_array($result);
    
    if ($row[0] > 0) {
        session_start();
        $_SESSION['id'] = $ui;
        header("Location: http://localhost/newspaper_agency_system/index_cust.php");
        exit();
    } 
    
    // Check paper hawker credentials if not a customer
    $sql = "SELECT COUNT(*) FROM paperhawkers WHERE id='$ui' AND password='$ps'";
    $result = mysql_query($sql, $cn);
    $row = mysql_fetch_array($result);
    
    if ($row[0] > 0) {
        session_start();
        $_SESSION['id'] = $ui;
        header("Location: http://localhost/newspaper_agency_system/index_hawk.php");
        exit();
    } else if (isset($_POST['sbm'])){
        $invalid_msg = "INVALID USER-NAME OR PASSWORD";
    }
    // If none of the above conditions are met, set the invalid message
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>CK-Papers</title>

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
                  <li><a href="index.html">Home</a></li>
                  <li><a href="customer_reg.php">Register Customer</a></li>
                  <li><a href="newspaperhawker_reg.php">Register Hawker</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="contact.html">Contact</a></li>
                </ul>
              </nav>
              <!-- <a href="#" class="menu"><img src="assets/menu.png"></a> -->
              <div class="hero-text">
                <h1><span><i>Hey, </i>User </span><br>Kindly Login,</h1>
                <h3>Stay Informed, Stay Engaged</h3>
                <form name="frm" method="post" action="login.php">
                    <table class="login-table">
                        <tr>
                            <td>UserId:</td>
                            <td><input type="text" name="ui" placeholder="Enter Username!" required></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="ps" placeholder="Enter Password" required></td>
                        </tr>
                    </table>
                    <!-- Display invalid message only if the login attempt was made -->
                    <p style="color:red;"><?php  echo $invalid_msg; ?></p> 
                    <input type="submit" name="sbm" value="LOGIN" class="btn btn-lg btn-primary">
                </form>
   
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
</html>
