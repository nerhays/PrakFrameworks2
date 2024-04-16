<?php 

class Mobil_pickup {
    private $merk;
    private $jenis_bbm;
    private $isi_silinder;
    private $l_bak;
    private $p_bak;
    private $t_bak;
    private $berat_max;
    private $volume_bak;
    private $brt_angkut;
    private $brt_diangkut;
    private $vol_angkut;
    private $jenis_pengangkutan;
    private $kapasitas_bbm; 
    private $jumlah_bbm; 
    private $jarak_tempuh;

    public function set_merk($merk){
        $this->merk = $merk;
    }

    public function get_merk(){
        return $this->merk;
    }

    public function set_bak($l, $p, $t){
        $this->l_bak = $l;
        $this->p_bak = $p;
        $this->t_bak = $t;
    }

    public function get_data_bak() {
        return array(
            'l_bak' => $this->l_bak, 
            'p_bak' => $this->p_bak, 
            't_bak' => $this->t_bak
        );
    }

    public function set_jenis_bbm($tipe){
        $this->jenis_bbm = $tipe;
    } 
    
    public function get_jenis_bbm(){
        return $this->jenis_bbm;
    }

    public function set_isi_silinder($juml){
        $this->isi_silinder = $juml;
    }

    public function get_isi_silinder(){
        return $this->isi_silinder;
    }

    public function set_berat_max($berat){
        $this->berat_max = $berat;
    }

    public function get_berat_max(){
        return $this->berat_max;
    }

    public function set_jenis_pengangkutan($jenis) {
        $this->jenis_pengangkutan = $jenis;
    }

    public function set_nilai_angkut() {
        $this->vol_angkut = $this->l_bak * $this->p_bak * $this->t_bak;
        $this->brt_diangkut = $this->berat_max;
    }

    public function get_bak_volume() {
        return $this->vol_angkut;
    }

    public function get_sisa_berat() {
        return $this->brt_diangkut;
    }

    public function isi_barang($berat) {
        if ($this->brt_diangkut >= $berat) {
            $this->brt_diangkut -= $berat;
            return true;
        } else {
            return false;
        }
    }

    public function isi_pasir($volume) {
        if ($this->vol_angkut >= $volume) {
            $this->vol_angkut -= $volume;
            return true;
        } else {
            return false;
        }
    }

    public function isi_barang_gagal($berat){
        if ($this->jenis_pengangkutan == "barang" && $this->brt_diangkut >= $berat) {
            $this->brt_diangkut -= $berat;
            return true;
        } else {
            return false;
        }
    }

    public function isi_pasir_gagal($volume){
        if ($this->jenis_pengangkutan == "pasir" && $this->vol_angkut >= $volume) {
            $this->vol_angkut -= $volume;
            return true;
        } else {
            return false;
        }
    }

    public function turun_barang($berat) {
        $this->brt_diangkut += $berat;
        if ($this->brt_diangkut < 0) {
            $this->brt_diangkut = 0;
        }
        return $this->brt_diangkut;
    }    

    public function turun_pasir($volume) {
        $this->vol_angkut += $volume;
        if ($this->vol_angkut < 0) {
            $this->vol_angkut = 0;
        }
        return $this->vol_angkut;
    }

    public function set_kapasitas_bbm($kapasitas) {
        $this->kapasitas_bbm = $kapasitas;
    }

    public function isi_bbm($liter) {
        if ($this->jumlah_bbm + $liter <= $this->kapasitas_bbm) {
            $this->jumlah_bbm += $liter;
            return true;
        } else {
            return false;
        }
    }

    public function set_jarak_tempuh($jarak) {
        $this->jarak_tempuh = $jarak;
    }

    public function get_jarak_tempuh() {
        return $this->jarak_tempuh;
    }

    public function kalkulasi_biaya_perjalanan($harga_bensin, $harga_solar) {
        $jarak_tempuh_per_liter = ($this->jenis_bbm == "bensin") ? 15 : 10; 
        $liter_yang_dibutuhkan = $this->jarak_tempuh / $jarak_tempuh_per_liter;
        $biaya_perjalanan = $liter_yang_dibutuhkan * (($this->jenis_bbm == "bensin") ? $harga_bensin : $harga_solar);

        return $biaya_perjalanan;
    }

    public function sisa_bbm() {
        return $this->kapasitas_bbm - $this->jumlah_bbm;
    }

    public function perjalanan_berapa_km() {
        return $this->jarak_tempuh;
    }

    public static function hitung_sisa_bbm_setelah_sampai_tujuan($mobil, $harga_bensin, $harga_solar) {
        $jarak_tempuh_per_liter = ($mobil->get_jenis_bbm() == "bensin") ? 15 : 10;
        $liter_yang_dibutuhkan = $mobil->get_jarak_tempuh() / $jarak_tempuh_per_liter;
        $frekuensi_isi_bbm = ceil($liter_yang_dibutuhkan / $mobil->kapasitas_bbm);
        $jumlah_bbm_diisi = $frekuensi_isi_bbm * $mobil->kapasitas_bbm;
        $sisa_bbm_setelah_sampai_tujuan = $jumlah_bbm_diisi - $liter_yang_dibutuhkan + $mobil->jumlah_bbm;

        return $sisa_bbm_setelah_sampai_tujuan;
    }

}

class Perjalanan {
    public static function sisaBbmDitujuan($mobil) {
        return Mobil_pickup::hitung_sisa_bbm_setelah_sampai_tujuan($mobil, 10000, 8000);
    }
}



?>