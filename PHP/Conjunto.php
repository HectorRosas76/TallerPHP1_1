<?php
abstract class OperacionConjunto
{
    protected array $A;
    protected array $B;

    public function __construct(array $A, array $B)
    {
        $this->A = $A;
        $this->B = $B;
    }

    abstract public function calcular(): array;
    abstract public function nombre(): string;
}

class Union extends OperacionConjunto
{
    public function calcular(): array
    {
        return array_values(array_unique(array_merge($this->A, $this->B)));
    }
    public function nombre(): string { return "Unión"; }
}

class Interseccion extends OperacionConjunto
{
    public function calcular(): array
    {
        return array_values(array_intersect($this->A, $this->B));
    }
    public function nombre(): string { return "Intersección"; }
}

class DiferenciaAB extends OperacionConjunto
{
    public function calcular(): array
    {
        return array_values(array_diff($this->A, $this->B));
    }
    public function nombre(): string { return "Diferencia A - B"; }
}

class DiferenciaBA extends OperacionConjunto
{
    public function calcular(): array
    {
        return array_values(array_diff($this->B, $this->A));
    }
    public function nombre(): string { return "Diferencia B - A"; }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $A = array_map('trim', explode(",", $_POST["numAA"]));
    $B = array_map('trim', explode(",", $_POST["numBB"]));

    $operaciones = [
        new Union($A, $B),
        new Interseccion($A, $B),
        new DiferenciaAB($A, $B),
        new DiferenciaBA($A, $B),
    ];

    foreach ($operaciones as $op) {
        $resultado .= "<p><strong>" . $op->nombre() . ":</strong> { "
            . implode(", ", $op->calcular()) . " }</p><br>";
    }
}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparar Conjuntos</title>
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
            <h1> CONJUNTOS </h1>
            <?php if ($resultado != ""): ?>
                <h2>Resultado:</h2>
                <div class="resultado"><?= $resultado ?></div>
            <?php endif; ?>
            <a href="../HTML/Conjunto.html">VOLVER</a>
        </nav>
    </main>
</body>

</html>