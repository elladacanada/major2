<?php
require_once("header.php");


/*-- step 2 make session on conn page and make actions folder with login.php page.  -->*/

print_r($_SESSION);

?>




<!-- step 1 make form-->

<div class="container">
    <div class="row">

    <div class="col-12">
    <h1>SSP Major Project</h1>
    </div>
    <!-- step5 -->
        <?php


            echo "<div class='col-12'>";
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
            <h2>Login</h2>

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
                    <button class="btn btn-primary" type="submit" name="action" value="login">Login</button>
                </p>
                <p>
                    <a href="/signup.php">Create Account?</a>
                </p>
            </div>
        </form>
        <?php
        endif;
        echo "</div>";
        ?>
    </div>
</div>


























<?php
require_once("footer.php");
?>


