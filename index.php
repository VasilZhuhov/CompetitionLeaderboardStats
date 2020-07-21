<!DOCTYPE html>
<html>
    <head>
        <title>Register competition</title>
        <style>
            <?php include 'style/form.css'; ?>
        </style>
    </head>
    <body>
        <form class="form" action="./graphic/data_graph.php" method="POST">
            <input type="text" name="name" placeholder="Enter name of competition"><br>
            <input type="text" name="url" placeholder="Enter url of competition"><br>
            <input type="text" name="namePath" placeholder="Enter path to the name of competitor"><br>
            <input type="text" name="scorePath" placeholder="Enter path to the score of competitor"><br>
            <input type="text" name="rankPath" placeholder="Enter path to the rank of competitor"><br>
            <label for="useExisting">Use existing parser:</label>
            <input type="checkbox" name="useExisting" id="useExisting" onclick="showSelect()">
            <select name="selectedParser" id="selectedParser" class="hidden">
                <?php
                    include 'available_options.php';
                    foreach($options as &$option){
                        echo '<option value="'.$option["name"].'">'.$option["name"].'</option>';
                    }
                ?>
            </select>
            <input type="text" name="trackingTime" placeholder="Enter time to follow competition"><br>
            <button type="submit">Enter</button>

        </form>

    </body>
    <script>
        <?php include 'script/script.js'; ?>
    </script>
</html>
