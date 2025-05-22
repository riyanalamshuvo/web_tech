
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cities'])) {
    $selectedCities = $_POST['cities'];

    if (count($selectedCities) > 10) {
        echo "<h3 style='text-align:center; color:red;'>You can only select up to 10 cities.</h3>";
        exit;
    }

    $_SESSION['selectedCities'] = $selectedCities;

    // --- Connect to database (aqi) ---
    $conn = new mysqli("localhost", "root", "", "aqi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare dynamic placeholders (?, ?, ...)
    $placeholders = implode(',', array_fill(0, count($selectedCities), '?'));

    // SQL query with correct column names
    $sql = "SELECT City, AQI FROM info WHERE City IN ($placeholders)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error in preparing SQL query: ' . $conn->error);
    }

    // Bind parameters dynamically based on the number of cities selected
    $stmt->bind_param(str_repeat('s', count($selectedCities)), ...$selectedCities);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<h3 style='text-align:center;'>No cities selected. Please go back and select.</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AQI RESULTS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 30px auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Selected Cities AQI Data</h2>
    <table>
        <tr>
            <th>City</th>
            <th>AQI</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['City']) ?></td>
                <td><?= htmlspecialchars($row['AQI']) ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
