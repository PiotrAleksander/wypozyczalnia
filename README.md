# wypozyczalnia
wypozyczalnia
powered by Bootstrap 3
.carousel dla slidera w index i regulamin
forma rezerwacji jest podpięta pod send.php, który require_once 'class.phpmailer.php'; (phpmailer.php jest funkcją idealną dla formularza kontaktowego, czy newslettera). 
Send.php używa recaptcha z kluczem strony (powiązanym z domeną) umieszczonym pod <form> w rezerwacja.html.
Wysyła nieco sformatowaną wiadomość do piotrhugonow@gmail.com.
PHPMailer pozwala na eleganckie sprawdzanie czy funckja send (od której nazwałem send.php, to nazewnictwo nie jest obligatoryjne. Można użyć byłoby np. "wyslij.php") zwraca jakieś błędy i można w conditionalu wyświetlić użytkownikowi wiadomość raczej typu: "Nie powiodło się", aniżeli "ERR" na czerwono.
