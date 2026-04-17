<?php
require_once("../connection/database.php");
require_once("../emp_record.php");
$Record = new \Classes\emp_record($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Add'])) {
    $Record->AddEmployment();
    header("Location: ../emp_table.php");
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
        <h1 class="text-center mb-4">EMPLOYMENT HISTORY</h1>

        <form action="" method="POST" class="row g-3">

            <div class="col-12 mb-4">
                <label for="personId" class="form-label">Person ID</label>
                <input name="personId" id="personId" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="company" class="form-label">Company</label>
                <input name="company" id="company" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="position" class="form-label">Position</label>
                <input name="position" id="position" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="dateOfJoining" class="form-label">Date of Joining</label>
                <input name="dateOfJoining" id="dateOfJoining" required type="date" class="form-control">
            </div>


            <div class="col-12">
                <label for="dateOfExit" class="form-label">Date of Exit</label>
                <input name="dateOfExit" id="dateOfExit" required type="date" class="form-control">
            </div>

            <div class="col-12 text-center">
                <button type="submit" name="Add" class="btn btn-success px-5">Submit</button>
                <a href="../emp_table.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</body>

</html>