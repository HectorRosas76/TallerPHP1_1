<?php
class Acronimo
{
    private string $texto;

    public function __construct(string $texto)
    {
        $this->texto = $texto;
    }

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"];
    $obj = new Acronimo($texto);
    $resultado = $obj->transformar();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Acronimo</title>
    <link rel="stylesheet" href="../CSS/General.css">
    <link rel="icon" href="../Recursos/logo.png" type="image/x-icon">
</head>

<body>
    <main class="contenedor">
        <nav class="menu">
            <h1> Acronimo </h1>
            <?php
            if ($resultado != "") {
                echo "<h2>Resultado:</h2>";
                echo $resultado;
            }
            ?>
            <a href="../HTML/Acronimo.html">VOLVER</a>
        </nav>
    </main>
</body>

</html>