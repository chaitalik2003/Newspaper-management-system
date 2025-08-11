<?php
    $connects= mysql_connect("localhost", "root");
    mysql_select_db("newspapermanagement", $connects);
    $sql = "SELECT MAX(CAST(SUBSTRING(id, 2) AS UNSIGNED)) AS max_id FROM paperhawkers";
    $result=mysql_query($sql,$connects);
    // Fetch the result
    $row = mysql_fetch_assoc($result);

// Check if there are existing records and then increment
    if ($row['max_id'] !== null) {
        $x = $row['max_id'] + 1;  // Increment the number
    } else {
        // Start with 1 if there are no existing records
        $x = 1;
    }
// added C to each id
    $new_id= 'H'.$x;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paper Hawker Registration</title>

  
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
    <!-- JavaScript for form actions -->

</head>
<script>
        function updatenewspaperhawker() {
            document.forms["newspaperhawker_reg"].action = "newspaperhawker_reg.php?operation=update";
            document.forms["newspaperhawker_reg"].submit();
        }

        function deletenewspaperhawker() {
            document.forms["newspaperhawker_reg"].action = "newspaperhawker_reg.php?operation=delete";
            document.forms["newspaperhawker_reg"].submit();
        }
    </script>
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
                  <li><a href="about.html">About</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li><a href="logout.php">Login</a></li>
                </ul>
              </nav>
              <!-- <a href="#" class="menu"><img src="assets/menu.png"></a> -->
              <div class="hero-text">
                <h1><span>Hi Hawker, </span><br>Welcome to CK-Papers.</h1>
                <h3>Stay Informed, Stay Engaged</h3>
                <a href="#1st_head" class="btn btn-lg btn-primary">Click Here to Register!</a>
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
                  <h4 class="sub-heading">Hawker's</h4>
                      <h1 class="heading purple" id="1st_head"><span class="purple">Register</span> Yourself <br></h1>
                      <!-- Register form -->
                      <div class="container">
                        <center>
            <form name="newspaperhawker_reg" action="newspaperhawker_reg.php" method="post">
                <table class="form-table">
                    <tr>
                        <td><label for="id">Hawker ID:</label></td>
                        <td><input type="text" id="id" name="id" value="<?php echo $new_id;?>"  required></td>
                    </tr>
                    <tr>
                        <td><label for="name">Name:</label></td>
                        <td><input type="text" id="name" name="name" placeholder="Enter your name!" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" placeholder="CK@example.com" required></td>
                    </tr>
                    <tr>
                        <td><label for="location">Location/Area:</label></td>
                        <td><input type="text" id="location" name="location" placeholder= "Location where you serve!" required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" placeholder="Enter Password" required></td>
                    </tr>
                    <tr>
                        <td><label for="contact">Contact:</label></td>
                        <td><input type="text" id="contact" name="contact" placeholder="Mobile no" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h6>All fields are mandatory</h6>
                        </td>
                    </tr>
                    <tr>
                        <!-- <td colspan="2" align="center">
                            <input type="submit" value="Register" name="sbm"> 
                            <button type="button" onclick="updatenewspaperhawker()">Update</button>
                            <button type="button" onclick="deletenewspaperhawker()">Delete</button>
                        </td> -->
                    </tr>
                </table>
                <div class="button-container">
                    <button type="submit" value="Register" name="sbm">Register</button>
                    <h6><a href="login.php">Already registered?, login.</a></h6>
                </div>
            </form>
        </div>
    </center>
    </section>

<div class="form-footer">
    
</div>
</div>



<!-- Footer -->
<footer>
<div class="container-fluid">
  <div class="row footer">
    <div class="col-md-12 text-center">
      <img src="assets/reading.png">
      
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

<?php // PHP DATABASE CONNECTION CODE STARTS FROM HERE?>
<?php

$connects = mysqli_connect("localhost", "root", "", "newspapermanagement");

if (!$connects) {
    die("Connection failed: " . mysqli_connect_error());
}
// Check if form is submitted
if (isset($_POST['sbm'])) {
    $sb = $_POST['sbm'];

    if ($sb == "Register") {
        // Insert new customer record
        $sql = "INSERT INTO  paperhawkers (id, name, email, locationArea, password, contact) VALUES ('$_POST[id]', '$_POST[name]', '$_POST[email]', '$_POST[location]', '$_POST[password]','$_POST[contact]')";
        if (mysqli_query($connects, $sql)) {
            echo "<script>alert('Data stored successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($connects) . "');</script>";
        }
        
    }
 }if (isset($_GET['operation']) && $_GET['operation'] == 'update') {
   
    // Update existing paperhawker record
    $sql = "UPDATE paperhawkers SET name='" . $_POST['name'] . "', email='" . $_POST['email'] . "', locationArea='" . $_POST['location'] . "', password='" . $_POST['password'] . "', contact='" . $_POST['contact'] . "' WHERE id='" . $_POST['id'] . "'";
    
    // Now pass the connection and the query correctly
    if (mysqli_query($connects, $sql)) {
        echo "<script>alert('Data updated successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connects) . "');</script>";
    }
}
    if (isset($_GET['operation']) && $_GET['operation'] == 'delete') {
        // Delete paperhawker record
        $sql = "DELETE FROM paperhawkers WHERE id='" . $_POST['id'] . "'";
        
        if (mysqli_query($connects, $sql)) {
            echo "<script>alert('Record deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($connects) . "');</script>";
        }
    }

// Close the database connection
mysqli_close($connects);
?>

</body>
</html>




