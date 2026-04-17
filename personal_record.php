<?php
namespace Classes;
use Classes\fileUpload;

require_once "connection/database.php";
require_once "fileUpload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

class personal_record
{
    public string $field;
    private $con;
    private string $response;

    public string $lastName;
    public string $firstName;
    public string $middleName;
    public string $suffix;
    public int $mobile;
    public string $email;
    public string $province;
    public string $city;
    public string $barangay;
    public string $street;
    public string $dateOfBirth;
    public string $gender;
    public string $fatherName;
    public string $languagesKnown;
    public string $maritalStatus;
    public string $religion;
    public string $hobbies;
    public string $picUpload;

    public function __construct($db)
    {
        $this->con = $db;
    }

    public function getAll()
    {
        $stmt = $this->con->prepare('SELECT * FROM bio_info');
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return [];
        }
        return $stmt->fetchAll();
    }

    public function getAllTemp()
    {
        $stmt = $this->con->prepare('SELECT * FROM temp_person');
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return [];
        }
        return $stmt->fetchAll();
    }

    private function getPost()
    {
        $this->lastName = $_POST['lastName'];
        $this->firstName = $_POST['firstName'];
        $this->middleName = $_POST['middleName'];
        $this->suffix = $_POST['suffix'];
        $this->mobile = $_POST['mobile'];
        $this->email = $_POST['email'];
        $this->province = $_POST['province'];
        $this->city = $_POST['city'];
        $this->barangay = $_POST['barangay'];
        $this->street = $_POST['street'];
        $this->dateOfBirth = $_POST['dateOfBirth'];
        $this->gender = $_POST['gender'];
        $this->fatherName = $_POST['fatherName'];
        $this->languagesKnown = $_POST['languagesKnown'];
        $this->maritalStatus = $_POST['maritalStatus'];
        $this->religion = $_POST['religion'];
        $this->hobbies = $_POST['hobbies'];
    }

    // -----------------------------------------------------------------------
    // ADDED: Centralized duplicate-check helper.
    //
    // Why: Previously, the only duplicate guard was an email check inside
    //      Add(), which means the same person could slip through if they used
    //      a different email but identical personal details. This helper now
    //      covers TWO independent signals:
    //
    //   1. Email uniqueness  – checked across both bio_info AND temp_person
    //      so a pending (temp) record is treated as already taken.
    //
    //   2. Full-name + date-of-birth uniqueness – catches cases where the
    //      same person resubmits with a different email address.
    //
    // Returns an array of human-readable error messages, or an empty array
    // when no duplicates are found.
    // -----------------------------------------------------------------------
    private function findDuplicates(string $email, string $firstName, string $lastName, string $dateOfBirth, ?int $excludeId = null): array
    {
        $errors = [];

        // --- 1. Email duplicate check (bio_info + temp_person) ---
        // CHANGED: was a single inline query in Add(); now reused by update() too.
        $emailSql = "
            SELECT 'bio_info' AS src, id FROM bio_info    WHERE email = ? " . ($excludeId ? "AND id <> ?" : "") . "
            UNION
            SELECT 'temp_person' AS src, id FROM temp_person WHERE email = ? " . ($excludeId ? "AND id <> ?" : "");

        $emailParams = $excludeId
            ? [$email, $excludeId, $email, $excludeId]
            : [$email, $email];

        $emailStmt = $this->con->prepare($emailSql);
        $emailStmt->execute($emailParams);

        if ($emailStmt->rowCount() > 0) {
            $errors[] = "A record with the email <b>{$email}</b> already exists.";
        }

        // --- 2. Name + date-of-birth duplicate check (bio_info + temp_person) ---
        // ADDED: Prevents the same person from registering again with a
        //        different email address.
        $nameSql = "
            SELECT 'bio_info' AS src, id FROM bio_info
                WHERE LOWER(firstName) = LOWER(?) AND LOWER(lastName) = LOWER(?) AND dateOfBirth = ?
                " . ($excludeId ? "AND id <> ?" : "") . "
            UNION
            SELECT 'temp_person' AS src, id FROM temp_person
                WHERE LOWER(firstName) = LOWER(?) AND LOWER(lastName) = LOWER(?) AND dateOfBirth = ?
                " . ($excludeId ? "AND id <> ?" : "");

        $nameParams = $excludeId
            ? [$firstName, $lastName, $dateOfBirth, $excludeId, $firstName, $lastName, $dateOfBirth, $excludeId]
            : [$firstName, $lastName, $dateOfBirth, $firstName, $lastName, $dateOfBirth];

        $nameStmt = $this->con->prepare($nameSql);
        $nameStmt->execute($nameParams);

        if ($nameStmt->rowCount() > 0) {
            $errors[] = "A record for <b>{$firstName} {$lastName}</b> with the same date of birth already exists.";
        }

        return $errors;
    }

    public function Add()
    {
        if (isset($_POST['Add'])) {
            $this->getPost();

            // CHANGED: Replaced the old single-field email check with the new
            //          centralized findDuplicates() helper that checks both
            //          email and name+DOB across bio_info and temp_person.
            $duplicateErrors = $this->findDuplicates(
                $this->email,
                $this->firstName,
                $this->lastName,
                $this->dateOfBirth
            );

            if (!empty($duplicateErrors)) {
                $errorMsg = addslashes(strip_tags(implode('\n', $duplicateErrors)));
                echo "<script>alert('Duplicate record found:\\n{$errorMsg}'); window.history.back();</script>";
                exit;
            }

            $uploads = new fileUpload($_FILES['picUpload'], __DIR__ . '/uploads/');
            $picUpload = $uploads->fileName;
            if ($uploads->upload()) {

                $stmt = $this->con->prepare("INSERT INTO temp_person 
                (lastName, firstName, middleName, suffix, mobile, email, province, city, barangay, street, dateOfBirth, gender, 
                fatherName, languagesKnown, maritalStatus, religion, hobbies, picUpload)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute([
                    $this->lastName,
                    $this->firstName,
                    $this->middleName,
                    $this->suffix,
                    $this->mobile,
                    $this->email,
                    $this->province,
                    $this->city,
                    $this->barangay,
                    $this->street,
                    $this->dateOfBirth,
                    $this->gender,
                    $this->fatherName,
                    $this->languagesKnown,
                    $this->maritalStatus,
                    $this->religion,
                    $this->hobbies,
                    $picUpload
                ]);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jasminsamson851@gmail.com';
                $mail->Password = 'fkbv wocm nsvs oxip';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('jasminsamson851@gmail.com', 'PhilSPEN 17th Annual Convention');
                $mail->addAddress($this->email);
                $mail->isHTML(true);
                $mail->Subject = 'Email Added Successfully!';
                $mail->Body = '<pre>Dear ' . htmlspecialchars(strtoupper($this->firstName)) . ' ' . htmlspecialchars(strtoupper($this->middleName)) . ' ' . htmlspecialchars(strtoupper($this->lastName)) . ', <br><br>'
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

                try {
                    $mail->send();
                } catch (Exception $e) {
                    // Ignore mail failures to continue adding temp function
                }
                $this->responseSQL($stmt);
                header('Location: ../personal_table.php');
                exit;
            } else {
                print_r($uploads->response);
            }
        }
    }

    public function getNewsUpdates($id)
    {
        if ($id === null || $id === '')
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM bio_info WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function view($id)
    {
        if ($id === null || $id === '')
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM bio_info WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function viewTemp($id)
    {
        if ($id === null || $id === '')
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM temp_person WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function delete($id)
    {
        $stmt = $this->con->prepare('DELETE FROM bio_info WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function deleteTemp($id)
    {
        $stmt = $this->con->prepare('DELETE FROM temp_person WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function update($id)
    {
        if (!empty($_POST)) {
            $this->getPost();

            // ADDED: Duplicate check during updates.
            //
            // Why: The original update() had NO duplicate guard at all — an
            //      admin could accidentally change a record's email or name to
            //      one that already exists in the database.
            //
            //      We pass $excludeId so the record being edited is ignored
            //      when searching for conflicts (otherwise it would always
            //      flag itself as a duplicate).
            $duplicateErrors = $this->findDuplicates(
                $this->email,
                $this->firstName,
                $this->lastName,
                $this->dateOfBirth,
                (int) $id          // exclude the current record from the check
            );

            if (!empty($duplicateErrors)) {
                $errorMsg = addslashes(strip_tags(implode('\n', $duplicateErrors)));
                echo "<script>alert('Cannot update — duplicate record found:\\n{$errorMsg}'); window.history.back();</script>";
                exit;
            }

            if ($_FILES['picUpload']['name']) {
                $uploads = new fileUpload($_FILES['picUpload'], __DIR__ . '/uploads/');
                $picUpload = $uploads->fileName;
                if ($uploads->upload()) {
                    $stmt = $this->con->prepare('UPDATE bio_info SET lastName = ?, firstName = ?, middleName = ?, suffix = ?, mobile = ?, email = ?, province = ?, city = ?, barangay = ?, street = ?, dateOfBirth = ?, gender = ?, 
                fatherName = ?, languagesKnown = ?, maritalStatus = ?, religion = ?, hobbies = ?, picUpload = ? WHERE id = ?');
                    $stmt->execute([
                        $this->lastName,
                        $this->firstName,
                        $this->middleName,
                        $this->suffix,
                        $this->mobile,
                        $this->email,
                        $this->province,
                        $this->city,
                        $this->barangay,
                        $this->street,
                        $this->dateOfBirth,
                        $this->gender,
                        $this->fatherName,
                        $this->languagesKnown,
                        $this->maritalStatus,
                        $this->religion,
                        $this->hobbies,
                        $picUpload,
                        $id
                    ]);
                    $this->responseSQL($stmt);
                    header('Location: ../personal_table.php');
                }
            }
        }
    }

    public function responseSQL($stmt)
    {
        if ($stmt->rowCount()) {
            $this->response = 'success';
        } else {
            $this->response = 'failed';
        }
    }

    public function getResponse()
    {
        return $this->response;
    }
}

$record = new personal_record(@$db);