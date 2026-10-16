<?php

abstract class Operacion
{
    abstract public function convertir(): array;
    protected int $numero;
    public function __construct(int $numero)
    {
        $this->numero = $numero;
    }
}

class Fibonacci extends Operacion
{
    public function convertir(): array
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
}

class Factorial extends Operacion
{
    public function convertir(): array
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

    if ($operacion == "fibonacci") {

        $fibonacci = new Fibonacci($n);
        $serie = $fibonacci->convertir();
        $resultado = implode(" - ", $serie);
    } elseif ($operacion == "factorial") {

        $factorial = new Factorial($n);
        $serie = $factorial->convertir();
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
    <link rel="stylesheet" href="../CSS/general.css" />
    <link rel="stylesheet" href="../CSS/botones.css" />
    <link rel="stylesheet" href="../CSS/contenedor.css" />
    <link rel="stylesheet" href="../CSS/formulario.css" />
    <link rel="stylesheet" href="../CSS/menu.css" />
    <link rel="stylesheet" href="../CSS/titulos.css" />
    <link rel="icon" href="../Recursos/logo.png" type="image/x-icon">
</head>

<body>
    <main class="contenedor">
        <nav class="menu">
            <h1>Fibonnaci / Factorial </h1>
 <?php if ($resultado != ""): ?>
    <h2>Resultado:</h2>
    <div class="resultado"><?= $resultado ?></div>
<?php endif; ?>
            <a href="../HTML/Fibonacci.html">VOLVER</a>
        </nav>
    </main>
</body>

</html>