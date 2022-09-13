<?php

session_start();

try {
    $pdo = new PDO('mysql:dbname=time;host=127.0.0.1', 'root', '', [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //  FETCH_OBJ or FETCH_ASSOC or FETCH_CLASS
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Connected successfully";
} catch (\Throwable $e) {
    echo "Error Database";
    die();
}

if (isset($_SESSION['ER'])) {
    echo $_SESSION['ER'];
}

if (isset($_SESSION['WE'])) {
    echo $_SESSION['WE'];
}

if (isset($_POST['add-data'])) {
    $text = $_POST['text'];
    $time = time();

    if (empty($text)) {
        $_SESSION['ER'] = "<br><br>Fill All Fields !";
        header('Location: index.php');
        die();
    }

    $insert = $pdo->prepare('INSERT INTO `text` (`id`, `text`, `time`) VALUES (NULL, :TEXT, CURRENT_TIMESTAMP);');
    $insert->execute([
        'TEXT' => $text
    ]);
    $_SESSION['WE'] = "<br><br>Inserted Successfuly In Database !";
    header('Location: index.php');
    die();
}

// Import Data From Database

$import = $pdo->query('SELECT * FROM `text`')->fetchAll();

if (!isset($import)) {
    $_SESSION['ER'] = "<br><br>Messages Empty !";
    header('Location: index.php');
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <div class="form-send">
            <form method="POST">
                <label for="">Text</label> <br>
                <input type="text" name="text"> <br><br>
                <label for="">Current time</label> <br>
                <input type="submit" name="add-data" value="INSERT">
            </form>
        </div>
    </center>
    <br><br><br>
    <div class="text-box">
        <center>
        <?php foreach ($import as $key => $data) : ?>
        <hr width="20%">
        <div style="background: #000;color: #fff;width: 20%;padding: 5px 5px 5px;border-radius: 10px;" class="text-form">
            <p><?= $data->text ?></p><br>
            <time class="timeago" datetime="<?= $data->time ?>">December 17, 2011</time>
        </div>
        <hr width="20%">
        <?php endforeach ?> 
        </center>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="jquery.timeago.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
    </script>
</body>
</html>