<?php 
class Tabungan {
    private $nama_pemilik;
    private $bank;
    private $prioritas;
    private $saldo;

    public function __construct($nama, $bank, $prio, $saldo){
        $this->nama_pemilik = $nama;
        if ($bank === 'BCL' || $bank === 'MANDALA') {
            $this->bank = $bank;
        } else {
            echo "Bank yang diberikan tidak valid.";
        }
        $this->prioritas = $prio;
        $this->saldo = $saldo;
    }
    public function jenis_kartu(){
        return 0;
    }
    public function get_nama_pemilik(){
        return $this->nama_pemilik;
    }
    public function get_bank(){
        return $this->bank;
    }
    public function get_prioritas(){
        return $this->prioritas;
    }
    public function set_saldo($saldo){
        $this->saldo = $saldo;
    }
    public function get_saldo(){
        return $this->saldo;
    }
}

class Kartu_ATM extends Tabungan implements Pembayaran{
    public function tarik_tunai($juml, $biaya){
        if ($this->saldo >= $juml){
            $this->saldo -= ($juml + $biaya);
        }else {
            echo "Saldo Tidak Cukup";
        }
    }
    public function jenis_kartu(){
        return 1;
    }
    public function pembayaran($juml, $biaya){
        if ($this->saldo >= $juml){
            $this->saldo -= ($juml + $biaya);
        }else {
            echo "Saldo Tidak Cukup";
        }
    }
}

class Kartu_kredit extends Tabungan implements Pembayaran{
    private $batas_kredit;
    private $juml_pinjaman;

    public function __construct($tabungan, $batas_kredit){
        //$tabungan = new Tabungan();
        $this->batas_kredit = $batas_kredit;
        $this->juml_pinjaman = 0;
    }
    public function jenis_kartu(){
        return 2;
    }
    public function set_saldo($saldo){
        //$this->saldo = $saldo;
    }
    public function get_juml_pinjaman(){
        return $this->juml_pinjaman;
    }
    public function get_batas_kredit(){
        return $this->batas_kredit;
    }
    public function pembayaran($juml, $biaya){
        //(jumlah pinjaman ) + juml dibayar(juml +biaya) <= batas kredit
        //biayarp = juml * biaya/100
        $biayarp = $juml * $biaya / 100;
        if($juml_pinjaman + ($juml + $biayarp) <= $batas_kredit){
            $this->juml_pinjaman += ($juml + $biayarp);
        }else{
            echo "Jumlah Kredit tidak Cukup";
        }
    }
}

interface Pembayaran{
    public function pembayaran($juml, $biaya);
    
}

class Mesin_ATM{
    private $bank;

    public function __construct($bank){
        if ($bank === 'BCL' || $bank === 'MANDALA') {
            $this->bank = $bank;
        } else {
            echo "Bank yang diberikan tidak valid.";
        }
    }
    public function tarik_tunai($atm, $juml){
        if ($atm instanceof Kartu_ATM) {
            if($atm->get_bank() === $this->bank){
                $biayatarik = 0; 
            }else{
                if($atm->get_prioritas === true){
                    $biayatarik = 1500;
                }else{
                    $biayatarik = 6500;
                }
            }

            if(($juml+$biayatarik) <= $atm->get_saldo()){
                $this->saldo -= ($juml+$biayatarik);
                echo "Tarik Tunai Berhasil. Sisa Saldo Anda Rp. ".$this->get_saldo();
            }else{
                echo "Tarik Tunai Gagal, Saldo Tidak Memenuhi!";
            }
        }else{
            echo "Tarik Tunai Gagal, Hanya Menerima Kartu ATM!";
        }
    }
    public function transfer($atm, $tab_tujuan, $juml){
        $atm = new Kartu_ATM();
        $tab_tujuan = new Tabungan();
        if ($atm instanceof Kartu_ATM) {
            if($atm->get_bank() === $this->bank){
                $biayatf = 0; 
            }else{
                if($atm->get_prioritas === true){
                    $biayatf = 500;
                }else{
                    $biayatf = 2500;
                }
            }

            if(($juml+$biayatf) <= $atm->get_saldo()){
                $this->saldo -= ($juml+$biayatf);
                $tab_tujuan->set_saldo($tab_tujuan->get_saldo() + $juml);
                echo "Transfer Berhasil. Sisa Saldo Anda Rp. ".$this->get_saldo();
            }else{
                echo "Transfer Gagal, Saldo Tidak Memenuhi!";
            }
        }else{
            echo "Transfer Gagal, Hanya Menerima Kartu ATM!";
        }
    }
    public function setor_tunai($atm, $juml){
        if ($atm instanceof Kartu_ATM) {
            $this->saldo += $juml;
            echo "Setor Tunai Berhasil. Sisa Saldo Anda Rp. ".$this->get_saldo();
        }else{
            echo "Setor Tunai ditolak!";
        }
    }
}

