<!DOCTYPE html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>   
</head>
<body>
<?php
require("config.php");

if (isset($_GET['id'])) {
    $candidateId = $_GET['id'];

    $sql = "DELETE FROM candidates WHERE id = $candidateId";

    if (mysqli_query($conn, $sql)) {
        echo "Record with ID $candidateId has been deleted from the database.";
        header("Location: view_candidate.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid candidate ID.";
}
?>

</body>
</html>