<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$query = "SELECT * FROM countries";

if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities') {
    if (isset($_GET['country'])) {
        $country = $_GET['country'];
       
        $query = "SELECT cities.name, cities.district, cities.population 
                  FROM cities 
                  JOIN countries ON cities.country_code = countries.code 
                  WHERE countries.name LIKE :country";
    }
} elseif (isset($_GET['country'])) {
    
    $country = $_GET['country'];
    $query = "SELECT name, continent, independence_year, head_of_state 
              FROM countries 
              WHERE name LIKE :country";
}


$stmt = $conn->prepare($query);
if (isset($country)) {
    $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
}
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities') {
    echo "<h2>City Search Results for '$country':</h2>";
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>City Name</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['district']) . "</td>";
        echo "<td>" . htmlspecialchars($row['population']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<h2>Country Search Results:</h2>";
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Continent</th>
                    <th>Independence Year</th>
                    <th>Head of State</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
        echo "<td>" . htmlspecialchars($row['independence_year']) . "</td>";
        echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}
?>
