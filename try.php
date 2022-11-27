<!DOCTYPE html>
<html>
<head>
<title>METANIT.COM</title>
<meta charset="utf-8" />
</head>
<body>
<h2>Список пользователей</h2>
<?php
$str = "1 4 6 8 9 18 20";
$pieces = explode(" ", $str);
foreach($pieces as $val)
{
    echo $val."+";
}

$conn = new mysqli("localhost", "root", "root", "registration");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM users";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    foreach($result as $row){
        echo $row["username"];
        echo $row["birthday"];
        echo $row["position"];
    }
    $result->free();
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();
?>
</body>
</html>