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
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
</head>

<body>

    <div class="canvas-holder" style="width:50%">
        <canvas id="chart-area"></canvas>
    </div>

    <script>
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: <?php echo json_encode($total); ?>,

                backgroundColor: [
                    'red',
                    'black',
                    'white',
                    'green',
                    'yellow',
                    'blue',
                    'purple',
                    'brown',
                    'gray'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 12, 86, 1)',
                    'rgba(255, 9, 86, 1)',
                    'rgba(255, 120, 86, 1)',
                    'rgba(255, 170, 86, 1)',
                    'rgba(255, 32, 86, 1)',
                    'rgba(255, 90, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                label: 'Presentase Kasus Covid'
            }],
            labels: <?php echo json_encode($negara); ?>
        },
        options: {
            responsive: true
        }
    }
    window.onload = function() {
        var ctx = document.getElementById('chart-area').getContext('2d')
        window.myPie = new Chart(ctx, config);
    };
    document.getElementById('randomizeData').addEventListener('click', function() {
        config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor()
            })
        })
        window.myPie.update();
    })

    var colorNames = Object.keys(window.chartColors)
    document.getElementById('addDataset').addEventListener('click', function() {
        var newDataset = {
            backgroundColor: [],
            data: [],
            label: 'New dataset' + config.data.datasets.length,
        }
        for (var index = 0; index < config.data.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
            var colorName = colorNames[index % colorNames.length]
            var newColor = window.chartColors(colorName)
            newDataset.backgroundColor.push(newColor);
        }
        config.data.datasets.push(newDataset)
        window.myPie.update()
    })
    document.getElementById('removeDataset').addEventListener('click',
        function() {
            config.data.datasets.splice(0, 1)
            window.myPie.update();
        })
    </script>

</body>

</html>