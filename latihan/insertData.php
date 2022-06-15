<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_latihan12";

// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check koneksi
if(!$conn){
    die("Koneksi Gagal : " . mysqli_connect_error());
}

// insert data ke tabel tb_siswa
$sql = "INSERT INTO tb_barang (id_barang, barang) VALUE
(1, 'Redmi Note 7'),
(2, 'Samsung M20'),
(3, 'Realme 3'),
(4, 'Iphone X')
";

    if(mysqli_query($conn, $sql)){
        echo "Proses Insert Data Berhasil";
    }else{
        echo "Error Insert Data" . $sql. "<br>" .mysqli_error($conn);
    }
    mysqli_close($conn);
mysqli_close($conn);
?>