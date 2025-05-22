
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Cities - AQI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-box {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .city-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .city-list {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
    <script>
        function limitCheckboxes() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                    const selected = Array.from(checkboxes).filter(c => c.checked).length;
                    if (selected >= 10) {
                        checkboxes.forEach(c => { if (!c.checked) c.disabled = true; });
                    } else {
                        checkboxes.forEach(c => c.disabled = false);
                    }
                });
            });
        }
        window.onload = limitCheckboxes;
    </script>
</head>
<body>
    <div class="form-box">
        <h2>Select up to 10 Cities</h2>
        <form method="POST" action="showaqi.php">
            <div class="city-list">
                <?php
                $cities = [
                    "Dhaka", "Lahore", "Delhi", "Beijin", "Kuwait City", "Cairo", "Doha", "Dubai",
                    "Tokyo", "Moscow", "Berlin", "Dublin", "New York City", "Toronto", "Kabul",
                    "Bangkok", "Sydney", "Kampala", "Rome", "Nice"
                ];
                foreach ($cities as $city) {
                    echo "<div class='city-item'><label>$city</label><input type='checkbox' name='cities[]' value='$city'></div>";
                }
                ?>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
