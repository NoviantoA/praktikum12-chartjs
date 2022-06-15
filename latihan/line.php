<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_latihan12";

// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);
//total kasus
$negara = mysqli_query($conn, "SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($negara)){
	$country_name[] = $row['country'];
	// Mengambil data newcases pada tb_covid19 
	$query = mysqli_query($conn,"SELECT total_cases FROM tb_covid WHERE id='".$row['id']."'");
	$row = $query->fetch_array();
	$total_cases[] = $row['total_cases'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Line Chart COVID-19</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
</head>
<body>
    <div style="width: 800px;height: 800px">
        <canvas id="myChart"></canvas>
    </div>
    <script>


        // total kasus
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($country_name); ?>,
                datasets: [{
                    label: 'Grafik Total Cases COVID-19',
                    data: <?php echo json_encode($total_cases); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>
</body>
</html>