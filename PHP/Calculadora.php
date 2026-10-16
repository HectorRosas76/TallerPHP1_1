<?php
session_start();

abstract class Calculo
{
    protected float $num1;
    protected float $num2;

    public function __construct(float $num1, float $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    abstract public function operacion();
}

class Suma extends Calculo
{
    public function operacion()
    {
        return $this->num1 + $this->num2;
    }
}

class Resta extends Calculo
{
    public function operacion()
    {
        return $this->num1 - $this->num2;
    }
}

class Multiplicacion extends Calculo
{
    public function operacion()
    {
        return $this->num1 * $this->num2;
    }
}

class Division extends Calculo
{
    public function operacion()
    {
        if ($this->num2 == 0) {
            throw new Exception("Error: División por cero");
        }

        return $this->num1 / $this->num2;
    }
}


// Crear historial 
if (!isset($_SESSION["historial"])) {
    $_SESSION["historial"] = [];
}


$resultado = "";


// borrar historial
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borrar_historial"])) {

    $_SESSION["historial"] = [];

    $resultado = "Historial borrado correctamente.";
}


// operacion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["operacion"])) {
    $calculo = $_POST["operacion"];
    $num1 = (float) $_POST["num1"];
    $num2 = (float) $_POST["num2"];
    $suma = new Suma($num1, $num2);
    $resta = new Resta($num1, $num2);
    $multiplicacion = new Multiplicacion($num1, $num2);
    $division = new Division($num1, $num2);

    // segun operacion seleccionada imprimir resultado
    switch ($calculo) {
        case "Suma":
            $resultado = $suma->operacion();
            $simbolo = "+";
            break;
        case "Resta":
            $resultado = $resta->operacion();
            $simbolo = "-";
            break;
        case "Multiplicacion":
            $resultado = $multiplicacion->operacion();
            $simbolo = "×";
            break;
        case "Division":
            $resultado = $division->operacion();
            $simbolo = "÷";
            break;
        default:
            $resultado = "Operación no válida";
            $simbolo = "";
            break;
    }

    // historial
    if ($simbolo != "") {
        $operacionHistorial =
            $num1 . " " .
            $simbolo . " " .
            $num2 . " = " .
            $resultado;
        $_SESSION["historial"][] = $operacionHistorial;
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="../CSS/general.css" />
    <link rel="stylesheet" href="../CSS/botones.css" />
    <link rel="stylesheet" href="../CSS/contenedor.css" />
    <link rel="stylesheet" href="../CSS/formulario.css" />
    <link rel="stylesheet" href="../CSS/menu.css" />
    <link rel="stylesheet" href="../CSS/titulos.css" />
    <link rel="icon"
        href="../Recursos/logo.png"
        type="image/x-icon">

</head>

<body>
    <main class="contenedor">
        <nav class="menu">
            <h1>CALCULADORA</h1>
            <?php if ($resultado != ""): ?>
                <h2>Resultado:</h2>
                <div class="resultado"><?= $resultado ?></div>
            <?php endif; ?>
            <h2>Historial</h2>
            <?php
            if (count($_SESSION["historial"]) > 0) {
                foreach ($_SESSION["historial"] as $operacion) {
                    echo "<div class='resultado pequeno'>$operacion</div>";
                }
            } else {
                echo "<div class='resultado pequeno'>No hay operaciones en el historial.</div>";
            }
            ?>
            <br>
            <a href="../HTML/Calculadora.html">
                VOLVER
            </a>
        </nav>
    </main>
</body>

</html>