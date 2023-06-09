

<?php

class Jogador {
    private $nome;
    private $simbolo;

    public function __construct($nome, $simbolo) {
        $this->nome = $nome;
        $this->simbolo = $simbolo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSimbolo() {
        return $this->simbolo;
    }
}

class JogoDaVelha {
    private $tabuleiro;
    private $jogador1;
    private $jogador2;
    private $turno;
    private $vencedor;

    public function __construct($jogador1, $jogador2) {
        $this->tabuleiro = array(
            array('', '', ''),
            array('', '', ''),
            array('', '', '')
        );
        $this->jogador1 = $jogador1;
        $this->jogador2 = $jogador2;
        $this->turno = $this->jogador1;
        $this->vencedor = null;
    }

    public function getTabuleiro() {
        return $this->tabuleiro;
    }

    public function getTurno() {
        return $this->turno;
    }

    public function alternarTurno() {
        if ($this->turno === $this->jogador1) {
            $this->turno = $this->jogador2;
        } else {
            $this->turno = $this->jogador1;
        }
    }

    public function jogar($linha, $coluna) {
        $simbolo = $this->turno->getSimbolo();
        if ($this->tabuleiro[$linha][$coluna] == '') {
            $this->tabuleiro[$linha][$coluna] = $simbolo;
            $this->verificarVencedor();
        }
    }

    public function verificarVencedor() {
        $simbolos = array('X', 'O');

        foreach ($simbolos as $simbolo) {
            // Verificar linhas
            for ($i = 0; $i < 3; $i++) {
                if ($this->tabuleiro[$i][0] == $simbolo && $this->tabuleiro[$i][1] == $simbolo && $this->tabuleiro[$i][2] == $simbolo) {
                    $this->vencedor = $simbolo;
                    return;
                }
            }

            // Verificar colunas
            for ($j = 0; $j < 3; $j++) {
                if ($this->tabuleiro[0][$j] == $simbolo && $this->tabuleiro[1][$j] == $simbolo && $this->tabuleiro[2][$j] == $simbolo) {
                    $this->vencedor = $simbolo;
                    return;
                }
            }

            // Verificar diagonal principal
            if ($this->tabuleiro[0][0] == $simbolo && $this->tabuleiro[1][1] == $simbolo && $this->tabuleiro[2][2] == $simbolo) {
                $this->vencedor = $simbolo;
                return;
            }

            // Verificar diagonal secundária
            if ($this->tabuleiro[0][2] == $simbolo && $this->tabuleiro[1][1] == $simbolo && $this->tabuleiro[2][0] == $simbolo) {
                $this->vencedor = $simbolo;
                return;
            }
        }

        // Verificar empate
        $empate = true;
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($this->tabuleiro[$i][$j] == '') {
                    $empate = false;
                    break 2;
                }
            }
        }

        if ($empate) {
            $this->vencedor = 'Empate';
        }
    }

    public function getVencedor() {
        return $this->vencedor;
    }
}

// Definir os jogadores
$jogador1 = new Jogador("Jogador 1", "X");
$jogador2 = new Jogador("Jogador 2", "O");

// Iniciar o jogo
$jogo = new JogoDaVelha($jogador1, $jogador2);
$jogadorAtual = $jogo->getTurno();

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['linha']) && isset($_POST['coluna'])) {
    // Obter as coordenadas enviadas pelo jogador
    $linha = $_POST['linha'];
    $coluna = $_POST['coluna'];

    // Iniciar o jogo se as coordenadas estiverem dentro dos limites do tabuleiro
    if ($linha >= 0 && $linha < 3 && $coluna >= 0 && $coluna < 3) {
        // Verificar se é o turno do jogador atual
        if ($jogo && $jogo->getTurno() === $jogadorAtual) {
            $jogo->verificarVencedor();
            // Fazer a jogada
            $jogo->jogar($linha, $coluna);
            // Alternar o turno para o próximo jogador
            $jogo->alternarTurno();
        }
    }
}

// Obter o jogador atual
$jogadorAtual = $jogo->getTurno();

// Verificar o vencedor
$vencedor = $jogo->getVencedor();
$tabuleiro = $jogo->getTabuleiro();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Velha</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            width: 50px;
            height: 50px;
            text-align: center;
            border: 1px solid black;
        }

        .vencedor {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <h1>Jogo da Velha</h1>
    <?php if ($vencedor) : ?>
        <p class="vencedor">Vencedor: <?php echo $vencedor; ?></p>
    <?php else : ?>
        <p>É a vez de <?php echo $jogadorAtual->getNome(); ?></p>
    <?php endif; ?>

    <table>
        <?php for ($i = 0; $i < 3; $i++) : ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j++) : ?>
                    <td>
                        <?php if ($tabuleiro[$i][$j] != '') : ?>
                            <?php echo $tabuleiro[$i][$j]; ?>
                        <?php else : ?>
                            <form method="post" action="">
                                <input type="hidden" name="linha" value="<?php echo $i; ?>">
                                <input type="hidden" name="coluna" value="<?php echo $j; ?>">
                                <button type="submit"></button>
                            </form>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</body>

</html>
