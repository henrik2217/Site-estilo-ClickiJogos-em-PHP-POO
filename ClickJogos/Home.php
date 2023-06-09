<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS.css">
    <title>ClickJogos</title>
</head>
<body>
    <h1>ClickJogos<h1>
        <form action="Home.php" method="post">
            Insira nome de usuário:<label for="usuario"></label>
            <input type="text" id="usuario" name="usuario" required> <br>
            <input type="submit" value="Enviar">
        </form>
        <h3>Selecione um jogo:<h3>

        <img src="Imagens/adivinha.jpg" title="Adivinha um número" width="500">
        <a href="Adivinha.php"></a>
        <img src="Imagens/Jo-Ken-Po.png" title="JoKenPo">
        <img src="Imagens/par_ou_impar.png" title="Par ou Ímpar" width="270">
        <img src="Imagens/velha.jpg" title="Jogo da Velha" width="300"> <br>




</body>
</html>

<?php 
$nome = $_POST['usuario'];
echo "Seja bem-vindo $nome <br>";
echo "Se interessar saber as regras dos jogos, aqui há uma pequena explicação sobre ";