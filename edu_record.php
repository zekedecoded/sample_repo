<?php
namespace Classes;

require_once __DIR__ . "/connection/database.php";

class edu_record
{
    public string $field;
    private $con;
    private string $response;

    public int $personId;
    public string $elementary;
    public string $year1;
    public string $highschool;
    public string $year2;
    public string $college;
    public string $year3;
    public string $course;
    public string $skills;

    public function __construct($db)
    {
        $this->con = $db;
    }

    public function getEducation()
    {
        $stmt = $this->con->prepare('SELECT * FROM education');
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return [];
        }
        return $stmt->fetchAll();
    }

    private function getEducationPost()
    {
        $this->personId = $_POST['personId'];
        $this->elementary = $_POST['elementary'];
        $this->year1 = $_POST['year1'];
        $this->highschool = $_POST['highschool'];
        $this->year2 = $_POST['year2'];
        $this->college = $_POST['college'];
        $this->year3 = $_POST['year3'];
        $this->course = $_POST['course'];
        $this->skills = $_POST['skills'];
    }

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

            header('Location: ../edu_table.php');
            exit;
        }
    }

    public function getEducationId($eduId)
    {
        if (!$eduId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM education WHERE eduId=?');
        $stmt->execute([$eduId]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function viewEducation($eduId)
    {
        if (!$eduId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM education WHERE eduId=?');
        $stmt->execute([$eduId]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function deleteEducation($eduId)
    {
        $stmt = $this->con->prepare('DELETE FROM education WHERE eduId=?');
        $stmt->execute([$eduId]);
        return $stmt->rowCount() > 0;
    }

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
            header('Location: ../edu_table.php');
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

$record = new edu_record(@$db);