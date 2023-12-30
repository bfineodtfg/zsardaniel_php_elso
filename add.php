<?php
include 'dbConnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$id = $_POST["id"];
    $manufacturer = $_POST["manufacturer"];
    $price = $_POST["price"];

    $preinstalledWindows = 0;
    if ($_POST["preinstalledWindows"] == "igen")
    {
        $preinstalledWindows = 1;
    }

    $buildDate = $_POST["buildDate"];
    $memoryType = $_POST["memoryType"];

    $server = "127.1.1.1";
    $user = "user";
    $pass = "password";
    $dbname = "php_elso_dolgozat";

    $connection = new dbConnection($server, $user, $pass, $dbname);

    $sql = "INSERT INTO szamitogepek (manufacturer, price, preinstalledWindows, buildDate, memoryType)
            VALUES ('$manufacturer', '$price', '$preinstalledWindows', '$buildDate', '$memoryType')";

    if ($connection->execute($sql) === true) {  
        echo "Számítógép hozzáadása sikeresen megtörtént";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Adatok felvétele</title>
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
        <h1>Adat bevitel</h1>

        <form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
            <!-- <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="Add meg az ID-t" required>
            </div> -->
            <div class="form-group">
                <label for="manufacturer">Gyártó</label>
                <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Add meg a gyártót" required>
            </div>
            <div class="form-group">
                <label for="price">Ár</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Add meg az árat" required>
            </div>
            <div class="form-group">
                <label for="preinstalledWindows">Előtelepített Windows</label>
                <input type="text" class="form-control" id="preinstalledWindows" name="preinstalledWindows" placeholder="igen vagy nem" required>
            </div>
            <div class="form-group">
                <label for="buildDate">Gyártási dátum</label>
                <input type="text" class="form-control" id="buildDate" name="buildDate" placeholder="Add meg a gyártási dátumot" required>
            </div>
            <div class="form-group">
                <label for="memoryType">Memória típusa</label>
                <input type="text" class="form-control" id="memoryType" name="memoryType" placeholder="Add meg a memória típusát" required>
            </div>

            <button type="submit" class="btn btn-primary">Felvétel</button>
        </form>
    </main>
    <footer class="mt-5 text-center">
        <p>&copy; Zsár Dániel - 2023 december</p>
    </footer>
</body>
</html>
