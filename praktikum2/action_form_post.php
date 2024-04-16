<?php
session_start();

if (!isset($_SESSION['Fname'])) {
    $_SESSION['Fname'] = [];
}

if (!isset($_SESSION['Lname'])) {
    $_SESSION['Lname'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];

    $_SESSION['Fname'][] = $fname;
    $_SESSION['Lname'][] = $lname;
}

?>
<a href="../praktikum2/form.php">kembali</a>

<table border="1" width="100%" style="text-align: center;">
    <tr>
        <th>Nama Depan</th>
        <th>Nama Belakang</th>
    </tr>
    <?php
    if (isset($_SESSION['Fname']) && isset($_SESSION['Lname'])) {
        for ($i = 0; $i < count($_SESSION['Fname']); $i++) {
            echo '<tr>
            <td>'.$_SESSION['Fname'][$i].'</td>
            <td>'.$_SESSION['Lname'][$i].'</td>
            </tr>';
        }
    }
    ?>
</table>

<?php 
if (!isset($_SESSION['jumlah'])) {
    $_SESSION['jumlah'] = 1;
} else {
    $_SESSION['jumlah']++;
}

echo 'Form Telah disubmit sebanyak <span style="color:red">'.$_SESSION['jumlah'].'</span> kali';
?>
