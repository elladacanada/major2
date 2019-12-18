<?php
require_once($_SERVER["DOCUMENT_ROOT"]. "/conn.php");
// echo "<pre>";
// print_r($_POST);
// print_r($_FILES);
// must be logged in
// role is less than 3
// article is published under the current user
// take us back to te user articles


$errors = [];


if( isset($_SESSION["user_id"]) && ($_SESSION["role"] < 3)):

    $article_id = $_POST["article_id"];

    if(isset($_POST["action"]) && $_POST["action"] == "update"):
        //get the current by session id
        $user_id = $_SESSION["user_id"];
        $title = htmlspecialchars($_POST["title"], ENT_QUOTES);
        $content = htmlspecialchars($_POST["content"], ENT_QUOTES);
        $date_modified = date("Y-m-d H:i:s");

        // print_r($_POST);
        // print_r($_FILES);
        // exit;

        //if profile pic is set and there are no errors
        if( isset($_FILES["featured_image"]) && $_FILES["featured_image"]["error"] == 0){
            if(
                ($_FILES["featured_image"]["type"] == "image/jpeg" ||
                $_FILES["featured_image"]["type"] == "image/jpg"  ||
                $_FILES["featured_image"]["type"] == "image/png"  ||
                $_FILES["featured_image"]["type"] == "image/gif") &&
                $_FILES["featured_image"]["size"] < 2000000 //byte size
            ){
                //File is correct type and size
                //upload to uploads folder

                //check if file already exists
                $file_name = $_SERVER["DOCUMENT_ROOT"] . "/uploads/". $_FILES["featured_image"]["name"];


                // THIS WHOLE SECTION MAKES SURE YOU ARE ABLE TO UPLOAD SAME IMAGE MORE THAN ONCE.  IT CHANGES THE NAMES BY ADDING THE CURRENT DATE INTO IT.
                $file_name = explode(".", $file_name); //explode turns string into array
                $file_extension = strtolower( end($file_name )); //end, gets last element of the array (file extension variable)
                array_pop($file_name); // pop removes last elemnt from the array whioch is the file extension we took off above
                $file_name[] = date("YmdHis"); // adds current datetime into array
                $file_name[] = $file_extension; //  adds the extension back to the end of the array
                $file_name = implode(".", $file_name); //glues array together into a string
                
                // echo "<pre>";
                // print_r($file_name);
                // exit;

                //go to document root
                if( !file_exists($file_name)){
                    
                    //upload to uploads folder we created
                    if(move_uploaded_file($_FILES["featured_image"]["tmp_name"], $file_name)){

                            //Insert  the image into database
                            //replace server info with a ""
                            $insert_image_query = " INSERT INTO images (url, owner_id) 
                                                    VALUES ('" .str_replace($_SERVER["DOCUMENT_ROOT"], "", $file_name). "', $user_id)";
                            
                            if( mysqli_query($conn, $insert_image_query)){
                                $featured_image_id = mysqli_insert_id($conn); // gets id of the last inserted row that you put into the table
                            }

                        }

                } else {
                    $errors[] = "FILE ALready Exists";
                }

            } else { //store error message
                $errors[] = "File error ".$_FILES["profile_pic"]["error"];
            }

        }else {
            $featured_image_id = false;
        }
        
        if($title != "" && $content != ""){
            //title and content are filled, continue
            $query = "  UPDATE articles
                        SET title = '$title',
                        content = '$content',
                        date_modified = '$date_modified'";
            if($featured_image_id)$query .="  , image_id = $featured_image_id";
            $query .="  WHERE id = $article_id";

        if(mysqli_query($conn, $query)){
            //send me to articles.php page of the article id set
            header("Location: http://". $_SERVER["SERVER_NAME"]."/articles.php?id=$article_id");

        } else {
            $errors[] = "Something went wrong: ".mysqli_error($conn);
        }

        } else {
            //title or content are empty
            $errors[] = "Please fill in all fields.";
        }
    elseif(isset($_POST["action"]) && $_POST["action"] == "delete"):
        //Delete the post for the id you are on
        $query = "DELETE FROM articles WHERE id = $article_id";
        if(mysqli_query($conn, $query)) {
            header("Location: http://". $_SERVER["SERVER_NAME"]."/articles.php");
        }else {
            $errors[] = "Something went wrong: " . mysqli_error($conn);
        }
    endif;

else:
    header("Location: http://".$_SERVER["SERVER_NAME"]);
endif;

/////////////////////////
// check for errors array
/////////////////////////
if( !empty($errors) ) {
    $query = http_build_query( array("errors" => $errors) );
    header("Location: " . strtok($_SERVER["HTTP_REFERER"], "?") . "?" .  $query);

}
?>