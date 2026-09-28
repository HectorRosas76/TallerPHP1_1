<?php
class Fibonacci
{

    public function generar($n)
    {
        $serie = [];

        if ($n >= 1)
            $serie[] = 0;
        if ($n >= 2)
            $serie[] = 1;

        for ($i = 2; $i < $n; $i++) {
            $nuevo = $serie[$i - 1] + $serie[$i - 2];
            $serie[] = $nuevo;
        }

        return $serie;
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $n = intval($_POST["num"]);

    $fibonacci = new Fibonacci();
    $serie = $fibonacci->generar($n);

    $resultado = implode(" - ", $serie);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serie Fibonacci</title>
    <link rel="stylesheet" href="../CSS/General.css">
</head>

<body>
 <main class="contenedor">
        <nav class="menu">
    <h1>Fibonnaci</h1>
    <?php
    if ($resultado != "") {
        echo "<h2>Resultado:</h2>";
        echo $resultado;
    }
    ?>
    <a href="../HTML/Fibonacci.html">VOLVER</a>
</nav>
</main>
</body>
</html>