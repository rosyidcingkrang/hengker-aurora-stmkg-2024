<?php
//ko
$konek = mysqli_connect("localhost", "root", "", "grafiksensor");
//baca data dari tabel tb_sensor
//baca informasi tanggal untuk semua data = sumbu x di grafik
$waktu = mysqli_query($konek, "SELECT waktu from tb_sensor ORDER BY ID ASC");
// BACA INFROMASI KELEMBABAN untuk semua data = sumbu Y di grafik
$suhu = mysqli_query($konek, "SELECT suhu from tb_sensor ORDER BY ID ASC");
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Grafik Sensor
    </div>

    <div class=" panel-body">
        <!--SIAPKAN CANVAS-->
        <canvas id="myChart"></canvas>

        <script type="text/javascript">
            var canvas =document.getElementById('myChart');
            var data = {
                labels :[
                    <?php
                    while($data_waktu = mysqli_fetch_array($waktu))
                    {
                        echo '"'.$data_waktu['waktu'].'",';
                    }
                    ?>
                ],
                datasets : [{
                    label : "suhu", 
                    data : [
                        <?php
                    while($data_suhu = mysqli_fetch_array($suhu))
                    {
                        echo '"'.$data_suhu['suhu'].'",';
                    }
                    ?>
                    ]
                }]
            };
            //option gra
            var option = {
                showLines : true,
                Animation : {duration : 0}
            };
            //cetak grafik kedalam canvas
            var myLineChart = Chart.Line(canvas,{
                data : data,
                option :option
            });
        </script>
    </div>

</div>