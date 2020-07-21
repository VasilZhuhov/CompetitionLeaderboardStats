<!DOCTYPE html>
<html>
<head>
<title>Graphical Data</title>
<!-- <link rel="stylesheet" href="../style/data_graph_style.css"> -->
<style>
    <?php include "../style/data_graph_style.css"; ?>
</style>
<!-- <script type="text/javascript" src="../server/node_modules/chart.js/dist/Chart.min.js"></script> -->
<script>
        <?php include "../server/node_modules/chart.js/dist/Chart.min.js"; ?>
</script>

<?php include "../server/registerCompetition.php"; ?>

</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <!-- <script type="text/javascript" src="showDataGraph.js"></script> -->
    <script>
        <?php include "showDataGraph.js"; ?>
    </script>

</body>
</html>