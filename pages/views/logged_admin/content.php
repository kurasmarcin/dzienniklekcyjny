<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Podgląd Admina:</h1>
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
                                <div class="card-body">
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

                                        $sql = "SELECT * from wszystko";
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






            </section>
            <!-- /.content -->
        </div>