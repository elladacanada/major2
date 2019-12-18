<?php
require_once("header.php");


                        
                        
$errors = [];
$success = [];                

if(isset ($_POST["action"]) && $_POST["action"] == "add_product"){
    $new_product = htmlspecialchars($_POST["add_product"], ENT_QUOTES);
    
    if ($new_product !== "") {
    
    $insert_product_query = " INSERT INTO shopping_list (product) VALUES ('$new_product')";

        if( mysqli_query($conn, $insert_product_query)){
            $success[] = "You've added an item";
        }

    } else {
    $errors[] = "field is empty";
    //   echo "error";
    }
          
} elseif(isset ($_GET["action"]) && $_GET["action"] == "delete"){ //this is a $_GET action because in our echoed li line below, we used an a tag with an href to put the action in the url.
    $product_id = $_GET["id"];
    $delete_query = "DELETE FROM shopping_list WHERE id = $product_id";

    if(mysqli_query($conn, $delete_query));

} elseif(isset($_POST["action"]) && $_POST["action"] == "edit_product"){ //this edit product action was set in a variable at the bottom of this doc in the edit results if statment
    print_r($_POST);
    $product_id = $_POST["product_id"];
    $updated_product = $_POST["edit_product"];

    $update_query = " UPDATE shopping_list
                        SET product = '$updated_product'
                        WHERE id = $product_id";

    mysqli_query($conn, $update_query);

}
?>



<div class="container my-5">
            <?php
            include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>
    <div class="row">
        <div class="col-md-12">
            <h1>SSP Drill 2</h1>
            <h4>Add products to a shopping list.</h4>
        </div>
        <div class="col-md-12">
            
            
            <?php
            $product_query = " SELECT * FROM shopping_list";

            if($product_result = mysqli_query($conn, $product_query)):
                echo "<ul>";
                while($product_row = mysqli_fetch_array($product_result)):
                    echo "<li>". $product_row["product"] . " 
                    <a class='text-danger' href='?action=delete&id=". $product_row["id"] . "'>delete</a>
                    <a class='text-success' href='?action=edit&id=". $product_row["id"] . "'>edit</a>
                    </li>";
                endwhile;
                echo "</ul>";
            else:
                echo mysqli_error($conn);
            endif;
            ?>
            


            <form action="/drill2.php" method="post">
                <div class="input-group">
                    <?php
                    //if action is edit
                    //select the item from database
                    //fill input field with item text
                    //if action is not set, leave field blank
                    $product_value = ""; //this global variable passes an empty value to this variable name so in our input field the value appears empty unless the if statemnt below is run, in which case item value ends up being the $_get id of the product we select to edit.
                    $button_value = "add_product";
                    $button_text = "Add Product";
                    $input_name = "add_product";

                    if(isset($_GET["action"]) && $_GET["action"] == "edit"){
                        $product_id = $_GET["id"]; //here we select the id of the item we click to edit because above in the a tag we set an href of action=edit&id=
                        
                        ?>
                            <input type="hidden" name="product_id" value="<?=$product_id?>">
                        <?php

                        $edit_query = "SELECT * FROM shopping_list WHERE id = $product_id";

                       if( $edit_results = mysqli_query($conn, $edit_query)){
                            $button_value = "edit_product";
                            $button_text = "Edit Product";
                            $input_name = "edit_product";

                           while($product_row = mysqli_fetch_array($edit_results)){
                               $product_value = $product_row["product"];
                            }
                        }
                    }
                    ?>
                    <input class="form-control" type="text" placeholder="Add Product" name="<?=$input_name?>" value="<?=$product_value?>">
                    <div class="input-group-append" >
                        <button name="action" class=" btn btn-primary text-white my-2 my-sm-0" type="submit" value="<?=$button_value?>"><?=$button_text?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>














<?php

require_once("footer.php");
?>