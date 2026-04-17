<?php
require_once '../personal_record.php';


if (isset($_GET['id'])) {
    $row = $record->view($_GET['id']);
}

if (isset($_POST['update'])) {
    $record->update($_GET['id']);
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

        <form action="" method="POST" class="row g-3" enctype="multipart/form-data">

            <div class="col-12">
                <label for="picUpload" class="form-label">Photo Upload</label>
                <input name="picUpload" id="picUpload" required type="file" class="form-control">
            </div>

            <div class="col-12">
                <label for="lastName" class="form-label">Last Name</label>
                <input name="lastName" type="text" class="form-control" value="<?= $row['lastName'] ?>">
            </div>

            <div class="col-12">
                <label for="firstName" class="form-label">First Name</label>
                <input name="firstName" id="firstName" type="text" class="form-control"
                    value="<?= $row['firstName'] ?>">
            </div>

            <div class="col-12">
                <label for="middleName" class="form-label">Middle Name</label>
                <input name="middleName" id="middleName" type="text" class="form-control"
                    value="<?= $row['middleName'] ?>">
            </div>

            <div class="col-12">
                <label for="suffix" class="form-label">Suffix</label>
                <input name="suffix" id="suffix" type="text" class="form-control" value="<?= $row['suffix'] ?>">
            </div>

            <div class="col-12">
                <label for="mobile" class="form-label">Mobile No</label>
                <input name="mobile" id="mobile" type="number" class="form-control" value="<?= $row['mobile'] ?>">
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email ID</label>
                <input name="email" id="email" type="email" class="form-control" value="<?= $row['email'] ?>">
            </div>

            <!-- Address Section -->
            <div class="col-12">
                <label for="province" class="form-label">Province</label>
                <input name="province" id="province" type="text" class="form-control" value="<?= $row['province'] ?>">
            </div>

            <div class="col-12">
                <label for="city" class="form-label">City/Municipality</label>
                <input name="city" id="city" type="text" class="form-control" value="<?= $row['city'] ?>">
            </div>

            <div class="col-12">
                <label for="barangay" class="form-label">Barangay</label>
                <input name="barangay" id="barangay" type="text" class="form-control" value="<?= $row['barangay'] ?>">
            </div>

            <div class="col-12">
                <label for="street" class="form-label">Street</label>
                <input name="street" id="street" type="text" class="form-control" value="<?= $row['street'] ?>">
            </div>

            <div class="col-12">
                <label for="dateOfBirth" class="form-label">Date of Birth</label>
                <input name="dateOfBirth" id="dateOfBirth" type="date" class="form-control"
                    value="<?= $row['dateOfBirth'] ?>">
            </div>

            <div class="col-12">
                <label for="gender" class="form-label">Gender</label>
                <input name="gender" id="gender" type="text" class="form-control" value="<?= $row['gender'] ?>">
            </div>

            <div class="col-12">
                <label for="fatherName" class="form-label">Father's Name</label>
                <input name="fatherName" id="fatherName" type="text" class="form-control"
                    value="<?= $row['fatherName'] ?>">
            </div>

            <div class="col-12">
                <label for="languagesKnown" class="form-label">Languages Known</label>
                <input name="languagesKnown" id="languagesKnown" type="text" class="form-control"
                    value="<?= $row['languagesKnown'] ?>">
            </div>

            <div class="col-12">
                <label for="maritalStatus" class="form-label">Marital Status</label>
                <input name="maritalStatus" id="maritalStatus" type="text" class="form-control"
                    value="<?= $row['maritalStatus'] ?>">
            </div>

            <div class="col-12">
                <label for="religion" class="form-label">Religion</label>
                <input name="religion" id="religion" type="text" class="form-control" value="<?= $row['religion'] ?>">
            </div>

            <div class="col-12">
                <label for="hobbies" class="form-label">Hobbies</label>
                <input name="hobbies" id="hobbies" type="text" class="form-control" value="<?= $row['hobbies'] ?>">
            </div>

            <div class="col-12 text-center">
                <button type="submit" name="update" class="btn btn-success px-5">Update</button>
                <a href="../personal_table.php" class="btn btn-secondary">Back</a>
            </div>

        </form>
    </div>
</body>

</html>