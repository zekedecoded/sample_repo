<?php
require_once("../connection/database.php");
require_once("../personal_record.php");
$Record = new \Classes\personal_record($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Add'])) {
    $Record->Add();
    header("Location: ../personal_table.php");
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
        <h1 class="text-center mb-4">BIO-DATA</h1>

        <!--NAME SECTION-->
        <form action="" method="POST" class="row g-3" enctype="multipart/form-data" onsubmit="let btn = document.querySelector('button[type=submit]'); setTimeout(() => {btn.disabled=true; btn.innerText='Submitting...';}, 0);">

            <div class="col-12">
                <label for="picUpload" class="form-label">Photo Upload</label>
                <input name="picUpload" id="picUpload" required type="file" class="form-control">
            </div>

            <div class="col-12">
                <label for="lastName" class="form-label">Last Name</label>
                <input name="lastName" id="lastName" required type="text" placeholder="ex. Santos" class="form-control">
            </div>

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input name="firstName" id="firstName" required type="text" placeholder="ex. Mia" class="form-control">
            </div>

            <div class="mb-3">
                <label for="middleName" class="form-label">Middle Name</label>
                <input name="middleName" id="middleName" required type="text" placeholder="ex. Dela Cruz"
                    class="form-control">
            </div>


            <div class="mb-3">
                <label for="suffix" class="form-label">Suffix</label>
                <input name="suffix" id="suffix" type="text" placeholder="ex. Jr." class="form-control">
            </div>


            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile No</label>
                <input name="mobile" id="mobile" required type="number" placeholder="ex. 09550550550"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email ID</label>
                <input name="email" id="email" required type="email" placeholder="ex. username@gmail.com"
                    class="form-control">
            </div>

            <!--ADDRESS SECTION-->
            <div class="col-12">
                <label for="province" class="form-label">Province</label>
                <input name="province" id="province" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="city" class="form-label">City/Municipality</label>
                <input name="city" id="city" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="barangay" class="form-label">Barangay</label>
                <input name="barangay" id="barangay" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="street" class="form-label">Street</label>
                <input name="street" id="street" required type="text" class="form-control">
            </div>
            <div class="col-12">
                <label for="dateOfBirth" class="form-label">Date of Birth</label>
                <input name="dateOfBirth" id="dateOfBirth" required type="date" class="form-control">
            </div>

            <div class="col-12">
                <label for="gender" class="form-label">Gender</label>
                <input name="gender" id="gender" required class="form-control">
            </div>

            <div class="col-12">
                <label for="fatherName" class="form-label">Father's Name</label>
                <input name="fatherName" id="fatherName" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="languagesKnown" class="form-label">Languages Known</label>
                <input name="languagesKnown" id="languagesKnown" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="maritalStatus" class="form-label">Marital Status</label>
                <input name="maritalStatus" id="maritalStatus" required class="form-control">
            </div>

            <div class="col-12">
                <label for="religion" class="form-label">Religion</label>
                <input name="religion" id="religion" required type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="hobbies" class="form-label">Hobbies</label>
                <input name="hobbies" id="hobbies" required type="text" class="form-control">
            </div>

            <div class="col-12 text-center">
                <button type="submit" name="Add" class="btn btn-success px-5">Submit</button>
                <a href="../personal_table.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</body>

</html>