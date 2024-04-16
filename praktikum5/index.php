<?php
class Calculator{
    const PHI = 3.14;

    public static function perkalian($var){
        $jumlah = 1;
        foreach($var as $var){
            $jumlah *= $var;
        }
        echo $jumlah."<br>";
    }

    public static function penjumlahan($var){
        $jumlah = 0;
        foreach($var as $var){
            $jumlah += $var;
        }
        echo $jumlah."<br>";
    }

    public static function pengurangan($varA, $varB){
        $varA -= $varB;
        echo $varA."<br>";
    }

    public static function pembagian($varA, $varB){
        $varA /= $varB;
        echo $varA."<br>";
    }

    public static function pangkatN($bilangan, $pangkat){
       echo $bilangan ** $pangkat."<br>";
    }

    public static function luasLingkaran($diameter){
        $r = $diameter / 2;
        $luas = Calculator::PHI * $r ** 2;

        echo $luas."<br>";
    }

    public static function volumeBola($diameter){
        $r = $diameter / 2;
        $volume = (4/3) * Calculator::PHI * $r ** 3;
        echo $volume."<br>"."<br>";
    }

}

echo "Nomor 1 <br>";
$bil1 = 10;
$bil2 = 2;
echo "Perkalian dari $bil1 dan $bil2 = ";
Calculator::perkalian(array($bil1, $bil2));
echo "Penjumlahan $bil1 dan $bil2 = ";
Calculator::penjumlahan(array($bil1, $bil2));
echo "Pengurangan $bil1 dan $bil2 = ";
Calculator::pengurangan($bil1, $bil2);
echo "Pembagian dari $bil1 dan $bil2 = ";
Calculator::pembagian($bil1, $bil2);
echo "$bil1 dan $bil2 = ";
Calculator::pangkatN($bil1, $bil2);
$diameterInput = 20;
echo "Luas Lingkaran dengan Diameter $diameterInput = ";
Calculator::luasLingkaran($diameterInput);
$diameterInput2 = 20;
echo "Volume Bola dengan Diameter $diameterInput2 = ";
Calculator::volumeBola($diameterInput2);

class GameCharacter{
    private $name;
    private $lifePoint;
    private $attackHitPoint;
    private $attackKickPoint;

    function __construct($name, $lp, $hp, $kp){
        $this->name = $name;
        $this->lifePoint = $lp;
        $this->attackHitPoint = $hp;
        $this->attackKickPoint = $kp;
    }
    public function get_lifePoint(){
        return $this->lifePoint;
    }
    public function get_attackKickPoint(){
        return $this->attackKickPoint;
    }
    public function get_attackHitPoint(){
        return $this->attackHitPoint;
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

    function __destruct(){
        echo "Karakter ".$this->name." memiliki LifePoint ".$this->get_lifePoint()."<br>";
    }
    

}

$goku = new GameCharacter("Goku", 110, 20, 30);
$subzero = new GameCharacter("Subzero", 100, 25, 35);

for ($i = 1; $i <= 2; $i++) {
    $goku->kick($subzero);
}

for ($i = 1; $i <= 3; $i++) {
    $subzero->hit($goku);
}

for ($i = 1; $i <= 2; $i++) {
    $goku->hit($subzero);
}
echo "Nomor 2 <br>";

unset($goku);
unset($subzero);
echo "<br>";

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
    public function tambah($pec1, $pec2){
        $hasil = new Pecahan();
        $hasil->set_pembilang(($pec1->get_pembilang() * $pec2->get_penyebut()) + ($pec2->get_pembilang() * $pec1->get_penyebut()));
        $hasil->set_penyebut($pec1->get_penyebut() * $pec2->get_penyebut());

        return $hasil;
    }

}
    $obj1 = new pecahan();
    $pembilang = 3;
    $penyebut = 2; 
    $obj1->set_pembilang($pembilang);
    $obj1 ->set_penyebut($penyebut);
    
    $obj2 = new pecahan();
    $pembilang1 = 5;
    $penyebut1 = 6;
    $obj2->set_pembilang($pembilang1);
    $obj2->set_penyebut($penyebut1);

    $hasilTambah = $obj1->tambah($obj1, $obj2);

    echo "Nomor 3 <br>";
    echo "Hasil dari $pembilang/$penyebut + $pembilang1/$penyebut1 = " . $hasilTambah->get_pembilang() . "/" . $hasilTambah->get_penyebut()."<br>"."<br>";

    echo "Nomer 4 <br>";
    include("mobil_pickup.php");
    
    $carry = new Mobil_pickup();
$carry->set_jenis_bbm("bensin");
$carry->set_kapasitas_bbm(45);
$carry->set_jarak_tempuh(3300);
$carry->isi_bbm(10);

$grandMax = new Mobil_pickup();
$grandMax->set_jenis_bbm("solar");
$grandMax->set_kapasitas_bbm(50);
$grandMax->set_jarak_tempuh(3000);
$grandMax->isi_bbm(15);

echo "Sisa BBM Carry setelah sampai tujuan: " . Perjalanan::sisaBbmDitujuan($carry) . " liter <br>";
echo "Sisa BBM Grand Max setelah sampai tujuan: " . Perjalanan::sisaBbmDitujuan($grandMax) . " liter\n";
?>

