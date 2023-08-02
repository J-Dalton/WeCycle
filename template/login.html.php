<container class="logincontainer">
    <form method="POST" action="login.php" class="loginform">
        <image src="welcomeImage.jpg" class="fullImage"></image>
        <div class="card my-2 rounded border-0 centered">
            <div class="card-body rounded border-0 centered">
                <h3>Login</h3>
                <table>
                    <tr>
                        <td>
                            <input class="rounded-2 my-2 border-glow" type="text" name="user_name" size="20" placeholder="User Name" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input class="rounded-2 my-2 border-glow" type="password" name="user_password" size="20" placeholder="Password" required>
                        </td>
                    </tr>

                </table>

                <div class="login-button">
                    <input class="btn btn-primary my-2" type="submit" name="login-button" value="Submit">
                </div>

                <a href="signup.php" class="d-flex justify-content-center my-1">Signup</a></li>

            </div>

        </div>
        <?php
        if (isset($errormessage[2])) {
            foreach ($errormessage[2] as $nosuchusererror) {
                echo '<div class="loginerrorpos rounded border-0 shadow alert alert-danger my-0">';
                echo '<div class="rounded border-0">';
                echo "<p class='loginform'>" . $nosuchusererror . "</p>";
                echo '</div>';
                echo '</div>';

            }
        }
        ;
        ?>
    </form>
</container>