<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'];
    $number = isset($_POST['number']) ? intval($_POST['number']) : null;

    // Validar el número ingresado
    if ($number !== null && ($number < 0 || $number > 10)) {
        $error = "El número debe estar en el rango de 0 a 10.";
    } else {
        switch ($option) {
            case '1': // Factorial
                if ($number !== null) {
                    $factorial = 1;
                    for ($i = 1; $i <= $number; $i++) {
                        $factorial *= $i;
                    }
                    $result = "El factorial de $number es: $factorial";
                } else {
                    $error = "Debe ingresar un número para calcular el factorial.";
                }
                break;

            case '2': // Primo
                if ($number !== null) {
                    if ($number < 2) {
                        $isPrime = false;
                    } else {
                        $isPrime = true;
                        for ($i = 2; $i <= sqrt($number); $i++) {
                            if ($number % $i === 0) {
                                $isPrime = false;
                                break;
                            }
                        }
                    }
                    $result = $isPrime ? "$number es un número primo." : "$number no es un número primo.";
                } else {
                    $error = "Debe ingresar un número para verificar si es primo.";
                }
                break;

            case '3': // Serie Matemática
                if ($number !== null) {
                    $serie = 0;
                    $sign = 1;
                    $serieTerms = [];
                    for ($i = 1; $i <= $number; $i++) {
                        $term = $sign * (pow($i, 2) / factorial($i));
                        $serie += $term;
                        $serieTerms[] = $sign > 0 ? "+ " . (pow($i, 2) . "/" . factorial($i)) : "- " . (pow($i, 2) . "/" . factorial($i));
                        $sign *= -1;
                    }
                    $result = "La serie matemática es: " . implode(" ", $serieTerms) . "<br>El resultado es: $serie";
                } else {
                    $error = "Debe ingresar un número para calcular la serie matemática.";
                }
                break;

            case 'S': // Salir
                $result = "Gracias por usar el programa. ¡Hasta luego!";
                header("Location: index.html");
                break;

            default:
                $error = "Opción inválida.";
        }
    }
}

// Función para calcular factorial
function factorial($n)
{
    $factorial = 1;
    for ($i = 1; $i <= $n; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú PHP</title>
    <!-- Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('Imagenes/fondo.jpg');
            background-size: cover;
            background-attachment: fixed;
            color: #165014;
        }

        .container {
            margin-top: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 20px;
        }

        h1, h2, h3 {
            color: #165014;
            text-align: center;
            font-weight: bold;
        }

        .form-group label {
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
</br></br></br>
			<div style="padding-left:510px;">
				<img src="Imagenes/selloespe.jpg" alt="ESPE" height="100" >
			</div>
    <div class="container">
        <h1>MENÚ DE OPCIONES</h1>
        <hr>
        <p class="text-center">1. Factorial</p>
        <p class="text-center">2. Primo</p>
        <p class="text-center">3. Serie Matemática</p>
        <p class="text-center">S. Salir</p>
        <hr>
        <!-- Formulario -->
        <form method="post" class="form-horizontal">
            <div class="form-group">
                <label for="option" class="col-sm-4 control-label">Escoja una opción:</label>
                <div class="col-sm-6">
                    <select id="option" name="option" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <option value="1" <?= isset($option) && $option == '1' ? 'selected' : '' ?>>1 - Factorial</option>
                        <option value="2" <?= isset($option) && $option == '2' ? 'selected' : '' ?>>2 - Primo</option>
                        <option value="3" <?= isset($option) && $option == '3' ? 'selected' : '' ?>>3 - Serie Matemática</option>
                        <option value="S" <?= isset($option) && $option == 'S' ? 'selected' : '' ?>>S - Salir</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="number" class="col-sm-4 control-label">Ingrese un número (0 ≤ num ≤ 10):</label>
                <div class="col-sm-6">
                    <input type="number" id="number" name="number" class="form-control" min="0" max="10" value="<?= isset($number) ? $number : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-6">
                    <button type="submit" class="btn btn-success btn-block">Enviar</button>
                </div>
            </div>
        </form>
        <hr>
        <!-- Resultados -->
        <?php if (isset($result)): ?>
            <div class="alert alert-success">
                <h3>Resultado:</h3>
                <p><?= $result ?></p>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger error">
                <h3>Error:</h3>
                <p><?= $error ?></p>
            </div>
        <?php endif; ?>
    </div>
    <!-- Bootstrap 3 JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
