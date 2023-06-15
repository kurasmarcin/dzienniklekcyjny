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
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Role ID</th>
                                            <th>Rodzaj aktywności</th>
                                            <th>Ocena</th>
                                            <th>Data wstawienia</th>
                                            <th>Data aktualizacji</th>
                                            <th>Średnia</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Przykładowa baza danych pisana z łapy Dodać baze danych SQL Pomyśleć nad kolumnami-->
                                        <tr>
                                            <td>Uczeń Piotr</td>
                                            <td>2</td>
                                            <td>uczeń</td>
                                            <!-- coś zrobić z rodzajami aktywności i wyświetlaniem ocen obok nich  -->
                                            <td>Kartkówka</td>
                                            <td>4</td>
                                            <!-- Pomyśleć jak zrobić pobieranie daty -->
                                            <td>22.02.23</td>
                                            <!-- Pomyśleć jak zrobić aktualizację daty -->
                                            <td>25.02.23</td>
                                            <!-- Napisać komende na liczenie śreniej ocen -->
                                            <td>4</td>
                                        </tr>
                                        <tr>

                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>






            </section>
            <!-- /.content -->
        </div>