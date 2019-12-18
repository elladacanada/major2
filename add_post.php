<?php
//is user logged in, and do they have rights?
    session_start();
    if( !isset($_SESSION{"user_id"})){
        header("Location: http://".$_SERVER["SERVER_NAME"] . "/signup.php");
    }
    require_once("header.php");

    
?>
<div class="container my-5">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php"); ?>
    <form method="post" action="/actions/add_post_action.php" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Article Title" class="form-control">
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea  name="content"  id="content" placeholder="Content" class="form-control" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="featured_image">Featured Image</label>
            <input type="file" name="featured_image" placeholder="featured image" class="form-control">
        </div>
        <button class="btn btn-primary" name="action" value="publish">Publish</button>

    </form>
</div>













<?php
    require_once("footer.php");
?>