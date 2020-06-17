<?php
include_once('student.php');

$json = '';
$students = [];
//setcookie("json", serialize($students), time() + (84600 * 14));
$nombre = (empty($_POST['nombre'])) ? '' : $_POST['nombre'];
$ap = (empty($_POST['ap'])) ? '' : $_POST['ap'];
$am = (empty($_POST['am'])) ? '' : $_POST['am'];
$matricula = (empty($_POST['matricula'])) ? '' : $_POST['matricula'];

$student = new student($nombre, $ap, $am, $matricula);

if ($student->getNombre() == '') {
    $student->__destruct();
} else {

    $students = json_decode(file_get_contents('data.json'));
    array_push($students, $student);
    $json = json_encode($students);
    $fp = fopen('data.json', 'w');
    fwrite($fp, $json);
    fclose($fp);

//    echo $json;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>filestream</title>

    <link rel="stylesheet" href="./assets/bootstrap.min.css"/>
    <link rel="stylesheet" href="./assets/styles.css"/>
</head>
<body>
<section>
    <div class="container mt-4">
        <form class="needs-validation" novalidate method="post" action="index.php">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="nombre">Nombre(s):</label>
                    <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            required
                            placeholder="Juan"
                    />
                    <div class="invalid-feedback">
                        Por favor, ingresa un nombre.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="ap">Apellido paterno:</label>
                    <input
                            type="text"
                            class="form-control"
                            id="ap"
                            name="ap"
                            required
                            placeholder="Martinez"
                    />
                    <div class="invalid-feedback">
                        Por favor, ingresa un apellido.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="am">Apellido materno:</label>
                    <div class="input-group">
                        <input
                                type="text"
                                class="form-control"
                                id="am"
                                name="am"
                                aria-describedby="inputGroupPrepend"
                                required
                                placeholder="Suarez"
                        />
                        <div class="invalid-feedback">
                            Por favor, ingresa un apellido.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <label for="matricula">Matricula:</label>
                    <input
                            type="text"
                            class="form-control"
                            id="matricula"
                            required
                            name="matricula"
                    />
                    <div class="invalid-feedback">
                        Por favor, ingresa tu matrícula.
                    </div>
                </div>
            </div>
            <div class="form-row">
                <button class="btn btn-primary mt-2" type="submit">Enviar datos</button>
            </div>
        </form>
        <div class="separated upper"></div>
    </div>
</section>


<section>
    <div class="container mt-4">
        <div class="row">
            <?php
            if (!empty($students)) {
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">#</th>';
                echo '<th scope="col">nombre</th>';
                echo '<th scope="col">Apellido paterno</th>';
                echo '<th scope="col">Apellido materno</th>';
                echo '<th scope="col">Matrícula</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $lenght = count($students);
                for ($i = 0; $i < $lenght; $i++) {
                    echo '<tr>';
                    echo '<th scope="row">' . ($i + 1) . '</th>';
                    echo '<td>' . $students[$i]->nombre . '</td>';
                    echo '<td>' . $students[$i]->ap . '</td>';
                    echo '<td>' . $students[$i]->am . ' </td>';
                    echo '<td>' . $students[$i]->matricula . ' </td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            }
            ?>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/validate.js"></script>
</body>
</html>
