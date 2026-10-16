<?php

class Calculo
{
    protected $datos;
    public function __construct($datos)
    {
        $this->datos = $datos;
    }
    public function calcular()
    {
        echo "Calculo base";
    }
}

class Promedio extends Calculo
{
    public function calcular()
    {
        $arr = explode(",", $this->datos);
        $arr = array_map('intval', $arr);
        return array_sum($arr) / count($arr);
    }
}

class Mediana extends Calculo
{
    public function calcular()
    {
        $arr = explode(",", $this->datos);
        $arr = array_map('intval', $arr);
        sort($arr);
        $n = count($arr);
        if ($n % 2 == 0) {
            return (
                $arr[(int) ($n / 2) - 1] +
                $arr[(int) ($n / 2)]
            ) / 2;
        } else {
            return $arr[(int) floor($n / 2)];
        }
    }
}

class Moda extends Calculo
{
    public function calcular()
    {
        $arr = explode(",", $this->datos);
        $arr = array_map('intval', $arr);
        $conteo = array_count_values($arr);
        arsort($conteo);
        return array_keys($conteo)[0];
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos = $_POST["datos"];
    $promedio = new Promedio($datos);
    $mediana = new Mediana($datos);
    $moda = new Moda($datos);

    $resultado = "<strong>Promedio: </strong>" . $promedio->calcular() . "<br>";
    $resultado .= "<strong>Mediana: </strong>" . $mediana->calcular() . "<br>";
    $resultado .= "<strong>Moda: </strong>" . $moda->calcular();
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promedio - Moda - Mediana</title>
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
            <h1> Promedio - Moda - Mediana </h1>
            <?php if ($resultado != ""): ?>
                <h2>Resultado:</h2>
                <div class="resultado"><?= $resultado ?></div>
            <?php endif; ?>
            <a href="../HTML/AppPMM.html">VOLVER</a>
        </nav>
    </main>
</body>

</html>