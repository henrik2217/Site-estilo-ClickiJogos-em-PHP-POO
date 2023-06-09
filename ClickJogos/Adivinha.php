<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivinha o número</title>
</head>
<body>
    <form action="Adivinha.php" method="POST">
    Adivinhe um número entre 1 e 100:<input type="number" name="numero" id="numero" min="1" max="100">
    <input type="submit" value="Confirmar">
</form>
</body>
</html>

<?php

class Computador {
    private $random="";
    private $tentativas="";

    public function __construct() {

        $this ->random =rand(1,100);
        $this ->tentativas = 0;

    }

    public function fazerTentativas($numero) {

        $this->tentativas++;

        if($numero < $this->random) {

            echo "Tente um número maior.";
        }

        elseif($numero > $this->random) {
            echo "Tente um número menor.";
        }

        else {
            echo "Parabéns! Você acertou!!!";
        }
    }
}

$jogo = new Computador();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["numero"])) {
    $numero = $_POST["numero"];
    $jogo->fazerTentativas($numero);
}
?>