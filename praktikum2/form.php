<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="../praktikum2/action_form_post.php" method="post" id="idform">
        <label for="Fname">First Name : </label>
        <input type="text" name="Fname" placeholder="Inputkan Nama Anda"><br><br>
        <label for="Lname">Last Name : </label>
        <input type="text" name="Lname" placeholder="Inputkan Nama Akhir Anda"><br><br>
        <!--<input type="submit" name="simpan" value="submit">-->
    </form>

    <!-- <div id="iddiv">
        <button onclick="proses()">proses</button>
    </div> -->
    <div id="iddiv">
        <button onclick="proses()">Proses</button>
        <span id="msg"></span>
    </div>

    <script>
        function proses() {
            //document.getElementById('idform').submit();
            //var element = document.getElementById('iddiv');
            //element.innerHTML = "Loading...";
            var loadingMessageElement = document.getElementById('msg');
            loadingMessageElement.innerHTML = "Loading...";

            document.getElementById('idform').submit();
        }
    </script>
</body>
</html>