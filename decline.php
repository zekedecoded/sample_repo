<?php 
require './connection/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$id = $_GET['id'];
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $stmt = "SELECT email FROM temp_person WHERE id = ?";
    $st = $db->prepare($stmt);
    
    if ($st->execute([$id])) {
        $row = $st->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $stmt = "DELETE FROM temp_person WHERE id = ?";
            $st = $db->prepare($stmt);
            $st->execute([$id]);
        }
    }

                // Delete from temp_person
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jasminsamson851@gmail.com'; // gmail
                $mail->Password = 'fkbv wocm nsvs oxip'; // app password of gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('jasminsamson851@gmail.com', 'PhilSPEN 17th Annual Convention');
                $mail->addAddress($row['email']);
                $mail->isHTML(true);

                $mail->Subject = 'Registration Decline';
                $mail->Body = '<pre>Dear ' . ' <br><br>'
                    . 'Warm Greetings!
                       
                        We regret to inform you that your registration for the 17th PhilSPEN Annual Convention has been declined.

                        Should you have any concerns, feel free to reach out to us at 87230101 loc 5706 / 09338534625 or email us at philspen.sec20@gmail.com.

                        Best regards,

                        Racquel O. Cainap-Andaya, MD
                        Head, Registration and Membership Committee
                        Philippine Society for Parenteral and Enteral Nutrition
                        </pre>';

                try {
                    $mail->send();
                    echo "<script>
                            alert('Registration declined and email sent successfully');
                            window.location.href = 'temp_table.php';
                          </script>";
                } catch (Exception $e) {
                    echo "<script>
                            alert('Registration declined (note: email could not be sent)');
                            window.location.href = 'temp_table.php';
                          </script>";
                }
                exit();
    } 

    else {
    echo "Database query failed.";
}


?>