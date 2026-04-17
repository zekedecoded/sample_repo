<?php
require_once("../connection/database.php");
require_once("../emp_record.php");

$Record = new \Classes\emp_record($db);
$row3 = [];

if (isset($_GET['empId'])) {
    $row3 = $Record->viewEmployment($_GET['empId']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>BIODATA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Employment History Record</h1>

        <!--NAME SECTION-->
        <form action="" method="POST" class="row g-3">
            <div class="col-12">
                <label for="personId" class="form-label">Person ID</label>
                <input type="number" class="form-control" value="<?= $row3['personId'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <input type="text" class="form-control" value="<?= $row3['company'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" value="<?= $row3['position'] ?>" readonly>
            </div>


            <div class="mb-3">
                <label for="dateOfJoining" class="form-label">Date of Joining</label>
                <input type="date" class="form-control" value="<?= $row3['dateOfJoining'] ?>" readonly>
            </div>


            <div class="mb-3">
                <label for="dateOfExit" class="form-label">Date of Exit</label>
                <input type="date" class="form-control" value="<?= $row3['dateOfExit'] ?>" readonly>
            </div>

            <div class="col-12 text-center">
                <a href="../emp_table.php" class="btn btn-secondary w-100">Back</a>
            </div>

        </form>
    </div>
</body>

</html>