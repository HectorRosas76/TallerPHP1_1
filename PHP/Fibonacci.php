<?php

class Operacion
{
    private int $numero;
    public function __construct(int $numero)
    {
        $this->numero = $numero;
    }
    public function fibonacci(): array
    {
        $serie = [];
        if ($this->numero >= 1) {
            $serie[] = 0;
        }
        if ($this->numero >= 2) {
            $serie[] = 1;
        }
        for ($i = 2; $i < $this->numero; $i++) {
            $nuevo = $serie[$i - 1] + $serie[$i - 2];
            $serie[] = $nuevo;
        }
        return $serie;
    }
    public function factorial(): array
    {
        $serie = [];
        $resultado = 1;
        for ($i = 1; $i <= $this->numero; $i++) {
            $resultado *= $i;
            $serie[] = $resultado;
        }
        return $serie;
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = intval($_POST["num"]);
    $operacion = $_POST["operacion"];
    $operacionNumero = new Operacion($n);
    if ($operacion == "fibonacci") {
        $serie = $operacionNumero->fibonacci();
        $resultado = implode(" - ", $serie);
    } elseif ($operacion == "factorial") {
        $serie = $operacionNumero->factorial();
        $resultado = implode(" - ", $serie);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serie Fibonacci / Factorial</title>
    <link rel="stylesheet" href="../CSS/General.css">
    <link rel="icon" href="../Recursos/logo.png" type="image/x-icon">
</head>

<body>
    <main class="contenedor">
        <nav class="menu">
            <h1>Fibonnaci / Factorial </h1>
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