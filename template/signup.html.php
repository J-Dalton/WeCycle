<container class="logincontainer">
    <form method="POST" class="loginform">
        <image src="welcomeImage.jpg" class="fullImage"></image>
        <div class="card my-2 rounded shadow border-0 centered">
            <div class="card-body shadow rounded border-0 centered">
                <h3>Signup</h3>
                <table>
                    <tr>
                    
                        <td><input class="rounded-2 my-2 border-glow" type="text" name="first_name" size="20" placeholder="First Name" maxlength="25"
                                id="f_name" required></td>
                    </tr>

                    <tr>
                      
                        <td><input class="rounded-2 my-2 border-glow" type="text" name="last_name" size="20" placeholder="Last Name" maxlength="25"
                                required></td>
                    </tr>

                    <tr>
                
                        <td><input class="rounded-2 my-2 border-glow" type="text" name="user_name" size="20" placeholder="User Name" required
                                maxlength="45"></td>
                    </tr>

                    <tr>
                    
                        <td><input class="rounded-2 my-2 border-glow" type="password" name="user_password" size="20" placeholder="Password" maxlength="25"
                                required></td>
                    </tr>

                </table>

                <div class="signup-button">
                    <input class="btn btn-primary" type="submit" name="signup-button" value="Register Account">
                </div>

            </div>
        </div>

        <?php if (isset($message)) {
            echo $message;
        } ?>

    </form>




</container>