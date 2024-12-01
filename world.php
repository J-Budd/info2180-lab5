<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['country'])) {
  $country = $_GET['country'];
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
  } else {
    $stmt = $conn->query("SELECT * FROM countries");
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
