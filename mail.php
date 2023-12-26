<?php 

    // secret key : 6LdGbTUpAAAAAD5XWxErdH6p7drsA37xghirUDwE

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';

    //Ce fichier contien la configuration SMTP et les données personnelles
    require 'config.php';


    // Vérification du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //Verification confirmation condition 
        if (!isset($_POST['conditions'])) {
            $response = [
                'status' => 'false',
                'message' => '<p class="text-bg-danger fs-4 fw-bold">Veuillez confimer les conditions.</p>'
            ];
            echo json_encode($response);
            exit();
        }
        // Vérification du reCAPTCHA
        $recaptchaResponse = $_POST['g-recaptcha-response'];

        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaData = [
            'secret'   => $recaptchaSecretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];

        $options = [
            'http' => [
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'method' => 'POST',
                'content' => http_build_query($recaptchaData)
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($recaptchaUrl, false, $context);
        $jsonResult = json_decode($result, true);

        // Vérification réussie
        if (!$jsonResult['success']) {
            $response = [
                'status' => 'false',
                'message' => '<p class="text-bg-danger fs-4 fw-bold">Échec de la vérification reCAPTCHA. Veuillez réessayer.</p>'
            ];

            echo json_encode($response);
            exit();
        }

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['city']) && isset($_POST['message'])) {
            
            $senderName = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $senderEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $senderPhone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            $senderCity = filter_var($_POST['city'], FILTER_SANITIZE_SPECIAL_CHARS );
            $senderMessage = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS );

    
            // Configuration de PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $smtp['host'];  // Remplacez par votre serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = $smtp['username'];  // Remplacez par votre e-mail
            $mail->Password = $smtp['password'];  // Remplacez par votre mot de passe
            $mail->SMTPSecure = 'tls';
            $mail->Port = $smtp['port'];

            // Destinataire
            $mail->setFrom($user_email, 'admin');
            $mail->addAddress($user_email);  // Remplacez par l'adresse du destinataire

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Nouveau formulaire soumis par :'. $senderName;
            $mail->Body = "Nom: $senderName<br>Email: $senderEmail<br>Téléphone: $senderPhone<br>Ville: $senderCity<br>Message: $senderMessage";

            // Envoyer l'e-mail
            if ($mail->send()) {
                $response = [
                    'status' => 'success',
                    'message' => '<p class="text-bg-success fs-4 fw-bold">Formulaire soumis avec succès.</p>'
                ];
    
                echo json_encode($response);
            } else {
                $response = [
                    'status' => 'false',
                    'message' => '<p class="text-bg-danger fs-4 fw-bold">Erreur lors de l\'envoi du formulaire.</p>'
                ];
    
                echo json_encode($response);
            }
        } else {
            // Échec de la vérification reCAPTCHA
            $response = [
                'status' => 'false',
                'message' => '<p class="text-bg-danger fs-4 fw-bold">veuillez remplir tout les champs</p>'
            ];

            echo json_encode($response);
            exit();
        }
    }
  
?>