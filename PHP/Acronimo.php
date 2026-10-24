<?php
abstract class Transformador
{
    protected string $texto;

    public function __construct(string $texto)
    {
        $this->texto = $texto;
    }

    // Abstracción: cada hija define cómo transforma
    abstract public function transformar(): string;
}

class Acronimo extends Transformador
{
    public function transformar(): string
    {
        $texto = strtolower($this->texto);
        $resultado = "";

        for ($i = 0; $i < strlen($texto); $i++) {
            $char = $texto[$i];
            if (ctype_alpha($char)) {
                if ($i == 0 || $texto[$i - 1] == " " || $texto[$i - 1] == "-") {
                    $resultado .= strtoupper($char);
                }
            }
        }
        return $resultado;
    }
}

class Original extends Transformador
{
    public function transformar(): string
    {
        return ucwords(strtolower($this->texto));
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"];

    // Polimorfismo: mismo método, distinto comportamiento
    $transformadores = [
        "Acrónimo" => new Acronimo($texto),
        "Original" => new Original($texto),
    ];

    foreach ($transformadores as $nombre => $t) {
        $resultado .= "<strong>$nombre:</strong> " . $t->transformar() . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Acronimo</title>
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
            <h1> Acronimo </h1>
            <?php if ($resultado != ""): ?>
                <h2>Resultado:</h2>
                <div class="resultado"><?= $resultado ?></div>
            <?php endif; ?>
            <a href="../HTML/Acronimo.html">VOLVER</a>
        </nav>
    </main>
</body>

</html>