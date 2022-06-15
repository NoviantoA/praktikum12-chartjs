<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_latihan12";

// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);
// total kasus
$negara = mysqli_query($conn, "SELECT * FROM tb_covid");
while ($row = mysqli_fetch_array($negara)) {
    $country_name[] = $row['country'];
    // Mengambil data total deaths pada tb_covid 
    $query = mysqli_query($conn, "SELECT total_cases FROM tb_covid WHERE id='" . $row['id'] . "'");
    $row = $query->fetch_array();
    $total_cases[] = $row['total_cases'];
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Doughnut Chart COVID-19</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
</head>

<center>
<body>
	<div id="canvas-holder" style="width:50%">
        <h1>Total Kasus</h1>
		<canvas id="chart-area"></canvas>
	</div>
	<script>

        //total case
        var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					label: 'Grafik Total Kasus COVID-19',
					data:<?php echo json_encode($total_cases); ?>,
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)',
					'rgba(0, 255, 254, 0.2)','rgba(115, 255, 216, 0.2)','rgba(210, 105, 30, 0.2)',
					'rgba(128, 0, 128, 0.2)','rgba(0, 0, 205, 0.2)','rgba(40, 178, 170, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)',
					'rgba(0, 255, 254, 1)','rgba(115, 255, 216, 1)','rgba(210, 105, 30, 1)','rgba(128, 0, 128, 1)',
					'rgba(0, 0, 205, 1)','rgba(40, 178, 170, 1)'
					],
					label: 'Persentase Total Cases COVID-19'
				}],
				labels: <?php echo json_encode($country_name); ?>},
			options: {
				responsive: true
			}
		};
 
		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body></center>
</html>