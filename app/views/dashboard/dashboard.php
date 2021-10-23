<?php
extract($data);

?>

<section class="container flex">

    <div class="stats">
        <div class="card-chart">
            <div class="info">
                <span class="title"></span>
                <span class="value"></span>
            </div>
            <div class="chart-container" >
                <canvas id="evenements"></canvas>
            </div>
        </div>
        <div class="card-chart">
            <div class="info">
                <span class="title"></span>
                <span class="value"></span>
            </div>
            <div class="chart-container" >
                <canvas id="users"></canvas>
            </div>
        </div>
        <div class="card-chart">
            <div class="info">
                <span class="title"></span>
                <span class="value"></span>
            </div>
            <div class="chart-container" >
                <canvas id="reservations"></canvas>
            </div>
        </div>
    </div>

    <div class="chart-container" style="height:400px; width:400px">
        <canvas id="reservations_by_time"></canvas>
    </div>

</section>


<script src="<?= ASSETS ?>js/chart.js"></script>
