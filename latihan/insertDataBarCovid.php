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
$sql = "INSERT INTO tb_covid (id, country, total_cases, new_cases, total_death, new_death, total_recovered, new_recovered) VALUE
(2, 'S Korea', '18168708', '5002', '524726', '7', '42633365', '2513'),
(3, 'Turkey', '15072747', '', '524726', '7', '42633365', '2513'),
(4, 'Vietnam', '10726045', '806', '524726', '7', '42633365', '2513'),
(5, 'Japan', '8945784', '16120', '524726', '7', '42633365', '2513'),
(6, 'Iran', '7232790', '59', '524726', '7', '42633365', '2513'),
(7, 'Indonesia', '6057142', '342', '524726', '7', '42633365', '2513'),
(8, 'Malaysia', '4516319', '1330', '524726', '7', '42633365', '2513'),
(9, 'Thailand', '4468955', '2162', '524726', '7', '42633365', '2513')
";

    if(mysqli_query($conn, $sql)){
        echo "Proses Insert Data Berhasil";
    }else{
        echo "Error Insert Data" . $sql. "<br>" .mysqli_error($conn);
    }
    mysqli_close($conn);
mysqli_close($conn);
?>