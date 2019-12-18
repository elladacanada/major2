<?php
// if (!empty($errors)) $_GET["errors"] = $errors;
// if (!empty($success)) $_GET["success"] = $success;
//     if ( isset($_GET["errors"])){
//         foreach($_GET["errors"] as $error){
//             echo "<p class='alert alert-danger'> ". $error ."</p>";
//         }
//     } elseif ( isset($_GET["success"])) {
//             echo "<p class='alert alert-success'> ". $_GET["success"] . "</p>";
//     }

?>

<?php
if (!empty($errors)) $_GET["errors"] = $errors;
if (!empty($success)) $_GET["success"] = $success;
    if ( isset($_GET["errors"])){
        foreach($_GET["errors"] as $error){
            echo "<p class='alert alert-danger'> ". $error ."</p>";
        }
    } elseif ( isset($_GET["success"])) {
        foreach($_GET["success"] as $success){
            
            echo "<p class='alert alert-success'> ". $success . "</p>";
        }
    }

?>