<?php 
//print_r($_GET)
?>
<a href="../praktikum2/form.php">kembali</a>

    <table border="1" width="100%">
        <tr>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
        </tr>
        <tr>
            <td><?php echo $_GET['Fname']; ?></td>
            <td><?php echo $_GET['Lname']; ?></td>
        </tr>
    </table>
