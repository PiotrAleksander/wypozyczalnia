<?php

require_once 'class.phpmailer.php';

$_POST = array_map('trim', $_POST);

$error = false;

if (!isset($_POST['contact_name']) || empty($_POST['contact_name'])) {
    $error = true;
}

if (!isset($_POST['contact_email']) || empty($_POST['contact_email']) || !PHPMailer::ValidateAddress($_POST['contact_email'])) {
    $error = true;
}
/*if (!isset($_POST['contact_check']) || empty($_POST['contact_check']) || (int) $_POST['contact_check'] !== ((int) $_POST['contact_check_data'][0] * (int) $_POST['contact_check_data'][1])) {
    $error = true;
}
*/
if ($error) {
    exit('nok');
}

if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Prosimy o weryfikacj&#281;.</h2>';
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le10wcTAAAAABZMJNdgVUNZRA3nLM4HXqBw2RAO&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>Weryfikacja nie powiod&#322;a si&#281;, prosimy spróbowa&#263; ponownie.</h2>';
        }else
        {
          echo '<h2>Dzi&#281;kujemy</h2>';
        }


$mail = new PHPMailer();

$mail->CharSet = 'UTF-8';

$mail->SetFrom($_POST['contact_email'], $_POST['contact_name']);
$mail->AddAddress('piotrhugonow@gmail.com');
$mail->Subject = 'Wypo&#380;yczalnia';
if (isset($_POST['renault'])) {
  $renault = "RENAULT";
} else {
  $renault = "";
}
if (isset($_POST['ducato'])){
  $ducato = "DUCATO";
} else {
  $ducato = "";
}

$mail->Body = 'Nowe zamówienie:'. "\n". $renault. "\n". $ducato. "\n". $_POST['contact_body'];
 


/*je&#380;eli b&#281;dzie zwrot $mail->send();

$zwrot = new PHPMailer();

$zwrot->CharSet = 'UTF-8';

$zwrot->SetFrom('piotrhugonow@gmail.com');
$zwrot->AddAddress($_POST['contact_email'], $_POST['contact_name']);
$zwrot->Subject = 'Rezerwacja';
$zwrot->Body = 'Dzi&#281;kujemy za rezerwacj&#281;, gwarantujemy kontakt w przeci&#261;gu doby.';
$zwrot->send();*/

if (!$mail->Send()/*&&!$zwrot->Send()*/) {
    exit('Rezerwacja nie powiod&#322;a si&#281;. Prosimy spróbowa&#263; pó&#378;niej.');
}

exit('Rezerwacja zosta&#322;a przyj&#281;ta, skontaktujemy si&#281; w przeci&#261;gu 24 godzin.');