class Mesin_EDC{
    private $bank;

    public function __construct($bank){
        if ($bank === 'BCL' || $bank === 'MANDALA') {
            $this->bank = $bank;
        } else {
            echo "Bank yang diberikan tidak valid.";
        }
    }
    public function pembayaran($anycard, $juml){
        $anycard = new Tabungan();
        if($anycard->jenis_kartu() === 1){
            if($anycard->get_bank() === $this->bank){
                $biayaedca = 0; 
            }else{
                if($anycard->get_prioritas === true){
                    $biayaedca = 1500;
                }else{
                    $biayaedca = 3500;
                }
            }
            if(($juml+$biayaedca) <= $anycard->get_saldo()){
                $this->saldo -= ($juml+$biayaedca);
                echo "Tarik Tunai Berhasil. Sisa Saldo Anda Rp. ".$this->get_saldo();
            }else{
                echo "Tarik Tunai Gagal, Saldo Tidak Memenuhi!";
            }
        } elseif($anycard->jenis_kartu() === 2){
            if($anycard->get_bank() === $this->bank){
                $biayaedck = 0; 
            }else{
                if($anycard->get_prioritas === true){
                    $biayaedck = $juml * 5/100;
                }else{
                    $biayaedck = $juml * 10/100;
                }
            }

            if(($juml+$biayaedck) <= $anycard->get_saldo()){
                $this->saldo -= ($juml+$biayaedck);
                echo "Tarik Tunai Berhasil. Sisa Saldo Anda Rp. ".$this->get_saldo();
            }else{
                echo "Tarik Tunai Gagal, Saldo Tidak Memenuhi!";
            }
        }
    }
}

// 1. Membuat objek untuk Bud!
$budi = new Tabungan("Budi", "BCL", true, 5000000);
$atm_budi = new Kartu_ATM("Budi", "BCL", true, 5000000); // Membuat objek Kartu ATM untuk Bud!

// 2. Membuat objek untuk Anton
$tabungan = new Tabungan("Anton", "MANDALA", false, 100000);

// 3. Mendaftarkan Kartu Kredit untuk Anton dengan batas maksimal pinjaman Rp. 10.000.000
$anton = new Kartu_kredit($tabungan, 10000000);

// 4. Membuat objek Mesin ATM dari bank MANDALA untuk Bud!
$budiatm = new Mesin_ATM("MANDALA");

// 5a. Melakukan Tarik Tunai di Mesin ATM sebesar Rp. 200.000 untuk Bud!
$budiatm->tarik_tunai($atm_budi, 200000);

// 5b. Melakukan transfer ke tabungan Anton dari Mesin ATM sebesar Rp. 300.000
$tab_tujuan = $tabungan; // Anton mengirim ke dirinya sendiri
$budiatm->transfer($atm_budi, $tab_tujuan, 300000);

// 5c. Melakukan Setor Tunai di Mesin ATM sebesar Rp. 500.000
$budiatm->setor_tunai($atm_budi, 500000);

// 5d. Melakukan pembayaran di Mesin EDC sebesar Rp. 500.000
$mesin_edc = new Mesin_EDC("BCL");
$mesin_edc->pembayaran($tabungan, 500000);

// 6a. Melakukan Tarik Tunai di Mesin ATM sebesar Rp. 50.000 untuk Anton
$anton_atm = new Kartu_ATM(); // Membuat objek Kartu ATM untuk Anton
$budiatm->tarik_tunai($anton_atm, 50000);

// 6b. Melakukan transfer ke tabungan Anton dari Mesin ATM sebesar Rp. 10.000
$budiatm->transfer($anton_atm, $tabungan, 10000);

// 6c. Melakukan Setor Tunai di Mesin ATM sebesar Rp. 200.000
$budiatm->setor_tunai($anton_atm, 200000);

// 6d. Melakukan pembayaran di Mesin EDC sebesar Rp. 2.500.000
$mesin_edc->pembayaran($tabungan, 2500000);

// 7. Menampilkan saldo kartu ATM Bud!, sisa kredit yang dapat digunakan oleh Anton, dan saldo tabungan Anton
echo "Saldo Kartu ATM Budu!: " . $atm_budi->get_saldo() . "<br>";
echo "Sisa Kredit Kartu Kredit Anton: " . ($anton->get_batas_kredit() - $anton->get_juml_pinjaman()) . "<br>";
echo "Saldo Tabungan Anton: " . $tabungan->get_saldo() . "<br>";

?>