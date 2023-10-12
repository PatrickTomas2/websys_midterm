<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <form action="view_candidate.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" class="form-control" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="mi" class="form-label">Middle Initial:</label>
                <input type="text" class="form-control" name="mi" maxlength="1">
            </div>
            <div class="mb-3">
                <label for="sex" class="form-label">Sex:</label>
                <select class="form-select" name="sex" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" name="address" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="party" class="form-label">Party:</label>
                <input type="text" class="form-control" name="party" required>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Picture (JPEG/JPG/PNG only):</label>
                <input type="file" class="form-control" name="picture" accept=".jpg, .jpeg, .png" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
