<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/table.css">
    <title>Użytkownicy</title>
</head>
<body>
<h4>Użytkownicy</h4>
<?php
if (isset($_GET["userDelete"])){
    if ($_GET["userDelete"] == 0){
        echo "<h4>Nie usunięto użytkownika!</h4>";
    } else {
        echo "<h4>Usunięto użytkownika o id=$_GET[userDelete]</h4>";
    }
}
?>
<table>
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Kartkówka</th>
        <th>Sprawdzian</th>
        <th>Odpowiedź</th>
        <th>Średnia</th>
        <th>Email</th>
        <th>Akcje</th>
    </tr>
<?php
require_once "../scripts/connect.php";
$sql = "SELECT\n"
    . "  u.id,\n"
    . "  u.firstName AS imie,\n"
    . "  u.lastName AS nazwisko,\n"
    . "  u.email,\n"
    . "  k.ocena AS ocena_kartkowki,\n"
    . "  s.ocena AS ocena_sprawdzianu,\n"
    . "  o.ocena AS ocena_odpowiedzi,\n"
    . "  ROUND((COALESCE(k.ocena, 0) + COALESCE(s.ocena, 0) + COALESCE(o.ocena, 0)) / (\n"
    . "    CASE WHEN k.ocena IS NULL THEN 0 ELSE 1 END +\n"
    . "    CASE WHEN s.ocena IS NULL THEN 0 ELSE 1 END +\n"
    . "    CASE WHEN o.ocena IS NULL THEN 0 ELSE 1 END\n"
    . "  ), 1) AS srednia_ocen\n"
    . "FROM\n"
    . "  users AS u\n"
    . "LEFT JOIN\n"
    . "  kartkowka AS k ON u.id = k.user_id\n"
    . "LEFT JOIN\n"
    . "  sprawdzian AS s ON u.id = s.user_id\n"
    . "LEFT JOIN\n"
    . "  odpowiedz AS o ON u.id = o.user_id\n"
    . "WHERE\n"
    . "  u.role_id = 1;";

$result = $conn->query($sql);

if ($result->num_rows == 0){
    echo "<tr><td colspan='8'>Brak rekordów do wyświetlenia</td></tr>";
} else {
    while($user = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$user['imie']."</td>";
        echo "<td>".$user['nazwisko']."</td>";
        echo "<td>".$user['ocena_kartkowki']."</td>";
        echo "<td>".$user['ocena_sprawdzianu']."</td>";
        echo "<td>".$user['ocena_odpowiedzi']."</td>";
        echo "<td>".$user['srednia_ocen']."</td>";
        echo "<td>".$user['email']."</td>";
        echo "<td><a href='../scripts/delete_user.php?userIdDelete=".$user['id']."'>Usuń</a></td>";
        echo "</tr>";
    }
}

$conn->close();
?>
</table>

<script>
    // Obsługa zdarzenia kliknięcia przycisku "Usuń"
    const deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach(button => {
        button.addEventListener("click", (event) => {
            event.preventDefault();
            const userId = event.target.dataset.userId;
            deleteUser(userId);
        });
    });

    // Funkcja do usuwania użytkownika
    function deleteUser(userId) {
        if (confirm("Czy na pewno chcesz usunąć tego użytkownika?")) {
            window.location.href = `../scripts/delete_user.php?userIdDelete=${userId}`;
        }
    }
</script>
</body>
</html>

