<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dziennik Nauczyciela:</h1>
                    <div class="info">
                        <span href="#" class="accent-green"><?php echo $_SESSION["logged"]["firstName"]." ".$_SESSION["logged"]["lastName"] ?></span>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Oceny</h3>
                                </div>
                                <!-- /.card-header -->
                                <table class="card-body">
                                    <thead>
                                    <tr>
                                        <th>Imie</th>
                                        <th>Nazwisko</th>
                                        <th>kartkówka</th>
                                        <th>sprawdzian</th>
                                        <th>odpowiedź</th>
                                        <th>Średnia</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    require_once "../scripts/connect.php";

                                    $sql = "SELECT u.id, k.ocena AS kartkowka, s.ocena AS sprawdzian, o.ocena AS odpowiedz,\n"
                                        . "       (k.ocena + s.ocena + o.ocena) / 3 AS srednia,\n"
                                        . "       u.firstName, u.lastName, u.id AS user_id\n"
                                        . "FROM users u\n"
                                        . "JOIN kontakty kty ON u.id = kty.id\n"
                                        . "JOIN roles r ON kty.role_id = r.id\n"
                                        . "LEFT JOIN kartkowka k ON u.id = k.user_id\n"
                                        . "LEFT JOIN sprawdzian s ON u.id = s.user_id\n"
                                        . "LEFT JOIN odpowiedz o ON u.id = o.user_id\n"
                                        . "WHERE r.id = 1;";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstName = $row['firstName'];
                                            $lastName = $row['lastName'];
                                            $kartkowka = $row['kartkowka'];
                                            $sprawdzian = $row['sprawdzian'];
                                            $odpowiedz = $row['odpowiedz'];
                                            $srednia = $row['srednia'];
                                            $userId = $row['user_id'];

                                            echo "<tr>";
                                            echo "<td>$firstName</td>";
                                            echo "<td>$lastName</td>";
                                            echo "<td><form method='POST' action='edytuj.php'><input type='hidden' name='userId' value='$userId'><input type='number' name='kartkowka' value='$kartkowka'><input type='submit' value='Zapisz'></form></td>";
                                            echo "<td><form method='POST' action='edytuj.php'><input type='hidden' name='userId' value='$userId'><input type='number' name='sprawdzian' value='$sprawdzian'><input type='submit' value='Zapisz'></form></td>";
                                            echo "<td><form method='POST' action='edytuj.php'><input type='hidden' name='userId' value='$userId'><input type='number' name='odpowiedz' value='$odpowiedz'><input type='submit' value='Zapisz'></form></td>";
                                            echo "<td>$srednia</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Brak danych do wyświetlenia.";
                                    }

                                    $conn->close();
                                    ?>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- /.content -->
</div>
</section>
</div>

