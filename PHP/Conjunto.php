<?php
class Conjuntos
{
    private array $A;
    private array $B;
    public function __construct(array $A, array $B)
    {
        $this->A = $A;
        $this->B = $B;
    }
    public function union()
    {
        $res = $this->A;
        foreach ($this->B as $b) {
            if (!in_array($b, $res)) {
                $res[] = $b;
            }
        }
        return $res;
    }
    public function interseccion()
    {
        $res = [];
        foreach ($this->A as $a) {
            if (in_array($a, $this->B)) {
                $res[] = $a;
            }
        }
        return $res;
    }

    public function diferencia()
    {
        $res = [];
        foreach ($this->A as $a) {
            if (!in_array($a, $this->B)) {
                $res[] = $a;
            }
        }
        return $res;
    }
    public function diferenciaBA()
    {
        $res = [];

        foreach ($this->B as $b) {
            if (!in_array($b, $this->A)) {
                $res[] = $b;
            }
        }

        return $res;
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $A = explode(",", $_POST["numAA"]);
    $B = explode(",", $_POST["numBB"]);
    $A = array_map('trim', $A);
    $B = array_map('trim', $B);
    $obj = new Conjuntos($A, $B);
    $union = $obj->union();
    $inter = $obj->interseccion();
    $diferencia = $obj->diferencia();
    $resultado = "
        <p><strong>Unión:</strong> 
        { " . implode(", ", $union) . " }</p><br>
        <p><strong>Intersección:</strong> 
        { " . implode(", ", $inter) . " }</p><br>
        <p><strong>Diferencia A - B:</strong> 
        { " . implode(", ", $diferencia) . " }</p><br>
    ";
}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparar Conjuntos</title>
    <link rel="stylesheet" href="../CSS/General.css">
    <link rel="icon" href="../Recursos/logo.png" type="image/x-icon">
</head>

<body>
    <main class="contenedor">
        <nav class="menu">
            <h1> CONJUNTOS </h1>
            <?php
            if ($resultado != "") {
                echo "<h2>Resultado:</h2>";
                echo $resultado;
            }
            ?>
            <a href="../HTML/Conjunto.html">VOLVER</a>
        </nav>
    </main>
</body>

</html>