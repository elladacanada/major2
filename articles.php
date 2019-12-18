<?php
require_once("header.php");
?>


<div class="container my-5">
    <div class="row">
        <h1> Articles Page</h1>
        
        <?php
        /* ///////////////
        *
        * SINGLE ARTICLE
        *
        ////////////////*/
        if(isset($_GET["id"])){
            $article_query = "  SELECT articles.*, users.first_name, users.last_name, images.url AS featured_image
                                FROM articles 
                                LEFT JOIN users
                                ON articles.author_id = users.id
                                LEFT JOIN images
                                ON articles.image_id = images.id
                                WHERE articles.id = " . $_GET["id"]; 
            if($article_result = mysqli_query($conn, $article_query)){
                while($article_row = mysqli_fetch_array($article_result)){
                    // print_r($article_row);
                ?>
                    <div class="col-12">
                        <h2><?=$article_row["title"]?></h2>
                        <p class="text-muted">Published on <?=date("M jS,Y @ hA", strtotime($article_row["date_created"]))?> by <?=$article_row["last_name"]?></p>
                    </div>
                    <div class="col-4">
                    <figure>
                        <img src="<?=$article_row["featured_image"];?>" alt="" class="w-100">
                    </figure>
                    </div>
                    
                    <div class="col-8">

                        <?php
                            echo $article_row["content"]
                        ?>
                    </div>
                <?php
                //if logged in and the post is yours or you are the super admin
                //show edit menu
                if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $article_row["author_id"]){
                    
                    echo "<hr>";
                    echo "<div class='col-12'>";
                        echo "<a href='edit_post.php?article_id=".$article_row["id"]."' class='btn btn-primary' >Edit Article</a>";
                    echo "</div>";
                }
                }
            } else {
                echo mysqli_error($conn);
            }
        } else {

        /* ///////////////
        *
        * ALL ARTICLES
        *
        ////////////////*/

            //ELSE if no id set, show all articles
            // if query includes search
            $search_query = (isset($_GET["search"])) ? $_GET["search"] : false;

            
            if($search_query) {
                echo "<div class='col-12'><h2>Search Results For: $search_query</h2></div>";
            } else {
                echo "<div class='col-12'><h2>Articles</h2></div>";
            }
            
            //output all articles
            $article_query = "  SELECT articles.title, articles.author_id, articles.id, articles.views, articles.date_created, users.first_name, users.last_name, images.url AS featured_image
                                FROM articles 
                                LEFT JOIN users
                                ON articles.author_id = users.id
                                LEFT JOIN images
                                ON articles.image_id = images.id";
                                // must have space before " where" so when it concatinaates they is no connection to the id before.
            
            $articles_where_search = "";
            if($search_query){
                $articles_where_search =  " WHERE articles.title LIKE '%$search_query%' 
                                OR articles.content LIKE '%$search_query%'";
                $article_query .= $articles_where_search;
            }
            
            $current_page = (isset($_GET["page"])) ? $_GET["page"] : 1;
            $limit = 5;
            $offset = $limit * ($current_page-1);

            $article_query .=  " ORDER BY articles.date_created DESC
                                LIMIT $limit OFFSET $offset";
                               
            if($article_result = mysqli_query($conn, $article_query)){

                $pagi_query = "SELECT COUNT(*) AS total FROM articles";
                if($search_query){
                    $pagi_query .= $articles_where_search;
                }
                $pagi_result = mysqli_query($conn, $pagi_query);
                $pagi_row = mysqli_fetch_array($pagi_result);
                $total_articles = $pagi_row["total"];
                //floor will round down
                //ceil will round up
                //round will round down below 5 or up otherwise.
                $page_count = ceil($total_articles / $limit);

                echo "<nav aria-label='Page navigation example'><ul class='pagination'>";

                $get_search = ($search_query) ? "&search=".$search_query : "";

                if($current_page > 1){
                    echo "<li class='page-item'><a class='page-link' href='/articles.php?page=" . ($current_page - 1) . "$get_search'>Previous</a></li>";    
                }
                
                for($i = 1; $i <= $page_count; $i++){
                    echo "<li class='page-item";
                    if($current_page == $i) echo " active";
                    echo "'><a class='page-link' href='/articles.php?page=$i".$get_search."'>$i</a></li>";
                }
                if($current_page < $page_count){
                    echo "<li class='page-item'><a class='page-link' href='/articles.php?page=" . ($current_page + 1) . "$get_search'>Next</a></li>";
                }
                echo "</ul></nav>";
                

                while($article_row = mysqli_fetch_array($article_result)){

                    $update_views_query = "UPDATE articles SET views = ".($article_row["views"]+= 1)." WHERE id = ". $article_row["id"];

                    mysqli_query($conn, $update_views_query);
                    ?>
                        <div class="card col-md-12 mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="card-img" src="<?=$article_row["featured_image"];?>" alt="">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        
                                            <h5 class="card-title">
                                                <a href="/articles.php?id=<?=$article_row["id"]?>"><?=$article_row["title"];?></a>
                                            </h5>
                                            <small class="text-muted"><?="By " . $article_row["first_name"] . " " . $article_row["last_name"] . " on " . date("M jS,Y @ hA", strtotime($article_row["date_created"]));?></small>
                                            <p>
                                                <?php echo "views: " . $article_row["views"]; ?>
                                            </p>
                                            <p>
                                                <a href="/articles.php?id=<?=$article_row["id"]?>">Read More</a>
                                            </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    

                }      
            } else {
            echo mysqli_error($conn);
            }
        ?>
        <?php
        }
        ?>

    </div>
</div>
<?php
require_once("footer.php");
?>