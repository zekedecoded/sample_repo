<?php
require_once '../edu_record.php';

use Classes\edu_record;
$record = new edu_record($db);


if (isset($_GET['eduId'])) {
    $row2 = $record->viewEducation($_GET['eduId']);
}

if (isset($_POST['updateEducation'])) {
    $record->updateEducation($_GET['eduId']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>View Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Update Record</h1>
        <form action="" method="POST" class="row g-3">

            <div class="mb-3">
                <label for="personId" class="form-label">Person ID</label>
                <input name="personId" id="personId" type="number" class="form-control"
                    value="<?= $row2['personId'] ?>">
            </div>

            <div class="mb-3">
                <label for="elementary" class="form-label">High School</label>
                <input name="elementary" id="elementary" type="text" class="form-control"
                    value="<?= $row2['elementary'] ?>">
            </div>

            <div class="mb-3">
                <label for="year1" class="form-label">Graduation Date</label>
                <input name="year1" id="year1" type="date" class="form-control" value="<?= $row2['year1'] ?>">
            </div>

            <div class="mb-3">
                <label for="highschool" class="form-label">High School</label>
                <input name="highschool" id="highschool" type="text" class="form-control"
                    value="<?= $row2['highschool'] ?>">
            </div>

            <div class="mb-3">
                <label for="year2" class="form-label">Graduation Date</label>
                <input name="year2" id="year2" type="date" class="form-control" value="<?= $row2['year2'] ?>">
            </div>

            <div class="mb-3">
                <label for="college" class="form-label">College</label>
                <input name="college" id="college" type="text" class="form-control" value="<?= $row2['college'] ?>">
            </div>

            <div class="mb-3">
                <label for="year3" class="form-label">Graduation Year</label>
                <input name="year3" id="year3" type="date" class="form-control" value="<?= $row2['year3'] ?>">
            </div>

            <div class="col-12">
                <label for="course" class="form-label">Course</label>
                <input name="course" id="course" type="text" class="form-control" value="<?= $row2['course'] ?>">
            </div>
            <div class="col-12">
                <label for="skills" class="form-label">Skills</label>
                <input name="skills" id="skills" type="text" class="form-control" value="<?= $row2['skills'] ?>">
            </div>

            <div class="col-12 text-center">
                <button type="update" name="updateEducation" class="btn btn-success px-5">Update</button>
                <a href="../edu_table.php" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</body>

</html>