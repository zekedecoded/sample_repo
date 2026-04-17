<?php
require_once '../emp_record.php';


use Classes\emp_record;
$record = new emp_record($db);


if (isset($_GET['empId'])) {
    $row3 = $record->viewEmployment($_GET['empId']);
}

if (isset($_POST['updateEmployment'])) {
    $record->updateEmployment($_GET['empId']);
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
                    value="<?= $row3['personId'] ?>">
            </div>

            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <input name="company" id="company" type="text" class="form-control" value="<?= $row3['company'] ?>">
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input name="position" id="position" type="text" class="form-control" value="<?= $row3['position'] ?>">
            </div>

            <div class="mb-3">
                <label for="dateOfJoining" class="form-label">Date of Joining</label>
                <input name="dateOfJoining" id="dateOfJoining" type="date" class="form-control"
                    value="<?= $row3['dateOfJoining'] ?>">
            </div>

            <div class="mb-3">
                <label for="dateOfExit" class="form-label">Date of Exit</label>
                <input name="dateOfExit" id="dateOfExit" type="date" class="form-control"
                    value="<?= $row3['dateOfExit'] ?>">
            </div>

            <div class="col-12 text-center">
                <button type="submit" name="updateEmployment" class="btn btn-success px-5">Update</button>
                <a href="../emp_table.php" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</body>

</html>