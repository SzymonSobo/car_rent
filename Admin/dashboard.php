<?php
session_start();
require('../function.php');
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true){
    die("Dostęp zabroniony!!!");
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Dashboard</title>
</head>

<body>
    <div class="col-12">
        <h1 class="text-center font-weight-bold p-5">REZERWACJE</h1>
        <div class="text-center">
            <a href="../index.php" class="m-2">POWRÓT</a> |
            <a href="./logout.php" class="m-2">WYLOGUJ</a>
        </div>
    </div>
    <div class="container mt-5">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Samochów</th>
                    <th scope="col">Imię i Naziwsko</th>
                    <th scope="col">Koszt</th>
                    <th scope="col">Zwrot</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $rows=generate_dashboard();
                for ($i=0; $i<count($rows) ; $i++): ?> 
                    <tr>
<th scope="row"><?php echo ($i+1) ?></th>
<td><?php echo $rows[$i]['name'] ?> </td>
<td><?php echo $rows[$i]['surname'] ?></td>
<td><?php echo $rows[$i]['cost'] ?> zł</td>
<td><?php echo $rows[$i]['to_date'] ?></td>
</tr>
               <?php endfor; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>