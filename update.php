<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    body {
        background-color: #f8f9fa;
        padding: 20px;
    }

    h1 {
        text-align: center;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>

</head>
<body>
<?php
require("config.php");

if (isset($_GET['id'])) {
    $candidateId = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $newFirstName = mysqli_real_escape_string($conn, $_POST['new_first_name']);
        $newLastName = mysqli_real_escape_string($conn, $_POST['new_last_name']);
        $newMiddleName = mysqli_real_escape_string($conn, $_POST['new_middle_name']);
        $newSex = mysqli_real_escape_string($conn, $_POST['new_sex']);
        $newAddress = mysqli_real_escape_string($conn, $_POST['new_address']);
        $newParty = mysqli_real_escape_string($conn, $_POST['new_party']);


        $sql = "UPDATE candidates SET 
            first_name = '$newFirstName',
            last_name = '$newLastName',
            middle_name = '$newMiddleName',
            sex = '$newSex',
            address = '$newAddress',
            party = '$newParty'
            WHERE id = $candidateId";

        if (mysqli_query($conn, $sql)) {

            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>";
            echo "Swal.fire({
                title: 'Updated',
                text: 'The record has been updated.',
                icon: 'success'
            }).then(() => {
                window.location.href = 'view_candidate.php';
            });";
            echo "</script>";
        } else {

            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>";
            echo "Swal.fire({
                title: 'Error',
                text: 'An error occurred while updating the record.',
                icon: 'error'
            }).then(() => {
                window.location.href = 'view_candidate.php';
            });";
            echo "</script>";
        }
    }


    $sql = "SELECT * FROM candidates WHERE id = $candidateId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Candidate not found.";
    }
} else {
    echo "Invalid candidate ID.";
}
?>
    <form action="update.php?id=<?php echo $candidateId; ?>" method="post" class="mx-auto mt-4">
    <div class="mb-3">
        <label for="new_first_name" class="form-label">First Name:</label>
        <input type="text" name="new_first_name" class="form-control" value="<?php echo $row['first_name']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="new_last_name" class="form-label">Last Name:</label>
        <input type="text" name="new_last_name" class="form-control" value="<?php echo $row['last_name']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="new_middle_name" class="form-label">Middle Initial:</label>
        <input type="text" name="new_middle_name" class="form-control" value="<?php echo $row['middle_name']; ?>" maxlength="1">
    </div>

    <div class="mb-3">
        <label for="new_sex" class="form-label">Sex:</label>
        <select name="new_sex" class="form-select" required>
            <option value="Male" <?php if ($row['sex'] === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($row['sex'] === 'Female') echo 'selected'; ?>>Female</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="new_address" class="form-label">Address:</label>
        <textarea name="new_address" class="form-control" rows="4" required><?php echo $row['address']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="new_party" class="form-label">Party:</label>
        <input type="text" name="new_party" class="form-control" value="<?php echo $row['party']; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>


</body>
</html>