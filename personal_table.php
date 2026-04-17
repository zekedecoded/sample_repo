<?php
require_once("connection/database.php");
require_once("personal_record.php");

use Classes\personal_record;

$Record = new personal_record($db);
$data = $Record->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' & isset($_POST['Add'])) {
    $Record->Add();
    header("Location: personal_table.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $Record->delete($_POST['delete']);
    }
    header("Location: personal_table.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>PERSONAL RECORDS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
</head>

<body>

    <div class="container my-5">
        <h1 class="text-center mb-4">PERSONAL RECORDS</h1>
        <div class="table-responsive">
            <table id="personalTable" class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Person ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Suffix</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Province</th>
                        <th>City/Municipality</th>
                        <th>Barangay</th>
                        <th>Street</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Father's Name</th>
                        <th>Languages Known</th>
                        <th>Marital Status</th>
                        <th>Religion</th>
                        <th>Hobbies</th>
                        <th>Upload</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['lastName'] ?></td>
                            <td><?= $row['firstName'] ?></td>
                            <td><?= $row['middleName'] ?></td>
                            <td><?= $row['suffix'] ?></td>
                            <td><?= $row['mobile'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['province'] ?></td>
                            <td><?= $row['city'] ?></td>
                            <td><?= $row['barangay'] ?></td>
                            <td><?= $row['street'] ?></td>
                            <td><?= $row['dateOfBirth'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['fatherName'] ?></td>
                            <td><?= $row['languagesKnown'] ?></td>
                            <td><?= $row['maritalStatus'] ?></td>
                            <td><?= $row['religion'] ?></td>
                            <td><?= $row['hobbies'] ?></td>
                            <td><?= $row['picUpload'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="includes/viewPerson.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">View</a>
                                    <a href="includes/editPerson.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form method="POST">
                                        <button type="submit" name="delete" value="<?= $row['id'] ?>"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="container my-5 d-flex gap-3">
            <a href="includes/addPerson.php" class="btn btn-primary">Add Form</a>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script>
new DataTable('#personalTable', {responsive: true});
</script>

</body>

</html>
