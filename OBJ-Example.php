<?php
require_once("header.php");
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12"><h1>SSP Object Oriented programming</h1></div>
        <div class="col-md-12">
            <?php
            class Person {
                public $first_name = ""; //with quotes this must be a string later
                public $last_name = "";
                public $hair; //without quotes can be a string or an integer later
                public $birthdate;

                public function getAge(){
                    $date = new DateTime($this->birthdate);
                    $now = new DateTime();
                    $age = $now->diff($date);
                    return $age->y;
                }
            }

            $person1 = new Person();
            $person1 -> first_name = "Taylor";
            $person1 -> last_name = "Field";
            $person1 -> hair = "Dirty blonde";
            $person1 -> birthdate = "1994-11-26";

            print_r($person1);

            echo $person1->getAge();

            echo "<hr>";

            $person2 = new Person();
            $person2 -> first_name = "Bill";
            $person2 -> last_name = "Bob";
            $person2 -> hair = "Green";
            $person2 -> birthdate = "1904-01-02";
            echo $person2->first_name . " is " . $person2->getAge();



            ?>
        </div>
    </div>
</div>






<?php
require_once("footer.php");
?>