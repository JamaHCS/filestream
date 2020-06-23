<?php
include_once('./model/student.php');

$json = '';
$students = json_decode(file_get_contents('./data/data.json'));
$nombre = (empty($_POST['nombre'])) ? '' : $_POST['nombre'];
$ap = (empty($_POST['ap'])) ? '' : $_POST['ap'];
$am = (empty($_POST['am'])) ? '' : $_POST['am'];
$matricula = (empty($_POST['matricula'])) ? '' : $_POST['matricula'];
$profilePhoto = '';

$student = new student($nombre, $ap, $am, $matricula, $profilePhoto);


if ($student->getNombre() == '') {
    $student->__destruct();
} else {
    $students = json_decode(file_get_contents('./data/data.json'));
    array_push($students, $student);
    $json = json_encode($students);
    $fp = fopen('./data/data.json', 'w');
    fwrite($fp, $json);
    fclose($fp);

    $routeOfPP = './data/imageReceived/';
    $destinationPhoto = $routeOfPP . $_FILES['perfil']['name'];
    if (!((strpos($_FILES['perfil']['type'], "gif") || strpos($_FILES['perfil']['type'], "jpeg") || strpos($_FILES['perfil']['type'], "jpg") || strpos($_FILES['perfil']['type'], "png")) && ($_FILES['perfil']['size'] < 50000))) {
        move_uploaded_file($_FILES['perfil']['tmp_name'], $destinationPhoto);
        $student->profilePhoto = $destinationPhoto;
    }
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
        <form class="needs-validation" novalidate method="post" action="index.php" enctype="multipart/form-data">
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
                <div class="col-6">
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
                <div class="col-6">
                    <label for="profilePhoto">Foto de perfil:</label>
                    <input type="file" class="form-control-file" id="profilePhoto" required name="perfil"
                           accept="image/png, .jpeg, .jpg, image/gif"/>
                    <div class="invalid-feedback">
                        Por favor, selecciona una foto de perfil.
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
            <div class="table-responsive">
                <?php
                if (!empty($students)) {
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">#</th>';
                    echo '<th scope="col">😋</th>';
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
                        $profileAsign = ($students[$i]->profilePhoto == '') ? './data/imageReceived/default.jpg' : $students[$i]->profilePhoto;
                        echo '<td> 
                            <div class="container-img">
                                <img src="' . $profileAsign . '" alt="Profile Photo" class="profilePhoto" />                            
                            </div>
                          </td>';

                        echo '<td>' . $students[$i]->nombre . '</td>';
                        echo '<td>' . $students[$i]->ap . '</td>';
                        echo '<td>' . $students[$i]->am . ' </td>';
                        echo '<td>' . $students[$i]->matricula . ' </td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<h2>No hay datos para mostrar ☹ </h2>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/validate.js"></script>
</body>
</html>
