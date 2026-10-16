<?php

// CLASE PADRE
class Arbol
{
    protected function construirNodo($valor, $izq, $der)
    {
        return [
            "valor" => $valor,
            "izq" => $izq,
            "der" => $der
        ];
    }

    public function mostrarArbol($nodo)
    {
        if ($nodo == null) {
            return;
        }

        echo '<div class="arbol-visual">';
        $this->mostrarNivel([$nodo]);
        echo '</div>';
    }

    private function mostrarNivel($nodos)
    {
        $hayNodos = false;

        foreach ($nodos as $nodo) {
            if ($nodo != null) {
                $hayNodos = true;
                break;
            }
        }

        if (!$hayNodos) {
            return;
        }

        echo '<div class="nivel">';

        foreach ($nodos as $nodo) {
            if ($nodo != null) {
                echo '<div class="nodo">';
                echo $nodo["valor"];
                echo '</div>';
            } else {
                echo '<div class="nodo vacio"></div>';
            }
        }

        echo '</div>';

        $siguienteNivel = [];

        foreach ($nodos as $nodo) {

            if ($nodo != null) {
                $siguienteNivel[] = $nodo["izq"];
                $siguienteNivel[] = $nodo["der"];
            } else {
                $siguienteNivel[] = null;
                $siguienteNivel[] = null;
            }
        }

        $this->mostrarNivel($siguienteNivel);
    }
}
// HIJA 1: PREORDEN + INORDEN

class ArbolPreIn extends Arbol
{
    public function construir($preorden, $inorden)
    {
        if (count($preorden) == 0) {
            return null;
        }

        $raiz = $preorden[0];
        $pos = array_search($raiz, $inorden);
        $izqIn = array_slice($inorden, 0, $pos);
        $derIn = array_slice($inorden, $pos + 1);
        $izqPre = array_slice($preorden, 1, count($izqIn));
        $derPre = array_slice($preorden, 1 + count($izqIn));

        return $this->construirNodo(
            $raiz,
            $this->construir($izqPre, $izqIn),
            $this->construir($derPre, $derIn)
        );
    }
}

// HIJA 2: POSTORDEN + INORDEN

class ArbolPostIn extends Arbol
{
    public function construir($postorden, $inorden)
    {
        if (count($postorden) == 0) {
            return null;
        }

        $raiz = $postorden[count($postorden) - 1];
        $pos = array_search($raiz, $inorden);
        $izqIn = array_slice($inorden, 0, $pos);
        $derIn = array_slice($inorden, $pos + 1);
        $izqPost = array_slice($postorden, 0, count($izqIn));
        $derPost = array_slice(
            $postorden,
            count($izqIn),
            count($derIn)
        );

        return $this->construirNodo(
            $raiz,
            $this->construir($izqPost, $izqIn),
            $this->construir($derPost, $derIn)
        );
    }
}
// VARIABLES


$arbol = null;
$mensaje = "";

// RECIBIR FORMULARIO
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pre = trim($_POST["pre"]);
    $in = trim($_POST["in"]);
    $post = trim($_POST["post"]);

    // SI EXISTEN PREORDEN E INORDEN
    if ($pre != "" && $in != "") {
        $preorden = explode(",", $pre);
        $inorden = explode(",", $in);
        $obj = new ArbolPreIn();
        $arbol = $obj->construir($preorden, $inorden);
        $mensaje = "Árbol construido con Preorden + Inorden";
    }

    // SI EXISTEN POSTORDEN E INORDEN

    else if ($post != "" && $in != "") {
        $postorden = explode(",", $post);
        $inorden = explode(",", $in);
        $obj = new ArbolPostIn();
        $arbol = $obj->construir($postorden, $inorden);
        $mensaje = "Árbol construido con Postorden + Inorden";
    }
    // SI EXISTEN PREORDEN Y POSTORDEN

    else if ($pre != "" && $post != "") {
        $mensaje = "Preorden + Postorden no se puede construir de forma única sin información adicional. Ingrese también el Inorden.";
    }

    // SI NO HAY DOS RECORRIDOS
    else {
        $mensaje = "Debe ingresar mínimo dos recorridos, incluyendo Inorden.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Árbol Binario</title>
    <link rel="stylesheet" href="../CSS/general.css" />
    <link rel="stylesheet" href="../CSS/botones.css" />
    <link rel="stylesheet" href="../CSS/contenedor.css" />
    <link rel="stylesheet" href="../CSS/formulario.css" />
    <link rel="stylesheet" href="../CSS/menu.css" />
    <link rel="stylesheet" href="../CSS/titulos.css" />
    <link rel="icon"
        href="../Recursos/logo.png"
        type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Arbol.css">
</head>

<body>
    <main class="contenedor">
        <nav class="menu">
            <h1>Árbol generado</h1>
            <?php
            echo "<h3>$mensaje</h3>";
            if ($arbol != null) {

                $obj->mostrarArbol($arbol);
            }
            ?>
            <br>
            <a href="../HTML/Arbol.html">
                VOLVER
            </a>
        </nav>
    </main>
</body>

</html>