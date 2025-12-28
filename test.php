
<?php
// class fruit {
//     public $name;
//     public $color;
//     function set($name){
//         $this->name = $name;
//     }
//     function get(){
//         return $this->name ;
//     }
//     function set_c($color){
//         $this->color = $color;
//     }
//     function get_c(){
//         return $this->color;
//     }
// }
// $btata = new fruit();
// $yellow = new fruit();
// $btata->set('batata');
// $yellow->set_c('yellow');
// echo $yellow->color;
// echo $btata->get();
// echo "<br>";
// echo "\n";
// echo '\n';
// echo "name = " . $btata->name;
// var_dump($yellow instanceof fruit)
?>

<?php
class Test
{
    private $pdo;

    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function run()
    {
        $this->pdo->query("SELECT * FROM clients");
    }
}
class Testo
{
    private PDO $pdo;

    public function setPdo(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function run()
    {
        $this->pdo->query("SELECT * FROM clients");
    }
}
$test = new Test();
$test->setPdo("bonjour");

class User {
    public function sayHi() {
        echo "Hi";
    }
}
$user = new User();
$user->sayHi();
$note =  "okok";
function  bin(){
    global $note;
    echo $note;
}
bin();
class Fruit {
    public $name;
    public $color;

    function __construct($name, $color){
        $this->name  = $name;
        $this->color = $color;
    }

    function get(){
        return $this->name;
    }

    function get_c(){
        return $this->color;
    }
}

$btata  = new Fruit('batata', 'brown');
$yellow = new Fruit('apple', 'red');

echo $yellow->get_c();
echo PHP_EOL;
echo $btata->get();
echo PHP_EOL;
echo "name = " . $btata->get();
echo PHP_EOL;

var_dump($yellow instanceof Fruit);
