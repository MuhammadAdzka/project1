<?php
    session_start();
    include('server/connection.php');
    include('layouts/header.php');

    if (isset($_SESSION['logged_in'])) {
        header('location: account.php');
        exit;
    }

    if (isset($_POST['login_btn'])) {
        $email = $_POST['user_email'];
        $password = md5($_POST['user_password']);

        $query = "SELECT user_id, user_name, user_email, user_password, user_phone, user_address, user_city, user_photo FROM users WHERE user_email = ? AND user_password = ? LIMIT 1";

        $stmt_login = $conn->prepare($query);
        $stmt_login->bind_param('ss', $email, $password);
        
        if ($stmt_login->execute()) {
            $stmt_login->bind_result($user_id, $user_name, $user_email, $user_password, $user_phone, $user_address, $user_city, $user_photo);
            $stmt_login->store_result();

            if ($stmt_login->num_rows() == 1) {
                $stmt_login->fetch();

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_phone'] = $user_phone;
                $_SESSION['user_address'] = $user_address;
                $_SESSION['user_city'] = $user_city;
                $_SESSION['user_photo'] = $user_photo;
                $_SESSION['logged_in'] = true;

                header('location: account.php?message=Logged in successfully');
            } else {
                header('location: login.php?error=Could not verify your account');
            }
        } else {
            // Error
            header('location: login.php?error=Something went wrong!');
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male-Fashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Login</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="login-form" method="POST" action="login.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php if (isset($_GET['error'])) {
                                echo $_GET['error'];
                            } ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <h6 class="checkout__title">Login</h6>
                            <div class="checkout__input">
                                <p>Email</p>
                                <input type="email" name="user_email">
                            </div>
                            <div class="checkout__input">
                                <p>Password</p>
                                <input type="password" name="user_password">
                            </div>
                            <div class="checkout__input">
                                <input type="submit" class="site-btn" id="login-btn" name="login_btn" value="LOGIN" />
                            </div>
                            <div class="checkout__input__checkbox">
                                <label>
                                    <a id="register-url" href="register.php">Do you have an account? Register</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->



    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
<?php
    include('layouts/footer.php');
?>
</html>