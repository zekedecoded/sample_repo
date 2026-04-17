<?php
require 'connection/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$id = $_GET['id'];
if (isset($_GET['id']) && $_GET['id'] !== '') {
    try {
        $gettemp = $db->prepare("SELECT lastName,
    firstName,
    middleName,
    suffix,
    mobile,
    email,
    province,
    city,
    barangay,
    street,
    dateOfBirth,
    gender,
    fatherName,
    languagesKnown,
    maritalStatus,
    religion,
    hobbies,
    picUpload FROM temp_person WHERE id = ?");
        $gettemp->execute([$id]);

        if ($gettemp->rowCount()) {
            foreach ($gettemp->fetchAll() as $key => $row) {

                // ---------------------------------------------------------------
                // ADDED: Duplicate check before promoting a temp record to bio_info.
                //
                // Why: When an admin clicks "Accept", the record moves from
                //      temp_person → bio_info. Without this guard, the same
                //      person could end up in bio_info twice if:
                //        - They were manually added directly AND submitted a form.
                //        - An admin clicks "Accept" more than once (double-click).
                //        - A race condition from concurrent admin sessions.
                //
                // We check BOTH email AND name+DOB so neither signal alone can
                // be bypassed by changing just one field.
                // ---------------------------------------------------------------

                // --- 1. Email duplicate check in bio_info only ---
                // (temp_person is excluded because the record we're accepting IS
                //  still sitting in temp_person at this point)
                $emailCheck = $db->prepare("SELECT id FROM bio_info WHERE email = ?");
                $emailCheck->execute([$row['email']]);

                // --- 2. Name + date-of-birth duplicate check in bio_info ---
                // ADDED: Catches the same person re-registering with a new email.
                $nameCheck = $db->prepare("
                    SELECT id FROM bio_info
                    WHERE LOWER(firstName) = LOWER(?)
                      AND LOWER(lastName)  = LOWER(?)
                      AND dateOfBirth      = ?
                ");
                $nameCheck->execute([$row['firstName'], $row['lastName'], $row['dateOfBirth']]);

                if ($emailCheck->rowCount() > 0) {
                    // ADDED: Alert admin and abort — do not move record to bio_info.
                    echo "<script>
                            alert('Cannot accept: a record with the email \"{$row['email']}\" already exists in bio_info.');
                            window.location.href = 'temp_table.php';
                          </script>";
                    exit;
                }

                if ($nameCheck->rowCount() > 0) {
                    // ADDED: Alert admin and abort — same name + DOB already accepted.
                    echo "<script>
                            alert('Cannot accept: a record for {$row['firstName']} {$row['lastName']} with the same date of birth already exists in bio_info.');
                            window.location.href = 'temp_table.php';
                          </script>";
                    exit;
                }

                $insert = $db->prepare("INSERT INTO bio_info (
    lastName,
    firstName,
    middleName,
    suffix,
    mobile,
    email,
    province,
    city,
    barangay,
    street,
    dateOfBirth,
    gender,
    fatherName,
    languagesKnown,
    maritalStatus,
    religion,
    hobbies,
    picUpload
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $insert->execute([
                    $row['lastName'],
                    $row['firstName'],
                    $row['middleName'],
                    $row['suffix'],
                    $row['mobile'],
                    $row['email'],
                    $row['province'],
                    $row['city'],
                    $row['barangay'],
                    $row['street'],
                    $row['dateOfBirth'],
                    $row['gender'],
                    $row['fatherName'],
                    $row['languagesKnown'],
                    $row['maritalStatus'],
                    $row['religion'],
                    $row['hobbies'],
                    $row['picUpload'],
                ]);

                // Delete from temp_person after successful insert
                $delete = $db->prepare("DELETE FROM temp_person WHERE id = ?");
                $delete->execute([$id]);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jasminsamson851@gmail.com';
                $mail->Password = 'fkbv wocm nsvs oxip';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('jasminsamson851@gmail.com', 'PhilSPEN 17th Annual Convention');
                $mail->addAddress($row['email']);
                $mail->isHTML(true);

                $mail->Subject = 'Registration Confirmation';
                $mail->Body = '<pre>Dear ' . ' <br><br>'
                    . 'Warm Greetings!
                       
                        We are pleased to confirm receipt of your payment for the 17th PhilSPEN Annual Convention, themed NUTRITION MEDICINE: Integrated Approach to Patient Care, to be held on November 20-21, 2025, at Novotel Manila, Araneta City.

                        Attached to this email is your unique QR code, which will serve as your entry pass to claim your convention ID and kit. It will also be used for attendance tracking throughout the event.

                        Important Reminders:
                        <li>Save your QR Code on your mobile device for easy access at the <b>Registration Table</b></li>
                        <li>Ensure the QR code is clearly visible for scanning</li>
                        <li>If you\'re unable to present the QR code digitally, bring a printed copy as backup.</li>
                        <li>Have your valid ID ready for verification of registration details.</li>

                        Should you have any concerns, feel free to reach out to us at 87230101 loc 5706 / 09338534625 or email us at philspen.sec20@gmail.com.

                        We look forward to seeing you at the convention!

                        Best regards,

                        Racquel O. Cainap-Andaya, MD
                        Head, Registration and Membership Committee
                        Philippine Society for Parenteral and Enteral Nutrition
                        </pre>';

                $mail->send();
                echo "<script>
                        alert('Email sent successfully');
                        window.location.href = 'temp_table.php';
                      </script>";
                exit;
            }
        }
    } catch (Exception $e) {
        print_r($e);
        die();
    }

    $stmt = "DELETE FROM temp_person WHERE id = ?";
    $st = $db->prepare($stmt);
    $st->execute([$id]);
    header("Location: temp_table.php");

} else {
    header("Location: index.php");
}