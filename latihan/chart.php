<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_latihan12";

// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

$produk = mysqli_query($conn, 'SELECT * FROM tb_barang');
while($row = mysqli_fetch_array($produk)){
    $nama_produk[] = $row['barang'];

    $query = mysqli_query($conn, "SELECT SUM(jumlah) as jumlah FROM tb_penjualan WHERE id_barang='".$row['id_barang']."'");
    $row = $query->fetch_array();
    $jumlah_produk[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Graphic Menggunakan Chart JS</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
</head>

<body>

    <div style="width: 800px; height:800px;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($nama_produk); ?>,
            datasets: [{
                label: 'Grafik Penjualan',
                data: <?php echo json_encode($jumlah_produk); ?>,

                backgroudColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginZero: true
                    }
                }]
            }
        }
    })
    </script>

</body>

</html>