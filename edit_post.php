<?php
//is user logged in, and do they have rights?
session_start();
if( !isset($_SESSION{"user_id"})){
    header("Location: http://".$_SERVER["SERVER_NAME"] . "/signup.php");
}

require_once("header.php");

if( isset($_GET["article_id"])){ //we are getting article_id from the articles.php page in an echoed a tag
    $article_id = $_GET["article_id"];
    $article_query = " SELECT * FROM articles WHERE id = $article_id";
    if($results = mysqli_query($conn, $article_query) ){
        while($article_row = mysqli_fetch_array($results) ){
            print_r($article_row);
    




    
?>
<div class="container my-5">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php"); ?>
    <form method="post" action="/actions/update_post_action.php" enctype="multipart/form-data">
        <!-- input hidden field puts value into the url to be sent to the next php file -->
        <input type="hidden" name="article_id" value="<?=$article_row["id"]?>"> 
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" value="<?=$article_row["title"]?>" name="title" placeholder="Article Title" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">content</label> //
            <textarea  name="content"   id="content" placeholder="Content" class="form-control" rows="10"><?=$article_row["content"]?></textarea>
        </div>
        <div class="form-group">
            <label for="featured_image">Featured Image</label>
            <input type="file" name="featured_image" placeholder="featured image" class="form-control">
        </div>
        
        <button class="btn btn-text text-danger" name="action" value="delete">Delete</button>
        <button class="btn btn-primary" name="action" value="update">Update</button>

    </form>
</div>



<?php
        }
    }
}
    require_once("footer.php");
?>