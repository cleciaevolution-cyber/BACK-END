
<?php

$arquivo = "produtos.txt";

// CADASTRO DO PRODUTO
if (isset($_POST["nome"])) {

    // Recebe nome e preço
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];

    // Recebe a imagem
    $foto = $_FILES["foto"];

    // Nome da imagem 12321321_monitor.jpg
    $nomeImagem = time() . "_" . $foto["name"];

    // Caminho onde a imagem será salva  uploads/12321321_monitor.jpg
    $caminho = "uploads/" . $nomeImagem;

    // Move a imagem para a pasta uploads
    move_uploaded_file(
        $foto["tmp_name"],
        $caminho
    );

    // Monta a linha do produto
    $linha = $nome . "|" . $preco . "|" . $caminho . PHP_EOL;

    // Salva no arquivo sem apagar os produtos anteriores
    file_put_contents(
        $arquivo,
        $linha,
        FILE_APPEND
    );
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Catálogo de Produtos</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1>Cadastro de Produtos</h1>

    <!-- FORMULÁRIO -->
    <form method="POST" enctype="multipart/form-data">

        <label>Nome do produto:</label>
        <br>

        <input type="text" name="nome">

        <br><br>

        <label>Preço:</label>
        <br>

        <input type="text" name="preco">

        <br><br>

        <label>Imagem:</label>
        <br>

        <input type="file" name="foto">

        <br><br>

        <button type="submit">
            Cadastrar
        </button>

    </form>

    <hr>

    <h1>Produtos cadastrados</h1>[
    
    <div class="container">

    <?php

    // Verifica se o arquivo existe
    if (file_exists($arquivo)) {

        // Lê o arquivo
        $produtos = file($arquivo);

        // Percorre cada produto
        foreach ($produtos as $produto) {

            // Separa os dados pelo |
            $dados = explode("|", $produto);

            // Remove espaços/quebra de linha do caminho
            $imagem = trim($dados[2]);

            // Cria o card
            echo "<div class='card'>

            <img src='$imagem' width='200'>

            <h2>$dados[0]</h2>

            <p>R$ $dados[1]</p>

            </div>";

            echo "<hr>";
        }
    }

    ?>

</div>

</body>

</html>
```
