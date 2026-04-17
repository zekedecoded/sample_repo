<?php
require_once("../connection/database.php");
require_once("../personal_record.php");

$Record = new \Classes\personal_record($db);
$row = [];

if (isset($_GET['id'])) {
    $row = $Record->viewTemp($_GET['id']);
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
        <h1 class="text-center mb-4">Personal Data Record</h1>

        <!--NAME SECTION-->
        <form action="" method="POST" class="row g-3" enctype="multipart/form-data">

            <div class="col-12 text-center">
                <img src="<?= "../uploads/" . $row['picUpload']; ?> " class="img-fluid" style="max-width: 220px;">
            </div>

            <div class="col-12">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" value="<?= $row['lastName'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" value="<?= $row['firstName'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="middleName" class="form-label">Middle Name</label>
                <input type="text" class="form-control" value="<?= $row['middleName'] ?>" readonly>
            </div>


            <div class="mb-3">
                <label for="suffix" class="form-label">Suffix</label>
                <input type="text" class="form-control" value="<?= $row['suffix'] ?>" readonly>
            </div>


            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile No</label>
                <input type="number" class="form-control" value="<?= $row['mobile'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email ID</label>
                <input type="email" class="form-control" value="<?= $row['email'] ?>" readonly>
            </div>

            <!--ADDRESS SECTION-->
            <div class="col-12">
                <label for="province" class="form-label">Province</label>
                <input type="text" class="form-control" value="<?= $row['province'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="city" class="form-label">City/Municipality</label>
                <input type="text" class="form-control" value="<?= $row['city'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="barangay" class="form-label">Barangay</label>
                <input type="text" class="form-control" value="<?= $row['barangay'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="street" class="form-label">Street</label>
                <input type="text" class="form-control" value="<?= $row['street'] ?>" readonly>
            </div>
            <div class="col-12">
                <label for="dateOfBirth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" value="<?= $row['dateOfBirth'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" value="<?= $row['gender'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="fatherName" class="form-label">Father's Name</label>
                <input type="text" class="form-control" value="<?= $row['fatherName'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="languagesKnown" class="form-label">Languages Known</label>
                <input type="text" class="form-control" value="<?= $row['languagesKnown'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="maritalStatus" class="form-label">Marital Status</label>
                <input type="text" class="form-control" value="<?= $row['maritalStatus'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="religion" class="form-label">Religion</label>
                <input type="text" class="form-control" value="<?= $row['religion'] ?>" readonly>
            </div>

            <div class="col-12">
                <label for="hobbies" class="form-label">Hobbies</label>
                <input type="text" class="form-control" value="<?= $row['hobbies'] ?>" readonly>
            </div>

            <div class="col-12 text-center">
                <a href="../temp_table.php" class="btn btn-secondary w-100">Back</a>
            </div>

        </form>
    </div>
</body>

</html>