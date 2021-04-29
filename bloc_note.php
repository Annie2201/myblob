<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bloc Note</title>
</head>
<body>
<?php
    $db = mysqli_connect("localhost","root","root","gdt");

    if(isset($_POST['btn'])){
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $data = addslashes(file_get_contents($_FILES['myfile']['tmp_name']));
        $sql="INSERT INTO myblob (nom,mime,data) VALUES ('$name','$type','$data')";
        mysqli_query($db,$sql);
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="myfile">
    <button name="btn">Upload</button>
    </form>

    <p>Liste des choses</p>

  <!--  <ol> </ol> -->
    <?php 
    $stat= 'SELECT * FROM myblob';
    $result = mysqli_query($db,$stat);
    if (!$stat) {
    echo 'Impossible d\'exécuter la requête : ' . mysql_error();
    exit;
    }
    while ($row = mysqli_fetch_array($result)) {
        echo '<img src="data:image;base64,'.base64_encode($row['data']).'" alt="Image" style="width: 100px; height:100px;">';
    }
    ?>
 
</body>
</html>