<?php
$sql = $_GET["sql"];


$conn = mysqli_connect("localhost","root","","kingame") or die (mysql_error());

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);
$conn->close();
?>