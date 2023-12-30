<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Számítógépek listázása</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Számítógépek</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Listázás</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Felvétel</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container mt-5">
        <h1>Számítógépek listája:</h1>

        <?php
        include 'dbConnection.php';
        // Database connection details
        $server = "127.1.1.1";
        $user = "user";
        $pass = "password";
        $dbname = "php_elso_dolgozat";

        // Create connection
        $connection = new dbConnection($server, $user, $pass, $dbname);

        // Retrieve data from the database
        $sql = "SELECT id, manufacturer, price, preinstalledWindows, buildDate, memoryType FROM szamitogepek";
        $result = $connection->execute($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Azonosító</th>
                            <th>Gyártó</th>
                            <th>Ár</th>
                            <th>Előtelepített Windows</th>
                            <th>Gyártási dátum</th>
                            <th>Memória típusa</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['manufacturer']}</td>
                        <td>{$row['price']}</td>
                        ";
                if($row['preinstalledWindows'] == 1){
                    echo"<td>igen</td>";
                }
                else{
                    echo"<td>nem</td>";
                }
                echo"   <td>{$row['buildDate']}</td>
                        <td>{$row['memoryType']}</td>
                    </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "Nincs eltárolt számítógép";
        }

        // Close connection
        $connection->close();
        ?>
    </main>
    <footer class="mt-5 text-center">
        <p>&copy; Zsár Dániel - 2023 december</p>
    </footer>
</body>
</html>
