<?php
require_once("header.php");

$errors = [];
$success = [];    

$tag = htmlspecialchars($_POST["add_tag"], ENT_QUOTES);


if( isset($_REQUEST["action"]) && $_REQUEST["action"] == "add_article_tag"){
    // need tag_id and article_id
    $tag_id = $_REQUEST["tag_id"];
    $article_id = $_REQUEST["article_id"];
    $add_article_tag_query = "INSERT INTO articles_tags (tag_id, article_id) VALUES ($tag_id, $article_id)";
   if (mysqli_query($conn, $add_article_tag_query)){

   }
}

if( isset($_POST["action"]) && $_POST["action"] == "add_tag"){
                
    $add_tag_query ="   INSERT INTO tags (tag)
                        VALUES ('$tag')";
    
    if(mysqli_query($conn, $add_tag_query)){
        echo "success";
    }
        
 }

?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
        <h1>SSP Drill 4</h1>
        <p>Make a new table in your database called "tags" with a column for "id" and "tag". <br>
        You should be able to add new tags to your tables. <br>
        Bonus: ability to edit and remove existing tags.</p>
        <p>Make a new table in your database to create a many to many relationship between your articles and tags, can be called "article_tags". <br>
        Loop all your existing articles and include a form in each with a dropdown of all existing tags. <br>
        Form should add the tag to the many to many table, relating the tag to the article. <br>
        Output all tags related to the article. <br>
        Bonus: Ability to remove the tag from the article.</p>
        </div>
    </div>

    <hr>

    <div class="row">

        <?php
            include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
        ?>

        <div class="col-md-8 card p-3">
            <?php

            $articles_query =" SELECT * FROM articles";

            if($articles_result = mysqli_query($conn, $articles_query)){
                while($article_row = mysqli_fetch_array($articles_result)){
                    echo "<h4>".$article_row["title"]."</h4>";

                    echo "<p><strong>Tags: </strong>";
                        $article_tag_query = "  SELECT articles_tags.*, tags.tag
                                                FROM articles_tags
                                                LEFT JOIN tags
                                                ON articles_tags.tag_id = tags.id
                                                WHERE articles_tags.article_id = " .$article_row["id"];

                    if($article_tag_result = mysqli_query($conn, $article_tag_query)){
                        $comma = "";
                        while($article_tag_row = mysqli_fetch_array($article_tag_result)){
                            echo  $comma . $article_tag_row["tag"];
                            $comma = ", ";
                        }
                    }
                    echo "</p>";

                    ?>
                    <form action="drill4.php" class="input-group">
                        <input type="hidden" name="article_id" value="<?=$article_row["id"]?>">
                        <select name="tag_id" class="form-control">
                            <?php
                            $show_tag_query =" SELECT * FROM tags";
                            if($tag_result = mysqli_query($conn, $show_tag_query)){
                            
                                while($tag_row = mysqli_fetch_array($tag_result)){
                                    echo "<option value='".$tag_row["id"]."'>".$tag_row["tag"]."</option>";
                                }
                                
                            }
                            ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" name="action" value="add_article_tag" class="btn btn-dark text-warning">Add Tag</button>
                        </div>
                    </form>
                    <?php

                    echo "<hr>";
                    
                    
                } // end of $article_row while
            } // end of $articles_result if
            
            ?>
        </div>


        <!-- ADD TAG SECTION -->
        <!-- ADD TAG SECTION -->
        <!-- ADD TAG SECTION -->
        <!-- ADD TAG SECTION -->

        <div class="col-md-4 card p-3">
            <h3>Tags</h3>
            <?php
                
                $show_tag_query =" SELECT * FROM tags";

                if($tag_result = mysqli_query($conn, $show_tag_query)){
                    echo "<ul>";
                    while($tag_row = mysqli_fetch_array($tag_result)){
                        echo "<li>";
                        echo $tag_row["tag"];
                        echo "</li>";
                    }
                    echo "</ul>";
                }

            ?>
            <hr>

            <form method="post" action="/drill4.php" class="form-inline my-2 my-lg-0 ml-auto ">
                <div class="input-group">
                    <input class="form-control bg-transparent" type="text" name="add_tag" placeholder="Add Tag" >
                    <div class="input-group-append">
                        <button class=" btn btn-dark text-warning my-2 my-sm-0" name="action" value="add_tag" >Add Tag</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>




<?php
require_once("footer.php");
?>