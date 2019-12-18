<?php
require_once("header.php");

?>

<!-- //Step 7? -->

<div class="col-12 text-center">

    <h1>WELCOME</h1>

</div>

<div class="container my-5">

    <div class="row">

        

    <!-- SIGN IN FORM START -->
    <!-- SIGN IN FORM START -->
    <!-- SIGN IN FORM START -->
    <!-- SIGN IN FORM START -->
    <!-- step 1 make form-->


        <?php


            echo "<div class='col-6'>";
            if( isset($_SESSION["user_id"])) :
                $user_id = $_SESSION["user_id"];

                $user_query = " SELECT * FROM users 
                        WHERE id = " . $user_id;
    
                if($user_request = mysqli_query($conn, $user_query)) :
                    while ($user_row = mysqli_fetch_array($user_request)) :
                        echo "<h2>Welcome" . " " . $user_row["first_name"] . " " . $user_row["last_name"] . "</h2>";
                    ?>

                    <form action="/actions/login.php" method="post">
                    <button type="submit" name="action" value="logout" class="btn btn-warning">Logout</button>
                    </form>

                    <?php
                    endwhile;
    
                 endif;
             else :

        ?>
        <form class="col" action="/actions/login.php" method="POST">
            <div id="loginForm" class="col-md-12 p-5">

                <div class="text-center pb-5">
                    <h2>Sign in <br>to your account</h2>
                </div>

                <!-- step 3 show error messages. this links to the step 3 on login page-->
                <?php
                    include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
                ?>



                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <p>
                        <button class="btn btn-warning w-100 text-white" type="submit" name="action" value="login">Login</button>
                    </p>
                </div>
            </div>
        </form>
        <?php
        endif;
        echo "</div>";
        ?>

<!-- SIGN UP FORM START -->
<!-- SIGN UP FORM START -->
<!-- SIGN UP FORM START -->
<!-- SIGN UP FORM START -->


        <div id="signUpForm" class="col-md-6">
        <form action="/actions/login.php" class="col-md-12 p-5" method="post">
            <div class="text-center text-white pb-5">
                <h2>Not a member? <br>Join now!</h2>
            </div>
        <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
        ?>

        <!-- firstname, last name, address, province, postal, password, confirm password, -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="first_name"  name="first_name" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputCity" name="city" placeholder="City">
                </div>
                <div class="form-group col-md-6">
                    <select id="province" name="province" class="form-control">
                        <option selected disabled>Province...</option>
                        <?php
                            $provinces = [
                                "British Columbia",
                                "Alberta",
                                "Saskatchewan",
                                "Manitoba",
                                "Ontario",
                                "Quebec",
                                "New Brunswick",
                                "Nova Scotia",
                                "PEI",
                                "Newfoundland",
                                "Nunavut",
                                "Yukon",
                                "NWT"
                            ];
                            for($i = 0; $i < count($provinces); $i++){
                                echo "<option value='".($i + 1)."'>$provinces[$i]</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="agree_terms">
                    <label class="form-check-label text-white" for="gridCheck">
                        I agree to the terms of service
                    </label>
                </div>
            </div>
            <div class="form-group">
                <strong class="text-white">Sign up for Junk Mail?</strong>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="newsletter" id="newsletter_yes" value="true" checked>
                  <label class="form-check-label text-white" for="newsletter_yes">
                    Definitely
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="newsletter" id="newsletter_no" value="false">
                  <label class="form-check-label text-white" for="newsletter_no">
                    No Way
                  </label>
                </div>
                
            </div>
            <div class="form-group">
                
                <strong class="text-white">Choose your role</strong>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="role" id="role2" value="2" checked>
                  <label class="form-check-label text-white" for="role2">
                    I'm role number 2
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="role" id="role3" value="3">
                  <label class="form-check-label text-white" for="role3">
                  I'm role number 3
                  </label>
                </div>
                
            </div>
            <button type="submit" class="btn btn-warning w-100 text-white" name="action" value="signup">Sign Up</button>

        </form>
        </div>

    </div>

</div>












<?php
require_once("footer.php");
?>
