<?php
require_once("header.php");
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
        <h1>SSP Drill 3</h1>
        <p>Make a loop that for every 3rd interval echoes Ping, and for every 7th interval echoes Pong. <br>
        If the Interval is divisible by 3 & 7, echo PingPong.</p>
        </div>
    </div>

    <hr>

    <div style="columns:4;">

        <?php
        for ($x = 1; $x <= 100; $x++) {
                echo $x;
            if($x % 3 == 0  && $x % 7 == 0){
                
                echo ": PingPong";

            }elseif($x % 3 == 0){
                echo ": Ping";
            }elseif ($x % 7 == 0){
                echo ": Pong";
            }

            echo "<br>";
        }
        ?>

    </div>
    
    <!-- billies way which was good until having to add color-->
    <div class="my-5" style="columns:4;">

        <?php
        for ($x = 1; $x <= 100; $x++) {
                $color = 0;
                $output = $x . ":";

            if($x % 3 == 0){
                $color += 1;
                $output .= " Ping";
            }
            if ($x % 7 == 0){
                $color += 2;
                $output .= " Pong";
            }

            $output .= "<br>";

            $append = "";
            switch($color){
                case 1:
                    $append = "<span class='text-danger'>";
                break;
                case 2:
                    $append = "<span class='text-warning'>";
                break;
                case 3:
                    $append = "<span class='text-success'>";
                break;
                default:
                
                $append = "<span>";
                break;
            }

            echo $append . $output . "</span>";
        }
        ?>

        

    </div>
    <hr>

    
        <!-- PHP foreach loop -->
        <?php
            $cars = ["Ford", "Toyota", "Tesla", "Audi"];

            // can create plural array and echo each out as a single or any other name you wish
            foreach( $cars as $car){
                echo $car ."<br>";

                switch ($car){
                    case "Ford":
                        echo "Acc: 0-60 8s";
                    break;
                    case "Tesla":
                        echo "Acc: 0-60 1.4s";
                    break;
                    case "Audi":
                        echo "Acc: 0-60 4.2s";
                    break;
                    default:
                        echo "unknown";
                    break;

                }
                echo "<hr>";
            }
        ?>

</div>






<?php
require_once("footer.php");
?>