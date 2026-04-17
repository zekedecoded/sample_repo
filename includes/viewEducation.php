<?php
require_once("../connection/database.php");
require_once("../edu_record.php");

$Record = new \Classes\edu_record($db);
$row2 = [];

if (isset($_GET['eduId'])) {
    $row2 = $Record->viewEducation($_GET['eduId']);
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
        <h1 class="text-center mb-4">Educational Background Record</h1>

        <!--NAME SECTION-->
        <form action="" method="POST" class="row g-3">
            <div class="col-12">
                <label for="personId" class="form-label">Person ID</label>
                <input type="number" class="form-control" value="<?= $row2['personId'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="elementary" class="form-label">Elementary</label>
                <input type="text" class="form-control" value="<?= $row2['elementary'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="year1" class="form-label">Graduation Date</label>
                <input type="date" class="form-control" value="<?= $row2['year1'] ?>" readonly>
            </div>


            <div class="mb-3">
                <label for="highschool" class="form-label">High School</label>
                <input type="text" class="form-control" value="<?= $row2['highschool'] ?>" readonly>
            </div>


            <div class="mb-3">
                <label for="year2" class="form-label">Graduation Date</label>
                <input type="date" class="form-control" value="<?= $row2['year2'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="college" class="form-label">College</label>
                <input type="text" class="form-control" value="<?= $row2['college'] ?>" readonly>
            </div>

            <!--ADDRESS SECTION-->
            <div class="col-12">
                <label for="year3" class="form-label">Graduation Date</label>
                <input type="date" class="form-control" value="<?= $row2['year3'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" value="<?= $row2['course'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="skills" class="form-label">Skills</label>
                <input type="text" class="form-control" value="<?= $row2['skills'] ?>" readonly>
            </div>

            <div class="col-12 text-center">
                <a href="../edu_table.php" class="btn btn-secondary w-100">Back</a>
            </div>

        </form>
    </div>
</body>

</html>