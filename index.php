<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物件導向</title>
</head>
<body>
    <h1>物件宣告</h1>
    <?php
        interface Behavior
        {
            public function run();
            public function speed();
            public function jump();
        }


        class Animal
        {
            public $type='animal';
            public $name='john';
            public $hair_color='brown';

            function __construct($type, $name, $hair_color)
            {
                $this->type = $type;
                $this->name = $name;
                $this->hair_color = $hair_color;
            }

            function runParentRun()
            {
                $this->run();
            }
            function run(){
                echo "parent::".$this->name." is running";
            }

            function speed()
            {
                echo "parent::".$this->name." is running at 20km/h";
            }
        }

        class Cat extends Animal implements Behavior
        {
            public $type="cat";

            function __construct($name, $hair_color)
            {
                $this->name = $name;
                $this->hair_color = $hair_color;
            }
            function runParentSpeed()
            {
                parent::speed();
            }

            function run()
            {
                echo  $this->name." cat is running";
            }

            function speed()
            {
                echo  $this->name." cat is running at 20km/h";
            }

            function jump()
            {
                echo  $this->name." cat is JUMP";
            }
        }

        class Dog extends Animal implements Behavior
        {
            function __construct($name, $hair_color)
            {
                parent::__construct("Dog", $name, $hair_color);
            }

            function runParentSpeed()
            {
                parent::speed();
            }
            function run()
            {
                echo  $this->name." Dog is running";
            }

            function speed()
            {
                echo  $this->name." Dog is running at 100km/h";
            }

            function jump()
            {
                echo  $this->name."Dog is JUMP";
            }
        }

        //實例化(instance)
        //$cat = new Animal("cat", "Kitty", "white");
        $cat = new Cat("Kitty", "white");
        $dog = new Dog("DDog", "black");
        $animals=[];
        $animals[] = $cat;
        $animals[] = $dog;
        foreach($animals as $anim)
        {
            echo $anim->runParentRun()."<br>";
            echo $anim->runParentSpeed()."<br>";

            echo $anim->type."<br>";
            echo $anim->name."<br>";
            echo $anim->hair_color."<br>";
            echo $anim->run()."<br>";
            echo $anim->jump()."<br>";
            echo $anim->speed()."<br><br><br><br>";
        }
    ?>

    <h1>介面</h1>
    <?php
        interface BehaviorA
        {
            const type="baseSh";
            public function runMy();
            public function speedMy();
        }

        class myD1 implements BehaviorA
        {
            public $s=0;
            public $n;

            public function __construct($n1, $s)
            {
                $this->s = $s;
                $this->n = $n1;
            }

            public function runMy()
            {
                echo "myD1 runMy ".$this->n;
            }

            public function speedMy()
            {
                echo "MyD1 speedMy ".$this->s;
            }
        }

        class myDA_A implements BehaviorA
        {
            public $s=0;
            public $n;

            public function __construct($n1, $s)
            {
                $this->s = $s;
                $this->n = $n1;
            }

            public function runMy()
            {
                echo "myDA_A runMy ".$this->n;
            }

            public function speedMy()
            {
                echo "myDA_A speedMy ".$this->s;
            }
        }

        $a = new myD1("JOJO", 123);
        $b= new myDA_A("MOMO", 456);

        $test = [];
        $test[] = $a;
        $test[] = $b;
        foreach($test as $t)
        {
            $t->runMy();
            echo "<br>";
            $t->speedMy();
            echo "<br>";
            echo "<br>";
            echo "<br>";
        }
    ?>


    <?php

        $count = 0;
        class ABC 
        {
            static $count=0;

            public static function addcount()
            {
                return self::$count = self::$count + 1;
            }
        }

        echo ABC::addcount();
        echo ABC::$count;
        echo $count;
    ?>
</body>
</html>