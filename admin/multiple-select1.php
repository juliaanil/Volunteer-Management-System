<?php
// ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');
ob_implicit_flush(true);


require "class/db.php";

// require 'C:\xampp\htdocs\admin\PHPMailer-master\PHPMailerAutoload.php';

require 'C:\xampp\htdocs\admin\PHPMailer-master\COMMITMENT';
session_start();


  

if (!isset($_SESSION['aemail'])) {
   
    header("location: login.php");
}

$value = $_GET['item'];
$extract_id = explode(',' ,($_GET['checked']));

if($value=="delete")
{
    foreach($extract_id as $key=>$id)
    {
    $sql = "Delete from tbl_program where pid=$id";
    $db->query($sql);
    }
}
else if ($value == "approved") { foreach ($extract_id as $key => $id) {
    echo $sql = "UPDATE tbl_organization SET ostatus = 'approved' WHERE oid = $id";
    $db->query($sql);

    ini_set('SMTP', 'smtp.office365.com');
    ini_set('smtp_port', 587);

    $emailSql = "SELECT oemail FROM tbl_organization WHERE oid = $id";
    $result30 = $db->query($emailSql);

    if ($result30->num_rows > 0) {
        echo "Approved\n";
        $row = $result30->fetch_assoc();
        $toEmail = $row['oemail'];
        $subject = "Registration Approved";
        $message = "Your registration is successful. You can now login to our application using your email id and password.";
        $headers = "From: vmsapplication@outlook.com\r\n"
            . "Content-Type: text/html; charset=UTF-8\r\n"
            . "MIME-Version: 1.0\r\n"
            . "Content-Transfer-Encoding: 8bit\r\n"
            . "X-Mailer: PHP\r\n"
            . "smtp_crypto: tls\r\n";

        $smtpServer = 'smtp.office365.com';
        $smtpPort = 587;
        $smtpSocket = fsockopen($smtpServer, $smtpPort, $errno, $errstr, 30);
// Set the SSL context options
$sslContextOptions = array(
    'ssl' => array(
        'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT, // Use TLS version 1.2
        'verify_peer' => false, // Disable peer certificate verification (for testing purposes only)
        'verify_peer_name' => false, // Disable peer name verification (for testing purposes only)
    ),
);

// Set the SSL context options for the stream
stream_context_set_option($smtpSocket, $sslContextOptions);

        if ($smtpSocket) {
            stream_socket_enable_crypto($smtpSocket, true, STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT); // Use TLS version 1.2
          
           

            // Send email using the SMTP socket
            fputs($smtpSocket, "HELO $smtpServer\r\n");
            fputs($smtpSocket, "STARTTLS\r\n"); // Enable STARTTLS encryption
            fputs($smtpSocket, "HELO $smtpServer\r\n"); // Greet the server again after enabling encryption
            fputs($smtpSocket, "MAIL FROM: vmsapplication@outlook.com\r\n");
            fputs($smtpSocket, "RCPT TO: $toEmail\r\n");
            fputs($smtpSocket, "DATA\r\n");
            fputs($smtpSocket, "Subject: $subject\r\n");
            fputs($smtpSocket, "$headers\r\n");
            fputs($smtpSocket, "$message\r\n");
            fputs($smtpSocket, ".\r\n");
            fputs($smtpSocket, "QUIT\r\n");

            // Check SMTP response
            $smtpResponse = "";
            while ($str = fgets($smtpSocket, 4096)) {
                $smtpResponse .= $str;
            }

            // Close the SMTP socket
            fclose($smtpSocket);

            if (strpos($smtpResponse, "250") === 0) {
                // Email sent successfully
                echo "Email sent to: " . $toEmail . "\n";
            } else {
                // Error sending email
                echo "Failed to send email to: " . $toEmail . "\n";
            }
        } else {
            // Error establishing SMTP connection
            echo "Failed to establish SMTP connection\n";
        }
    }
}
}
else if($value=="rejected")
{
    foreach($extract_id as $key=>$id)
    {
        $sql = "Update tbl_organization set ostatus='rejected' where oid=$id";
    $db->query($sql);
    }
}

header("location: organizationappl.php");

?>