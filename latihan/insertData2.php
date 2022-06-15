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
$sql = "INSERT INTO tb_penjualan (id_penjualan, id_barang, jumlah, tgl_penjualan) VALUE
(1, 1, 5, '2022-01-11'),
(2, 3, 3, '2022-02-13'),
(3, 2, 4, '2022-03-11'),
(4, 2, 3, '2022-02-14'),
(5, 3, 4, '2022-04-15'),
(6, 4, 1, '2022-05-17'),
(7, 1, 2, '2022-01-16'),
(8, 4, 7, '2022-01-19'),
(9, 3, 2, '2022-03-10'),
(10, 2, 5, '2022-04-15'),
(11, 1, 2, '2022-06-21')
";

    if(mysqli_query($conn, $sql)){
        echo "Proses Insert Data Berhasil";
    }else{
        echo "Error Insert Data" . $sql. "<br>" .mysqli_error($conn);
    }
    mysqli_close($conn);
mysqli_close($conn);
?>