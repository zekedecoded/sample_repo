<?php
require_once("../connection/database.php");
require_once("../edu_record.php");
$Record = new \Classes\edu_record($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Add'])) {
    $Record->AddEducation();
    header("Location: ../edu_table.php");
    exit;
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
        <h1 class="text-center mb-4">EDUCATIONAL BACKGROUND</h1>

        <form action="" method="POST" class="row g-3">

            <div class="col-12 mb-4">
                <label for="personId" class="form-label">Person ID</label>
                <input name="personId" id="personId" required type="text" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="elementary" class="form-label">Elementary</label>
                <input name="elementary" id="elementary" required type="text" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="year1" class="form-label">Year of Passing</label>
                <input name="year1" id="year1" required type="date" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="highschool" class="form-label">High School</label>
                <input name="highschool" id="highschool" required type="text" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="year2" class="form-label">Year of Passing</label>
                <input name="year2" id="year2" required type="date" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="college" class="form-label">College</label>
                <input name="college" id="college" required type="text" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="year3" class="form-label">Year of Passing</label>
                <input name="year3" id="year3" required type="date" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="course" class="form-label">Course</label>
                <input name="course" id="course" required type="text" class="form-control">
            </div>

            <div class="col-12 mb-4">
                <label for="skills" class="form-label">Skills</label>
                <input name="skills" id="skills" required type="text" class="form-control">
            </div>

            <div class="col-12 text-center">
                <button type="submit" name="Add" class="btn btn-success px-5">Submit</button>
                <a href="../edu_table.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</body>

</html>