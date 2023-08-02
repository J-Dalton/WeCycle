<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"> </script>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js"
        integrity="sha512-Q1f3TS3vSt1jQ8AwP2OuenztnLU6LwxgyyYOG1jgMW/cbEMHps/3wjvnl1P3WTrF3chJUWEoxDUEjMxDV8pujg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <title>
        <?= $title ?>
    </title>
</head>

<body>
    <div class="container-fluid main-container-p">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom sticky-top">

            <div class="maintitle">
                We Cycle
            </div>

            <ul class="nav col-12 col-md-auto justify-content-center mb-md-0">

                <?php
                $base = basename($_SERVER['PHP_SELF']);


                if (!isset($_SESSION['Authorised'])) {
                    $_SESSION['Authorised'] = "N";
                }

                if ($_SESSION['Authorised'] == "Y") {
                    switch ($base) {
                        case "index.php":

                            echo '<li><a href="index.php" class="nav-link px-2 active">Home</a></li>';
                            if ($_SESSION["Admin"] == "Y") {
                                echo '<li><a href="admin.php" class="nav-link px-2">Admin</a></li>';
                            }
                            echo '<li><a href="logout.php" class="nav-link px-2">Logout</a></li>';
                            break;
                        case "Admin.php":
                            echo '<li><a href="index.php" class="nav-link px-2">Home</a></li>';
                            if ($_SESSION["Admin"] == "Y") {
                                echo '<li><a href="admin.php" class="nav-link px-2 active">Admin</a></li>';
                            }
                            echo '<li><a href="logout.php" class="nav-link px-2">Logout</a></li>';
                            break;

                        default:
                            echo '<li><a href="index.php" class="nav-link px-2">Home</a></li>';
                            if ($_SESSION["Admin"] == "Y") {
                                echo '<li><a href="admin.php" class="nav-link px-2">Admin</a></li>';
                            }
                            echo '<li><a href="logout.php" class="nav-link px-2">Logout</a></li>';
                    }
                }

                if ($_SESSION['Authorised'] == "N") {
                    switch ($base) {
                        case "index.php":
                            echo '<li><a href="index.php" class="nav-link px-2 active">Home</a></li>';
                            echo '<li><a href="login.php" class="nav-link px-2">Login</a></li>';
                            echo '<li><a href="signup.php" class="nav-link px-2">Signup</a></li>';
                            break;
                        case "login.php":
                            echo '<li><a href="index.php" class="nav-link px-2">Home</a></li>';
                            echo '<li><a href="login.php" class="nav-link px-2 active">Login</a></li>';
                            echo '<li><a href="signup.php" class="nav-link px-2">Signup</a></li>';
                            break;
                        case "signup.php":
                            echo '<li><a href="index.php" class="nav-link px-2">Home</a></li>';
                            echo '<li><a href="login.php" class="nav-link px-2">Login</a></li>';
                            echo '<li><a href="signup.php" class="nav-link px-2 active">Signup</a></li>';
                            break;
                    }
                }
                ?>
            </ul>
            </header>
        <?php
        if (isset($_SESSION["Admin"])) {
            if ($_SESSION["Admin"] == "N") {
                $accounttype = "Normal";
                switch ($base) {
                    case "index.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item active" aria-current="index.php">Home</li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "profile.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="profile.php">My Profile</li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "Groups.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "viewGroup.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "createGroup.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "updateGroup.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "Events.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "viewEvent.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "createEvent.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;

                    case "report.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;

                    case "Comments.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                }
            }

            if ($_SESSION["Admin"] == "Y") {
                $accounttype = "Admin";
                switch ($base) {
                    case "index.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item active" aria-current="index.php">Home</li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "profile.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="profile.php">My Profile</li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "Groups.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "viewGroup.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "createGroup.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "updateGroup.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "Events.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "viewEvent.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;
                    case "createEvent.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;

                    case "admin.php":
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</a></li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;

                    case "report.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;

                    case "Comments.php":
                        echo '<nav style="--bs-breadcrumb-divider: "";" aria-label="breadcrumb">';
                        echo '<div class ="usertype-message">' . 'Logged in as ' . $_SESSION['user_name'] . ' | Account type: ' . $accounttype . '</div>';
                        echo '<ol class="breadcrumb mb-0">';
                        echo '<li class="breadcrumb-item"><a href="index.php">Home</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Groups.php">Groups</a></li>';
                        echo '<li class="breadcrumb-item"><a href="Events.php">Events</li>';
                        echo '<li class="breadcrumb-item"><a href="profile.php">My Profile</a></li>';
                        echo '<li class="breadcrumb-item"><a href="admin.php">Admin area</a></li>';
                        echo '</ol>';
                        echo '</nav>';
                        break;

                }
            }
        }

        ?>
           


        <main>
            <?= $output ?>
        </main>

        <footer class="d-flex flex-wrap justify-content-between align-items-center border-top">
            <p class="col-md-4 mb-0">
                &copy; WeCycle 2023
            </p>
            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item">
                    <a href="index.php" class="nav-link px-2">Home</a>
                </li>
                <li class="nav-item">
                    <a href="send.php" class="nav-link px-2">Contact Us</a>
                </li>

            </ul>
        </footer>
</body>

</html>