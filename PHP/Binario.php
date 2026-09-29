<?php

abstract class Binario
{
    abstract public function convertir();
    protected int $num1;

    public function __construct(int $num1)
    {
        $this->num1 = $num1;
    }
}

class Entero extends Binario
{
    public function convertir()
    {
        $binario = "";
        while ($this->num1 > 0) {
            $binario = ($this->num1 % 2) . $binario;
            $this->num1 = floor($this->num1 / 2);
        }
        return $binario ?: "0";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = (int) $_POST["num1"];
    $obj = new Entero($num);
    $resultado = $obj->convertir();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Binario</title>
    <link rel="stylesheet" href="../CSS/General.css">
    <link rel="icon" href="../Recursos/logo.png" type="image/x-icon">
</head>

<body>
    <main class="contenedor">
        <nav class="menu">
            <h1> Numero Binario </h1>
            <?php
            if ($resultado != "") {
                echo "<h2>Resultado:</h2>";
                echo $resultado;
            }
            ?>
            <a href="../HTML/Binario.html">VOLVER</a>
        </nav>
    </main>
</body>

</html>