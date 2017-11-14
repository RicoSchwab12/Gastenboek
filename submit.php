<?php

    //PDO Database Connectie
    $conn = new PDO('mysql:host=localhost;dbname=bap', '22786' , 'sMbNiznXs3IqxsuT');

    //MySQL Query (commando naar database)
    $statement = $conn->prepare("INSERT INTO guestbook (name, email, message) VALUES(?,?,?)");

    //Clean all those things :)
    function clean($input){
        global $conn;
        $input = trim($input);
        $input = strip_tags($input);
        //$input = mysqli_real_escape_string($conn, $input);
        return $input;
    }

    if ($_POST['name'] && $_POST['email'] && $_POST['message']){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $name = clean($name);
        $email = clean($email);
        $message = clean($message);

        $lowerCaseMessage = strtolower($message);

        if(preg_match('(kut|hoer|kanker|tyfus)', $lowerCaseMessage) === 1) {
            header("Location: index.php?return=censorred");
            die();
        } else {
            //Variabelen toewijzen aan parameters
            $statement->bindParam(1, $name);
            $statement->bindParam(2,$email);
            $statement->bindParam(3, $message);

            //PDO Query uitvoeren
            $statement->execute() or die('Er is een fout ogpetreden');
            header("Location: index.php");

            /* if ($result) {
                $msg = "Bericht van: $name, met de tekst: $message";
                //mail("ricoschwab5@icloud.com","RicoSchwab - Nieuw Bericht in gastenboek",$msg);

                $to = 'j.schmitz@ma-doos.nl';
                $subject = 'Nieuw Bericht in Gastenboek';
                //  $message = 'hello';
                $headers = 'From: noreply@rschwab.eu' . "\r\n" .
                    'Reply-To: noreply@rschwab.eu' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $msg, $headers);
                header("Location: index.php");
            } else {
                echo "Er is iets fout gegaan.";
                echo mysqli_error($conn);
            }*/
        }
    } else {
        echo "Prenk, je moet alles invullen. DOEI!.";
    }
?>