<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="jquery-3.7.1.min.js"></script>

</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <nav>
        <ul>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="admin_panel.php">Admin Panel</a></li>
            <li><a href="contact.php">Kontakt</a></li>
        </ul>
    </nav>
    <section>



<?php
require '../phpmailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function PokazKontakt() {
    echo '<form method="POST"';
    echo '<label for="email">Twój email:</label>';
    echo '<input type="email" name="email" required>';

    echo '<label for="temat">Temat:</label>';
    echo '<input type="text" name="subject" required>';

    echo '<label for="tresc">Treść:</label>';
    echo '<textarea name="body" required></textarea>';

    echo '<input type="submit" name="message" value="Wyślij">';
    echo '</form>';
    
    echo '<form method="POST"';
    echo '<label for="email">Twój email:</label>';
    echo '<input type="email" name="email" required>';
    echo '<input type="submit" name="password" value="Wyślij">';
    echo '</form>';
}


PokazKontakt();
function wyslijmailakontakt()
{
    if (empty($_POST['subject']) || empty($_POST['body']) || empty($_POST['email'])) {
        echo "nie_wypelniles_pola";
        echo Pokazkontakt(); //ponowane wywolanie formularza
    } else {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'pliszka11234@gmail.com';                     
            $mail->Password   = 'gjai iywk jngw thhq';                               
            $mail->SMTPSecure = 'ssl';         
            $mail->Port       = 465;                                    

            //Recipients
            $mail->setFrom($_POST['email'], 'Mailer');
            $mail->addAddress($_POST['email']);     

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $_POST['subject'];
            $mail->Body    = $_POST['body'];

            $mail->send();
            echo 'wiadomosc_wyslana';
        } catch (Exception $e) {
            echo "wiadomosc_nie_wyslana: {$mail->ErrorInfo}";
        }
    }
    
    
}



function PrzypomnijHaslo() {
    if (empty($_POST['email']) || empty($_POST['body']) || empty($_POST['email'])) {
    }
    else {
    try{
    $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'pliszka11234@gmail.com';                     
            $mail->Password   = 'gjai iywk jngw thhq';                               
            $mail->SMTPSecure = 'ssl';         
            $mail->Port       = 465;                                    

            //Recipients
            $mail->setFrom($_POST['email'], 'Mailer');
            $mail->addAddress($_POST['email']);     

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = "Twoje hasło";
            $message = "Twoje hasło to: ".$pass;
            $mail->Body = $message;

            $mail->send();
            echo 'wiadomosc_wyslana';
        } catch (Exception $e) {
            echo "wiadomosc_nie_wyslana: {$mail->ErrorInfo}";
    }
    }
    
}

if(isset($_POST['message'])){
    wyslijmailakontakt();
}
if(isset($_POST['password'])){
    PrzypomnijHaslo();
}

?>
    
    <!-- <form action="contact.php" method="post">
        <input type="hidden" name="action" value="sendPass">
        <input type="submit" value="Wyślij hasło">
    </form> -->
</section>

</body>
</html>
