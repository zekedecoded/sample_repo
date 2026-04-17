<?php
require_once("connection/database.php");
require_once("emp_record.php");

use Classes\emp_record;

$Record = new emp_record($db);
$employmentData = $Record->getEmployment();

if ($_SERVER['REQUEST_METHOD'] === 'POST' & isset($_POST['Add'])) {
    $Record->AddEmployment();
    header("Location: emp_table.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteEmp'])) {
        $Record->deleteEmployment($_POST['deleteEmp']);
    }
    header("Location: emp_table.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>EMPLOYMENT HISTORY RECORDS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
</head>

<body>

<div class="container my-5">
    <h1 class="text-center mb-4">EMPLOYMENT RECORDS</h1>
    <div class="table-responsive">
        <table id="empTable" class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Employment ID</th>
                    <th>Person ID</th>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Date of Joining</th>
                    <th>Date of Exit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employmentData as $row3) { ?>
                    <tr>
                        <td><?= $row3['empId'] ?></td>
                        <td><?= $row3['personId'] ?></td>
                        <td><?= $row3['company'] ?></td>
                        <td><?= $row3['position'] ?></td>
                        <td><?= $row3['dateOfJoining'] ?></td>
                        <td><?= $row3['dateOfExit'] ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="includes/viewEmployment.php?empId=<?= $row3['empId'] ?>" class="btn btn-primary btn-sm">View</a>
                                <a href="includes/editEmployment.php?empId=<?= $row3['empId'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST"> <button type="submit" name="deleteEmp" value="<?= $row3['empId'] ?>"
                                        class="btn btn-danger btn-sm">Delete</button> </form>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

        <div class="container my-5 d-flex gap-3">
            <a href="includes/addEmployment.php" class="btn btn-primary">Add Form</a>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script>
new DataTable('#empTable', {responsive: true});
</script>

</body>

</html>
