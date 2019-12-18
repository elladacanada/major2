<?php

require_once("header.php");
?>
<h1>SSP Drill 1</h1>
<?php
$query = " SELECT users.*, provinces.names AS province_name
            FROM users
            LEFT JOIN provinces
            ON users.province_id = provinces.id"; 

if($user_request = mysqli_query($conn, $query)):
    echo "<ul>"; //we echo the ul inside the if so it is not repeated in the while statment
    while ($user_row = mysqli_fetch_array($user_request) ) :
?>
    

    
    <li><?= $user_row["first_name"] . " lives in " . $user_row["province_name"] ." and started on " . date("l", strtotime($user_row["date_created"])) . " of " . date("F", strtotime($user_row["date_created"])) . " in " . date("Y", strtotime($user_row["date_created"])); ?></li>
    



<?php

    endwhile;
    echo "</ul>";
endif;

require_once("footer.php");
?>