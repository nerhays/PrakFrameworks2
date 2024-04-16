<?php 

include("mobil_pickup.php");

//echo "Output";

$obj_merah = new mobil_pickup();
$obj_biru = new mobil_pickup();

$obj_biru->set_merk("Carry");
$obj_merah->set_merk("Grand Max");

//echo "Merk Mobil Merah adalah ".$obj_merah->get_merk()."<br>";
//echo "Merk Mobil Biru adalah ".$obj_biru->get_merk()."<br>"."<br>";

$obj_merah->set_bak(2, 4, 2);
$obj_biru->set_bak(2, 5, 1);

$data_arrays = $obj_merah->get_data_bak();
$data_array = $obj_biru->get_data_bak();
//echo "Data l_Bak Mobil Carry adalah ".$data_arrays['l_bak']."<br>";
//echo "Data p_Bak Mobil Carry adalah ".$data_arrays['p_bak']."<br>";
//echo "Data t_Bak Mobil Carry adalah ".$data_arrays['t_bak']."<br>"."<br>";

//echo "Data Bak Mobil Grand Max adalah ".$data_array['l_bak']."<br>";
//echo "Data Bak Mobil Grand Max adalah ".$data_array['p_bak']."<br>";
//echo "Data Bak Mobil Grand Max adalah ".$data_array['t_bak']."<br>"."<br>";

$obj_merah->set_jenis_bbm(1);
$obj_biru->set_jenis_bbm(2);

//echo "Jenis BBM Mobil Carry adalah ".$obj_merah->get_jenis_bbm()."<br>";
//echo "Jenis BBM Mobil Grand Max adalah ".$obj_biru->get_jenis_bbm()."<br>"."<br>";

$obj_merah->set_isi_silinder(1500);
$obj_biru->set_isi_silinder(1500);

//echo "Silinder Mobil Carry adalah ".$obj_merah->get_isi_silinder()."<br>";
//echo "Silinder Mobil Grand Max adalah ".$obj_biru->get_isi_silinder()."<br>"."<br>";

$obj_merah->set_berat_max(200);
$obj_biru->set_berat_max(250);

//echo "Berat Maksimal Mobil Carry adalah ".$obj_merah->get_berat_max()." Kg"."<br>";
//echo "Berat Maksimal Mobil Grand Max adalah ".$obj_biru->get_berat_max()." Kg"."<br>"."<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil</title>
</head>
<body>
<a href="../index.php">kembali</a>
    <div>
        <h1 style="text-align: center;">Data Yang Ada</h1>
    </div>
    <table border="1" width="100%" style="text-align: center;">
        <tr>
            <th>Merk Mobil</th>
            <th>jenis BBM</th>
            <th>l_bak</th>
            <th>p_bak</th>
            <th>t_bak</th>
            <th>silinder</th>
            <th>berat_max</th>
        </tr>
        <tr>
            <th><?php echo $obj_merah->get_merk();?></th>
            <th><?php echo $obj_merah->get_jenis_bbm();?></th>
            <th><?php echo $data_arrays['l_bak'];?></th>
            <th><?php echo $data_arrays['p_bak']?></th>
            <th><?php echo $data_arrays['t_bak']?></th>
            <th><?php echo $obj_merah->get_isi_silinder();?></th>
            <th><?php echo $obj_merah->get_berat_max();?></th>
        </tr>
        <tr>
            <th><?php echo $obj_biru->get_merk(); ?></th>
            <th><?php echo $obj_biru->get_jenis_bbm();?></th>
            <th><?php echo $data_array['l_bak'];?></th>
            <th><?php echo $data_array['p_bak']?></th>
            <th><?php echo $data_array['t_bak']?></th>
            <th><?php echo $obj_biru->get_isi_silinder();?></th>
            <th><?php echo $obj_biru->get_berat_max();?></th>
        </tr>
    </table>

    <br>
    <br>
</body>
</html>

<?php
$obj_merah->set_nilai_angkut();
$obj_biru->set_nilai_angkut();


// poin c
echo "Mobil carry dimasukan muatan pasir sebanyak 15 liter: ";
if ($obj_merah->isi_pasir(15)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}
// poin d
echo "Mobil carry ditambah muatan pasirnya sebanyak 3 liter: ";
if ($obj_biru->isi_pasir(3)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}

// poin e
echo "Mobil carry ditambah muatan barang seberat 10 kg: ";
if ($obj_merah->isi_barang(10)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}

