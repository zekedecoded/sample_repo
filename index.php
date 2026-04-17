<?php
// Main landing page previously index2.php
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Records Dashboard</h1>

        <div class="d-flex justify-content-center mb-4">
            <a href="personal_table.php" class="btn btn-primary mx-2">Personal Records</a>
            <a href="edu_table.php" class="btn btn-success mx-2">Education Records</a>
            <a href="emp_table.php" class="btn btn-warning mx-2">Employment Records</a>
            <a href="temp_table.php" class="btn btn-dark mx-2">Temporary Records</a>
            <a href="temp_table.php" class="btn btn-dark mx-2"> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Earum esse blanditiis fugiat perferendis, vero enim iusto maxime perspiciatis odit, minima inventore fuga, tempore libero. Voluptatibus id ipsam provident sed rem.</a>
        </div>

        <div id="personal" class="record-section d-none"></div>
        <div id="education" class="record-section d-none"></div>
        <div id="employment" class="record-section d-none"></div>
        <div id="temp" class="record-section d-none"></div>

    </div>
</body>

</html>