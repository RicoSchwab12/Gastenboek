<?php
    //$conn = mysqli_connect('localhost', '22786', 'sMbNiznXs3IqxsuT', 'bap');
//$query = "SELECT * FROM guestbook ORDER BY id DESC";
//$result = mysqli_query($conn, $query);

    //PDO Database Connectie
    $conn = new PDO('mysql:host=localhost;dbname=bap', '22786' , 'sMbNiznXs3IqxsuT');

    //MySQL Query (commando naar database)
    $statement = $conn->prepare("SELECT * FROM guestbook ORDER BY id DESC");

    //PDO Query uitvoeren
    $statement->execute() or die('Er is een fout ogpetreden');

    function clean($input){
        //global $conn;
        $input = trim($input);
        $input = strip_tags($input);
        return $input;
    }
    if (isset($_GET['return'])) {
        $return = clean($_GET["return"]);
    }


?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BAP Opdracht 1</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.3/css/bulma.min.css">
</head>
<body>
    <div class="pageContent">
        <span class="title__largeTitle">BAP Gastenboek</span><br>
        <span class="title__subTitle">Gemaakt door Rico Schwab</span>
        <hr>
        <?php if(isset($return) && $return == "censorred"){
            echo "<span style='color: red;'>Je hebt iets slechts gezegd.</span>";
         } ?>
        <form action="submit.php" method="POST">
            <!-- Ik krijg een blikje cola of een kopje koffie van je nu. -->
            <label for="name">Je naam</label><br>
            <input class="input" type="text" style="width: 12em;" name="name" id="name" placeholder="Je naam" required><br>
            <label for="email">E-Mail Adres</label><br>
            <input class="input" style="width: 18em;" type="email" name="email" id="email" placeholder="E-Mail Adres" required><br>
            <label for="message">Uw bericht</label><br>
            <textarea class="textarea" rows="4" cols="50" name="message" id="message" placeholder="Je bericht" style="width: 16em !important;"  required></textarea><br><br>
            <input class="button is-info is-pulled-right" type="submit" value="Versturen">&nbsp;
        </form>
        <hr>
        <!-- Oh ja en nu ook een frikandelbroodje -->
        <?php
        while($row = $statement->fetch()){?>
            <div class="item">
                <b><?php echo $row["name"]; ?></b><br>
                <p><?php echo $row["message"]; ?></p>
                <div style="width: 8em;">
                    <hr></div>
            </div>
            <?php
        }
        ?>

    </div>
<!-- GEMAAKT DOOR DE VETKOELSTE BESTE ULTRA PERSOON Rico Schwab -->
</body>
</html>