// poin g
// Test Kembali point e, hasil method harus “gagal”!
$obj_merah->set_jenis_pengangkutan("pasir");
echo "Mobil carry ditambah muatan barang seberat 10 kg: ";
if ($obj_merah->isi_barang_gagal(10)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}

// poin h
echo "Sisa kapasitas volume mobil carry yang masih bisa diangkut: " . $obj_merah->get_bak_volume() . " liter\n"."<br>"."<br>";

// poin j
echo "Sisa kapasitas Berat muatan mobil carry saat ini: " . $obj_merah->get_sisa_berat() . " kg\n"."<br>"."<br>";

// poin i
echo "Lakukan pengangkutan barang pada mobil grand max:\n"."<br>";
echo "i. 50 kg"."<br>";
echo "ii. 65 kg"."<br>";
echo "iii. 70 kg"."<br>";
echo "iv. 80 kg"."<br>";

$obj_biru->set_jenis_pengangkutan("barang");

//poin i
echo "Mobil Grand Max ditambah muatan barang seberat 50 kg: ";
if ($obj_biru->isi_barang(50)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}

//poin ii
echo "Mobil Grand Max ditambah muatan barang seberat 65 kg: ";
if ($obj_biru->isi_barang(65)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}

//poin iii
echo "Mobil Grand Max ditambah muatan barang seberat 70 kg: ";
if ($obj_biru->isi_barang(70)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}

//poin iv
echo "Mobil Grand Max ditambah muatan barang seberat 80 kg: ";
if ($obj_biru->isi_barang(80)) {
    echo "Berhasil\n"."<br>"."<br>";
} else {
    echo "Gagal\n"."<br>"."<br>";
}

echo "Sisa Kapasitas Berat muatan mobil grand max saat ini: " . $obj_biru->get_sisa_berat() . " kg\n"."<br>"."<br>"."<br>";


echo "Studi Kasus"."<br>"."<br>";
// poin 5
$obj_merah->set_kapasitas_bbm(45);
$obj_biru->set_kapasitas_bbm(45);

// poin 6
$obj_merah->set_jarak_tempuh(330); 
$obj_biru->set_jarak_tempuh(330);

// poin 7
// a. Kalkulasi biaya perjalanan
$biaya_perjalanan_merah = $obj_merah->kalkulasi_biaya_perjalanan(10000, 7000);
echo "Biaya perjalanan mobil carry: Rp. " . $biaya_perjalanan_merah . "\n"."<br>"."<br>";

// b. Sisa BBM
echo "Sisa BBM mobil Grand Max: " . $obj_biru->sisa_bbm() . " liter\n"."<br>"."<br>";

// c. Jarak yang telah ditempuh
echo "Jarak yang telah ditempuh mobil carryh: " . $obj_merah->perjalanan_berapa_km() . " km\n"."<br>"."<br>";

// poin 8
// a. dan b.
$biaya_surabaya_yogya = $obj_merah->kalkulasi_biaya_perjalanan(10000, 7000);
$sisa_bbm_surabaya_yogya = $obj_merah->sisa_bbm();

echo "Biaya perjalanan dari Surabaya ke Yogyakarta: Rp. " . $biaya_surabaya_yogya . "\n"."<br>"."<br>";
echo "Sisa BBM setelah sampai di Surabaya lagi: " . $sisa_bbm_surabaya_yogya . " liter\n"."<br>"."<br>";

// c.
$jarak_tempuh_merah = $obj_merah->get_jarak_tempuh();
$jarak_tempuh_biru = $obj_biru->get_jarak_tempuh();

echo "Jarak yang telah ditempuh mobil carry: " . $jarak_tempuh_merah . " km\n"."<br>"."<br>";
echo "Jarak yang telah ditempuh mobil Grand Max: " . $jarak_tempuh_biru . " km\n"."<br>"."<br>";

// d.
if ($jarak_tempuh_merah / $biaya_surabaya_yogya < $jarak_tempuh_biru / $obj_biru->kalkulasi_biaya_perjalanan(10000, 7000)) {
    echo "Mobil Carry lebih ekonomis untuk melakukan perjalanan tersebut.\n"."<br>"."<br>";
} else {
    echo "Mobil Grand Max lebih ekonomis untuk melakukan perjalanan tersebut.\n"."<br>"."<br>";
}

?>

