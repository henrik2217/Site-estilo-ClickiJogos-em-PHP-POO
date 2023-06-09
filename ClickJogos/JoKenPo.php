<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoKenPo</title>
</head>
<body>
    <form action="JoKenPo.php" method="post">
<label for="opcao">Vamos jogar PoKenPo?</label>
<select id="opcao" name="opcao">
    <option value="pedra">Pedra</option>
    <option value="papel">Papel</option>
    <option value="tesoura">Tesoura</option>
</select>
<input type="submit" value="Confirmar">
    </form>
</body>
</html>

<?php

class Jogador {
    private $escolha;

    public function setEscolha($escolha) {
        $this->escolha = $escolha;
    }

    public function getEscolha() {
        return $this->escolha;
    }
}

class Jogo {
    private $jogador;
    private $computador;

    public function __construct() {
        $this->jogador = new Jogador();
        $this->computador = new Jogador();
    }

    public function jogar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $opcoes = array("pedra", "papel", "tesoura");

            if (isset($_POST['opcao']) && in_array($_POST['opcao'], $opcoes)) {
                $escolhaJogador = $_POST['opcao'];
                $escolhaComputador = $opcoes[array_rand($opcoes)];

                $this->jogador->setEscolha($escolhaJogador);
                $this->computador->setEscolha($escolhaComputador);

                $resultado = $this->verificarResultado($escolhaJogador, $escolhaComputador);

                echo "Escolha do jogador: " . $escolhaJogador . "<br>";
                echo "Escolha do computador: " . $escolhaComputador . "<br>";
                echo "Resultado: " . $resultado;
            }
        }
    }

    private function verificarResultado($escolhaJogador, $escolhaComputador) {
        if ($escolhaJogador == $escolhaComputador) {
            return "Empate";
        } elseif (($escolhaJogador == "pedra" && $escolhaComputador == "tesoura") ||
                  ($escolhaJogador == "papel" && $escolhaComputador == "pedra") ||
                  ($escolhaJogador == "tesoura" && $escolhaComputador == "papel")) {
            return "Jogador venceu";
        } else {
            return "Computador venceu";
        }
    }
}

$jogo = new Jogo();
$jogo->jogar();


?>