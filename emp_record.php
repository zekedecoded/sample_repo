<?php
namespace Classes;

require_once "./connection/database.php";

class emp_record
{
    public string $field;
    private $con;
    private string $response;

    public int $personId;
    public string $company;
    public string $position;
    public string $dateOfJoining;
    public string $dateOfExit;

    public function __construct($db)
    {
        $this->con = $db;
    }

    public function getEmployment()
    {
        $stmt = $this->con->prepare('SELECT * FROM employment');
        $stmt->execute();
        if (!$stmt->rowCount()) {
            return [];
        }
        return $stmt->fetchAll();
    }

    private function getEmploymentPost()
    {
        $this->personId = $_POST['personId'];
        $this->company = $_POST['company'];
        $this->position = $_POST['position'];
        $this->dateOfJoining = $_POST['dateOfJoining'];
        $this->dateOfExit = $_POST['dateOfExit'];
    }

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

            header('Location: ../emp_table.php');
            exit;
        }
    }

    public function getEmploymentId($empId)
    {
        if (!$empId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM employment WHERE empId=?');
        $stmt->execute([$empId]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function viewEmployment($empId)
    {
        if (!$empId)
            return 0;
        $stmt = $this->con->prepare('SELECT * FROM employment WHERE empId=?');
        $stmt->execute([$empId]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function deleteEmployment($empId)
    {
        $stmt = $this->con->prepare('DELETE FROM employment WHERE empId=?');
        $stmt->execute([$empId]);
        return $stmt->rowCount() > 0;
    }

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
            header('Location: ../emp_table.php');
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

$record = new emp_record(@$db);