<!DOCTYPE html>
<html>
    <head>
        <title>Register competition</title>
        <style>
            <?php include 'style/form.css'; ?>
        </style>
    </head>
    <body>
        <form class="form" action="./server/registerCompetition.php" method="POST">
            <input type="text" name="name" placeholder="Enter name of competition"><br>
            <input type="text" name="url" placeholder="Enter url of competition"><br>
            <input type="text" name="namePath" placeholder="Enter path to the name of competitor"><br>
            <input type="text" name="scorePath" placeholder="Enter path to the score of competitor"><br>
            <input type="text" name="rankPath" placeholder="Enter path to the rank of competitor"><br>
            <button type="submit">Enter</button>
        </form>

    </body>
</html>
