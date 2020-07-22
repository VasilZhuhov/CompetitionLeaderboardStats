<!DOCTYPE html>
<html>
<head>
<title>Graphical Data</title>
<style>
    <?php include "../style/data_graph_style.css"; ?>
</style>
<script>
        <?php include "../server/node_modules/chart.js/dist/Chart.min.js"; ?>
</script>

<?php include "../server/registerCompetition.php"; ?>

</head>
<body>
    <h1 class="center-text"><?php echo $_POST['name'] ?></h1>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        <?php include "showDataGraph.js"; ?>
    </script>

</body>
</html>