<?php 
class Ojek_online {
    private $nama;
    private $nomor_kendaraan;
    private $jenis_kendaraan;
    protected $saldo;
    
    public function __construct($nama, $plat_no, $jenis_kendaraan){
        $this->nama = $nama;
        $this->nomor_kendaraan = $plat_no;
        $this->jenis_kendaraan = $jenis_kendaraan;
        $this->saldo = 0;
    }

    public function antar_penumpang($tarif){
        $this->saldo += $tarif; 
    }

    public function get_saldo(){
        return $this->saldo;
    }
}

class Ride extends Ojek_online{
    private $food;

    public function __construct($nama, $plat_no, $jenis_kendaraan, $food){
        parent::__construct($nama, $plat_no, $jenis_kendaraan);
        $this->food = $food;
    }

    public function antar_food($tarif){
        if ($this->food) {
            $this->antar_penumpang($tarif);
        } else {
            echo "Tidak antar makanan<br>";
        }
    }
}

class Car extends Ojek_online{
    private $barang;
    private $max_kapasitas_barang;
    
    public function __construct($nama, $plat_no, $jenis_kendaraan, $barang, $max_kap){
        parent::__construct($nama, $plat_no, $jenis_kendaraan);
        $this->barang = $barang;
        $this->max_kapasitas_barang = $max_kap;
    }

    public function antar_barang($tarif, $berat_barang){
        if ($this->barang) {
            if ($berat_barang <= $this->max_kapasitas_barang) {
                $this->antar_penumpang($tarif);
            } else {
                echo "Melebihi batas maksimal berat : " . $this->max_kapasitas_barang . "<br>";
            }
        } else {
            echo "Tidak antar barang<br>";
        }
    }
}
echo "Nomor 1 <br>";
//alan
$nama = "Alan";
echo "Tindakan Yang Dilakukan $nama <br>";
$alan = new Ride($nama, "L 1234 AB", false, true);
$alan->antar_penumpang(50000);
$alan->antar_penumpang(20000);
$alan->antar_penumpang(25000);
$alan->antar_food(10000);
$alan->antar_food(21000);
$alan->antar_food(17000);
//saldo alan
echo "Saldo Alan = Rp.".$alan->get_saldo()."<br> <br>";

//boni
$nama = "Boni";
echo "Tindakan Yang Dilakukan $nama <br>";
$boni = new Ride($nama, "L 2233 XJ", false, false);
$boni->antar_penumpang(24000);
$boni->antar_penumpang(23000);
$boni->antar_penumpang(57000);
$boni->antar_food(11000);
$boni->antar_food(60000);
//saldo boni
echo "Saldo Boni = Rp.".$boni->get_saldo()."<br> <br>";

//dato
$nama = "Dato";
echo "Tindakan Yang Dilakukan $nama <br>";
$dato = new Car($nama, "L 5432 SD", true, true, 180);
$dato->antar_penumpang(54000);
$dato->antar_penumpang(33000);
$dato->antar_penumpang(87000);
$dato->antar_barang(120000, 100);
$dato->antar_barang(300000, 200);
$dato->antar_barang(100000, 170);
//saldo dato
echo "Saldo Dato = Rp.".$dato->get_saldo()."<br><br>";

//Nomor 2
abstract class Mobil{
    protected $kapasitas_bbm;
    protected $konsumsi_km_perliter;
    protected $nama;
    protected $jarak_tempuh;
    protected $isi_tangki;

    public function __construct($kap_bbm, $kons_bbm, $nama){
        $this->kapasitas_bbm = $kap_bbm;
        $this->konsumsi_km_perliter = $kons_bbm;
        $this->nama = $nama;
    }

    public function jalan($kecepatan, $waktu){
        $this->jarak_tempuh = $kecepatan * $waktu;
        $konsumsi_bbm = $this->konsumsi_km_perliter;
        $this->isi_tangki -= ($this->jarak_tempuh / $konsumsi_bbm);
        
        return $this->jarak_tempuh;
    }

    abstract public function get_nama();
    abstract public function get_isitangki();
    abstract public function get_jaraktempuh();
}

class Hybrid extends Mobil implements Pom_bensin{
    private $booster;
    private $switch_booster;

    public function __construct($kap_bbm, $kons_bbm, $nama, $booster, $sw_boost){
        parent::__construct($kap_bbm, $kons_bbm, $nama);
        $this->booster = $booster;
        $this->switch_booster = $sw_boost;
    }

    public function get_nama(){
        return $this->nama;
    }

    public function get_isitangki(){
        return $this->isi_tangki;
    }

    public function get_jaraktempuh(){
        return $this->jarak_tempuh;
    }

    public function jalan($kecepatan, $waktu){
        $konsumsi_bbm = $this->konsumsi_km_perliter;
        if ($this->switch_booster) {
            $konsumsi_bbm = $konsumsi_bbm - ($konsumsi_bbm * $this->booster / 100);
        }

        $this->jarak_tempuh = $kecepatan * $waktu;

        $this->isi_tangki -= ($this->jarak_tempuh / $konsumsi_bbm);
        
        return $this->jarak_tempuh;
    }

    public function on_off_booster($switch){
        $this->switch_booster = $switch;
    }

    public function isibbm(){
        $this->isi_tangki = $this->kapasitas_bbm;
    }
}

interface Pom_bensin{
    public function isibbm();
}

echo "Nomer 2 <br>";
$xcar = new Hybrid(50, 8, "Xcar", 30, false);
$xcar->isibbm(50);
$jarak_tempuh_tanpa_booster = $xcar->jalan(100, 4.5);
echo "Jarak yang ditempuh tanpa menggunakan booster: " . $jarak_tempuh_tanpa_booster . " km<br>";
echo "Sisa isi bbm di tangki Xcar setelah perjalanan tanpa menggunakan booster: " . $xcar->get_isitangki() . " liter<br>";

$xcar->isibbm(50);
$xcar->on_off_booster(true); 
$jarak_tempuh_dengan_booster = $xcar->jalan(100, 4.5);
echo "Jarak yang ditempuh dengan menggunakan booster: " . $jarak_tempuh_dengan_booster . " km<br>";
echo "Sisa isi bbm di tangki Xcar setelah perjalanan dengan menggunakan booster: " . $xcar->get_isitangki() . " liter<br>";


?>
