<?php 

class GameCharacter{
    private $name;
    private $lifePoint;
    private $attackHitPoint;
    private $attackKickPoint;

    public function set_name($name){
        $this->name = $name;
    }
    public function set_lifePoint($lp){
        $this->lifePoint = $lp;
    }
    public function set_attack($hp, $kp){
        $this->attackHitPoint = $hp;
        $this->attackKickPoint = $kp;
    }
    public function get_lifePoint(){
        return $this->lifePoint;
    }
    public function get_attackKickPoint(){
        return $this->attackKickPoint;
    }
    public function get_name(){
        return $this->name;
    }
    public function hit($karB){
        $karB->lifePoint -= $this->attackHitPoint;
    }
    public function kick($karB){
        $karB->lifePoint -= $this->attackKickPoint;
    }
    

}

$goku = new GameCharacter();
$goku->set_name("Goku");
$goku->set_lifePoint(110);
$goku->set_attack(20, 30);

$subzero = new GameCharacter();
$subzero->set_name("Subzero");
$subzero->set_lifePoint(100);
$subzero->set_attack(25, 35);

for ($i = 1; $i <= 2; $i++) {
    $goku->kick($subzero);
}

for ($i = 1; $i <= 3; $i++) {
    $subzero->hit($goku);
}

for ($i = 1; $i <= 2; $i++) {
    $goku->hit($subzero);
}
echo "Latihan 1"."<br>";
echo "LifePoint Goku: " . $goku->get_lifePoint() ."<br>";
echo "LifePoint Subzero: " . $subzero->get_lifePoint() . "<br>". "<br>". "<br>";

class pecahan{
    private $penyebut;
    private $pembilang;

    public function set_pembilang($nilai){
        $this->pembilang = $nilai;
    }
    public function set_penyebut($nilai){
        $this->penyebut = $nilai;
    }
    public function get_pembilang(){
        return $this->pembilang;
    }
    public function get_penyebut(){
        return $this->penyebut;
    }
    public function tambah($pecahan){
        $hasil = new Pecahan();
        $hasil->set_pembilang(($this->pembilang * $pecahan->get_penyebut()) + ($pecahan->get_pembilang() * $this->penyebut));
        $hasil->set_penyebut($this->penyebut * $pecahan->get_penyebut());

        return $hasil;
    }

}
    $obj1 = new pecahan();
    $obj1->set_pembilang(3);
    $obj1 ->set_penyebut(2);
    
    $obj2 = new pecahan();
    $obj2->set_pembilang(5);
    $obj2->set_penyebut(6);

    $hasiltambah = $obj1->tambah($obj2);
    
    echo "Latihan 2"."<br>";
    echo "Hasil Tambah: " . $hasiltambah->get_pembilang() . "/" . $hasiltambah->get_penyebut();
?>