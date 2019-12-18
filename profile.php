<?php
require_once("header.php");



//get checks url for user id.  isset checks to see if $get is set. if its set then use the url, if not set then use the session
$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];

$user_query = " SELECT users.*, provinces.names AS province_name, images.url AS profile_pic
                FROM users 
                LEFT JOIN provinces
                ON users.province_id = provinces.id
                LEFT JOIN images
                ON users.profile_pic_id = images.id
                WHERE users.id = " . $user_id;

//if the user request variable is true then un this if statement
if($user_request = mysqli_query($conn, $user_query)) :
    while ($user_row = mysqli_fetch_array($user_request)) :
        // print_r($user_row);
?>

<div class="container">
    <div class="row">
        <div class="col-4">
            <img src="<?php echo $user_row['profile_pic']; ?>" class="w-100" alt="profile picture">
        </div>
        <div class="col-8">
            <?php
            include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>
            <h1><?php echo $user_row["first_name"] . " " . $user_row["last_name"];?></h1>
            <p>
                <?=$user_row["address"];?> <br>
                <!-- //if address2 is nopt empty, get it. :else leave blank -->
                <?=($user_row["address2"] != "") ? $user_row["address2"]. '<br>':'';?>
                <?=$user_row["city"] . ", " . $user_row["province_name"];?> <br>
                
                <?=$user_row["postal_code"];?>
            </p>
            <p>
                <?=$user_row["email"];?>
            </p>
            <hr>
            <?php
            if($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1):
            ?>
            <div class="btn-group">
                <a href="/edit_profile.php?user_id=<?=$user_row["id"];?>" class="btn btn-outline-primary">Edit Profile</a>
                
            </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>


<?php
endwhile;
else :
   echo mysqli_error($conn);
endif;

require_once("footer.php");
?>
