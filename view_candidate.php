<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3y4D65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#candidateTable').DataTable();
        });
    </script>
    <style>
        .container {
            padding: 20px;
        }
        .table {
            font-size: 20px;
        }

    .title {
        font-family: 'Helvetica', Arial, sans-serif; 
        font-size: 30px; 
        color: #333;
        text-align: center;
        text-transform: uppercase; 
        letter-spacing: 2px; 
        margin: 20px 0; 
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); 
        background-color: #f8f8f8; 
        padding: 10px; 
        border-radius: 10px; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 50px;
    }

    </style>
</head>
<body>
<?php
    require("config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $mi = $_POST["mi"];
        $sex = $_POST["sex"];
        $address = $_POST["address"];
        $party = $_POST["party"];
        

        if (isset($_FILES["picture"])) {
            $file = $_FILES["picture"];
            $file_name = $file["name"];
            $file_tmp_name = $file["tmp_name"];
            $file_error = $file["error"];
            
            if ($file_error === 0) {
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $allowed_extensions = array("jpg", "jpeg", "png");
                
                if (in_array($file_ext, $allowed_extensions)) {
                    $picture_path = "images/" . uniqid() . "." . $file_ext;
                
                    move_uploaded_file($file_tmp_name, $picture_path);
                    
                    $sql = "INSERT INTO candidates (first_name, last_name, middle_name, sex, address, party, picture) VALUES ('$firstname', '$lastname', '$mi', '$sex', '$address', '$party', '$picture_path')";
                    
                    if (mysqli_query($conn, $sql)) {
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Only JPEG, JPG, and PNG files are allowed.";
                }
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "No file uploaded.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $mi = filter_input(INPUT_POST, 'mi', FILTER_SANITIZE_STRING);
        $sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $party = filter_input(INPUT_POST, 'party', FILTER_SANITIZE_STRING);

        if (empty($firstname) || empty($lastname) || empty($sex) || empty($address) || empty($party)) {
            echo "Please fill in all required fields.";
        } elseif (!in_array($sex, ['Male', 'Female'])) {
            echo "Invalid sex selection.";
        } else {
        }
    }

    ?>
    <div class="container">
        <h1 class="title">Candidate Profiler</h1>
        <table id="candidateTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Initial</th>
                <th>Sex</th>
                <th>Address</th>
                <th>Party</th>
                <th>Picture</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM candidates";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["middle_name"] . "</td>";
                    echo "<td>" . $row["sex"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["party"] . "</td>";
                    echo "<td><img src='" . $row["picture"] . "' alt='Candidate Picture' width='100'></td>";
                    echo "<td>";
                    echo "<a href='update.php?id=" . $row["id"] . "'><i class='fas fa-edit fa-lg'></i></a>&nbsp;";
                    echo "<a href='delete.php?id=" . $row["id"] . "'><i class='fas fa-trash fa-lg'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
