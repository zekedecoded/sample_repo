<?php
namespace Classes;
require_once "database.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


class Record
{
    public string $field;
    private $con;
    private string $response;

    //under bio-info(personal) table

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

    //under education table
    public int $personId;
    public string $elementary;
    public string $year1;
    public string $highschool;
    public string $year2;
    public string $college;
    public string $year3;
    public string $course;
    public string $skills;

    //under employment tabl
    public string $company;
    public string $position;
    public string $dateOfJoining;
    public string $dateOfExit;

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


    //get All for education table
    public function getEducation()
    {
        $stmt = $this->con->prepare('SELECT * FROM education');
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return [];
        }
        return $stmt->fetchAll();
    }


    //get All for employment table
    public function getEmployment()
    {
        $stmt = $this->con->prepare('SELECT * FROM employment');
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return [];
        }
        return $stmt->fetchAll();
    }


    private function getPost()
    {
        $this->lastName = $_POST['lastName'] ?? '';
        $this->firstName = $_POST['firstName'] ?? '';
        $this->middleName = $_POST['middleName'] ?? '';
        $this->suffix = $_POST['suffix'] ?? '';
        $this->mobile = $_POST['mobile'] ?? '';
        $this->email = $_POST['email'] ?? '';
        $this->province = $_POST['province'] ?? '';
        $this->city = $_POST['city'] ?? '';
        $this->barangay = $_POST['barangay'] ?? '';
        $this->street = $_POST['street'] ?? '';
        $this->dateOfBirth = $_POST['dateOfBirth'] ?? '';
        $this->gender = $_POST['gender'] ?? '';
        $this->fatherName = $_POST['fatherName'] ?? '';
        $this->languagesKnown = $_POST['languagesKnown'] ?? '';
        $this->maritalStatus = $_POST['maritalStatus'] ?? '';
        $this->religion = $_POST['religion'] ?? '';
        $this->hobbies = $_POST['hobbies'] ?? '';
    }

    //for education table
    private function getEducationPost()
    {
        $this->personId = $_POST['personId'] ?? '';
        $this->elementary = $_POST['elementary'] ?? '';
        $this->year1 = $_POST['year1'] ?? '';
        $this->highschool = $_POST['highschool'] ?? '';
        $this->year2 = $_POST['year2'] ?? '';
        $this->college = $_POST['college'] ?? '';
        $this->year3 = $_POST['year3'] ?? '';
        $this->course = $_POST['course'] ?? '';
        $this->skills = $_POST['skills'] ?? '';
    }

    //for employment table
    private function getEmploymentPost()
    {
        $this->personId = $_POST['personId'] ?? '';
        $this->company = $_POST['company'] ?? '';
        $this->position = $_POST['position'] ?? '';
        $this->dateOfJoining = $_POST['dateOfJoining'] ?? '';
        $this->dateOfExit = $_POST['dateOfExit'] ?? '';
    }


    public function Add()
    {
        if (isset($_POST['Add'])) {
            $this->getPost();

            $stmt = $this->con->prepare("INSERT INTO bio_info 
                (lastName, firstName, middleName, suffix, mobile, email, province, city, barangay, street, dateOfBirth, gender, 
                fatherName, languagesKnown, maritalStatus, religion, hobbies)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

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
                $this->hobbies
            ]);

            $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jasminsamson851@gmail.com'; // gmail
                $mail->Password = 'fkbv wocm nsvs oxip'; // app password of gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('jasminsamson851@gmail.com', 'PhilSPEN 17th Annual Convention');
                $mail->addAddress($this->email);
                $mail->isHTML(true);

                $mail->Subject = 'Registration Confirmation';
                $mail->Body = '<pre>Dear ' . htmlspecialchars(strtoupper($this->firstName)) . ' ' . htmlspecialchars(strtoupper($this->middleName, )) . ' ' . htmlspecialchars(strtoupper($this->lastName, )) . ', <br><br>'
                    . 'Warm Greetings!
                       
                        We are pleased to confirm receipt of your payment for the 17th PhilSPEN Annual Convention, themed NUTRITION MEDICINE: Integrated Approach to Patient Care, to be held on November 20-21, 2025, at Novotel Manila, Araneta City.

                        Attached to this email is your unique QR code, which will serve as your entry pass to claim your convention ID and kit. It will also be used for attendance tracking throughout the event.

                        Important Reminders:
                        <li>Save your QR Code on your mobile device for easy access at the <b>Registration Table</b></li>
                        <li>Ensure the QR code is clearly visible for scanning</li>
                        <li>If you’re unable to present the QR code digitally, bring a printed copy as backup.</li>
                        <li>Have your valid ID ready for verification of registration details.</li>

                        Should you have any concerns, feel free to reach out to us at 87230101 loc 5706 / 09338534625 or email us at philspen.sec20@gmail.com.

                        We look forward to seeing you at the convention!

                        Best regards,

                        Racquel O. Cainap-Andaya, MD
                        Head, Registration and Membership Committee
                        Philippine Society for Parenteral and Enteral Nutrition
                        </pre>';

                // $mail->addAttachment("../events/qr/$row[qr_event]");
                // $qrFile = realpath(__DIR__ . '/../events/qr/' . basename($row['qr_event']));
                // if ($qrFile && file_exists($qrFile)) {
                //     $mail->addAttachment($qrFile);
                // }


            $mail->send();
            $this->responseSQL($stmt);

            header('Location: index2.php');
            exit;
        }
    }

    //FOR EDUCATION
    public function AddEducation()
    {
        if (isset($_POST['Add'])) {
            $this->getEducationPost();

            $stmt = $this->con->prepare("INSERT INTO education 
                (personId, elementary, year1, highschool, year2, college, year3, course, skills)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $this->personId,
                $this->elementary,
                $this->year1,
                $this->highschool,
                $this->year2,
                $this->college,
                $this->year3,
                $this->course,
                $this->skills
            ]);

            $this->responseSQL($stmt);

            header('Location: index2.php');
            exit;
        }
    }

    //FOR EMPLOYMENT
    public function AddEmployment()
    {
        if (isset($_POST['Add'])) {
            $this->getEmploymentPost();

            $stmt = $this->con->prepare("INSERT INTO employment 
                (personId, company, position, dateOfJoining, dateOfExit)
                VALUES (?, ?, ?, ?, ?)");

            $stmt->execute([
                $this->personId,
                $this->company,
                $this->position,
                $this->dateOfJoining,
                $this->dateOfExit
            ]);

            $this->responseSQL($stmt);

            header('Location: index2.php');
            exit;
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

    //FOR EDUCATION
    public function getEducationId($eduId)
    {
        if (!$eduId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM education WHERE eduId=?');
        $stmt->execute([$eduId]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    //FOR EMPLOYMENT
    public function getEmploymentId($empId)
    {
        if (!$empId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM employment WHERE empId=?');
        $stmt->execute([$empId]);
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

    //FOR EDUCATION
    public function viewEducation($eduId)
    {
        if (!$eduId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM education WHERE eduId=?');
        $stmt->execute([$eduId]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    //FOR EMPLOYMENT
    public function viewEmployment($empId)
    {
        if (!$empId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM employment WHERE empId=?');
        $stmt->execute([$empId]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }


    public function delete($id)
    {
        $stmt = $this->con->prepare('DELETE FROM bio_info WHERE id=?');
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    //FOR EDUCATION
    public function deleteEducation($eduId)
    {
        $stmt = $this->con->prepare('DELETE FROM education WHERE eduId=?');
        $stmt->execute([$eduId]);
        return $stmt->rowCount() > 0;
    }

    //FOR EMPLOYMENT
    public function deleteEmployment($empId)
    {
        $stmt = $this->con->prepare('DELETE FROM employment WHERE empId=?');
        $stmt->execute([$empId]);
        return $stmt->rowCount() > 0;
    }


    public function update($id)
    {
        $this->getPost();
        if (!empty($_POST)) {
            $stmt = $this->con->prepare('UPDATE bio_info SET lastName = ?, firstName = ?, middleName = ?, suffix = ?, mobile = ?, email = ?, province = ?, city = ?, barangay = ?, street = ?, dateOfBirth = ?, gender = ?, 
                fatherName = ?, languagesKnown = ?, maritalStatus = ?, religion = ?, hobbies = ? WHERE id = ?');
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
                $id
            ]);
            $this->responseSQL($stmt);
            header('Location: index2.php');
        }
    }


    //FOR EDUCATION    
    public function updateEducation($eduId)
    {
        $this->getEducationPost();
        if (!empty($_POST)) {
            $stmt = $this->con->prepare('UPDATE education SET personId = ?, elementary = ?, year1 = ?, highschool = ?, year2 = ?, college = ?, year3 = ?, course = ?, skills = ? WHERE eduId = ?');
            $stmt->execute([
                $this->personId,
                $this->elementary,
                $this->year1,
                $this->highschool,
                $this->year2,
                $this->college,
                $this->year3,
                $this->course,
                $this->skills,
                $eduId
            ]);
            $this->responseSQL($stmt);
            header('Location: index2.php');
        }
    }


    //FOR EMPLOYMENT    
    public function updateEmployment($empId)
    {
        $this->getEmploymentPost();
        if (!empty($_POST)) {
            $stmt = $this->con->prepare('UPDATE employment SET personId = ?, company = ?, position = ?, dateOfJoining = ?, dateOfExit = ? WHERE empId = ?');
            $stmt->execute([
                $this->personId,
                $this->company,
                $this->position,
                $this->dateOfJoining,
                $this->dateOfExit,
                $empId
            ]);
            $this->responseSQL($stmt);
            header('Location: index2.php');
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

$record = new Record(@$db);