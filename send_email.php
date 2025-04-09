<?php
// File: send_email.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'activationakun@gmail.com';
        $mail->Password   = 'citwtsfnlbuxlnhf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('WoncrewOrganinzer@gmail.com', 'Woncrew Organnizer');
        // $mail->addAddress('andry.antok25@gmail.com');
        $mail->addAddress('pvthandika@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reservasi Baru dari ' . $_POST['name'];
        
        $messageBody = "
            <h2>Detail Reservasi</h2>
            <p><strong>Nama:</strong> " . htmlspecialchars($_POST['name']) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>
            <p><strong>Telepon:</strong> " . htmlspecialchars($_POST['phone']) . "</p>
            <p><strong>Jenis Acara:</strong> " . htmlspecialchars($_POST['event_type']) . "</p>
            <p><strong>Tanggal Acara:</strong> " . htmlspecialchars($_POST['event_date']) . "</p>
            <p><strong>Jumlah Tamu:</strong> " . htmlspecialchars($_POST['guest_count']) . "</p>
            <p><strong>Deskripsi:</strong><br>" . nl2br(htmlspecialchars($_POST['message'])) . "</p>
        ";

        $mail->Body    = $messageBody;
        $mail->AltBody = strip_tags($messageBody);

        $mail->send();
        echo '<script>alert("Reservasi berhasil dikirim!"); window.location.href = "index.html";</script>';
    } catch (Exception $e) {
        echo '<script>alert("Gagal mengirim reservasi. Error: ' . str_replace("'", "\\'", $mail->ErrorInfo) . '");</script>';
    }
}
?>