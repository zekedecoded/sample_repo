<?php
require_once("connection/database.php");
require_once("edu_record.php");

use Classes\edu_record;

$Record = new edu_record($db);
$educationData = $Record->getEducation();

if ($_SERVER['REQUEST_METHOD'] === 'POST' & isset($_POST['Add'])) {
    $Record->AddEducation();
    header("Location: edu_table.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteEdu'])) {
        $Record->deleteEducation($_POST['deleteEdu']);
    }
    header("Location: edu_table.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>EDUCATIONAL RECORDS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
</head>

<body>

    <div class="container my-5">
        <h1 class="text-center mb-4">EDUCATIONAL RECORDS</h1>
        <div class="table-responsive">
            <table id="eduTable" class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Education ID</th>
                        <th>Person ID</th>
                        <th>Elementary</th>
                        <th>Year of Passing</th>
                        <th>High School</th>
                        <th>Year of Passing</th>
                        <th>College</th>
                        <th>Year of Passing</th>
                        <th>Course</th>
                        <th>Skills</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($educationData as $row2) { ?>
                        <tr>
                            <td><?= $row2['eduId'] ?></td>
                            <td><?= $row2['personId'] ?></td>
                            <td><?= $row2['elementary'] ?></td>
                            <td><?= $row2['year1'] ?></td>
                            <td><?= $row2['highschool'] ?></td>
                            <td><?= $row2['year2'] ?></td>
                            <td><?= $row2['college'] ?></td>
                            <td><?= $row2['year3'] ?></td>
                            <td><?= $row2['course'] ?></td>
                            <td><?= $row2['skills'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="includes/viewEducation.php?eduId=<?= $row2['eduId'] ?>" class="btn btn-primary btn-sm">View</a>
                                    <a href="includes/editEducation.php?eduId=<?= $row2['eduId'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form method="POST"> 
                                        <button type="submit" name="deleteEdu" value="<?= $row2['eduId'] ?>" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="container my-5 d-flex gap-3">
            <a href="includes/addEducation.php" class="btn btn-primary">Add Form</a>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script>
new DataTable('#eduTable', {responsive: true});
</script>

</body>

</html>
