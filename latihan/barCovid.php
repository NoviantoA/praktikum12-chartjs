<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_latihan12";

// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

$covid = mysqli_query($conn, 'SELECT * FROM tb_covid');
while($row = mysqli_fetch_array($covid)){
    $negara[] = $row['country'];

    $query = mysqli_query($conn, "SELECT SUM(total_cases) as total_cases FROM tb_covid WHERE id='".$row['id']."'");
    $row = $query->fetch_array();
    $total[] = $row['total_cases'];
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
            labels: <?php echo json_encode($negara); ?>,
            datasets: [{
                label: 'Grafik Kasus Covid',
                data: <?php echo json_encode($total); ?>,

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