<?php
include('header.php'); // Inclui o header.php

// Função para determinar o signo com base na data de nascimento e no arquivo XML
function determinarSigno($data_nascimento) {
    // Carrega o arquivo XML
    $xml = simplexml_load_file('sign.xml') or die("Erro: Não foi possível carregar o arquivo XML.");

    // Converte a data de nascimento para o formato "m-d"
    $data_nascimento_formatada = date('m-d', strtotime($data_nascimento));

    // Itera sobre os signos no XML
    foreach ($xml->signo as $signo) {
        $dataInicio = trim((string)$signo->dataInicio); // Formato "d/m"
        $dataFim = trim((string)$signo->dataFim); // Formato "d/m"

        // Converte as datas do XML para o formato "m-d" para comparação
        $dataInicioFormatada = DateTime::createFromFormat('d/m', $dataInicio)->format('m-d');
        $dataFimFormatada = DateTime::createFromFormat('d/m', $dataFim)->format('m-d');

        // Verifica se o intervalo de datas passa de um ano para o outro (ex: Capricórnio)
        if ($dataInicioFormatada > $dataFimFormatada) {
            // Caso especial: intervalo que passa de um ano para o outro
            if ($data_nascimento_formatada >= $dataInicioFormatada || $data_nascimento_formatada <= $dataFimFormatada) {
                return $signo;
            }
        } else {
            // Caso normal: intervalo dentro do mesmo ano
            if ($data_nascimento_formatada >= $dataInicioFormatada && $data_nascimento_formatada <= $dataFimFormatada) {
                return $signo;
            }
        }
    }

    // Caso não encontre o signo
    return null;
}

// Recebe os dados do formulário
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];

// Determina o signo
$signo = determinarSigno($data_nascimento);

// Se o signo não for encontrado, exibe uma mensagem de erro
if (!$signo) {
    die("Signo não encontrado para a data de nascimento fornecida.");
}

// Carrega a imagem do signo
$signoAlterado = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', trim($signo->signoNome))));
$caminhoImagem = "../assets/imgs/{$signoAlterado}.png";

// Verifica se a imagem existe
if (!file_exists($caminhoImagem)) {
    die("A imagem do signo não foi encontrada: {$caminhoImagem}");
}
?>

<div class="container mt-5">
    <h1 class="text-center">Olá, <?php echo $nome; ?>!</h1>
    <p class="text-center">Seu signo é: <strong><?php echo trim($signo->signoNome); ?></strong></p>

    <!-- Grid para imagem e descrição -->
    <div class="row">
        <!-- Coluna da imagem -->
        <div class="col-md-4">
            <img src="<?php echo $caminhoImagem; ?>" alt="<?php echo trim($signo->signoNome); ?>" class="img-fluid">
        </div>
        <!-- Coluna da descrição -->
        <div class="col-md-8">
            <p class="text-justify"><?php echo trim($signo->descricao); ?></p>
        </div>
    </div>

    <!-- Botão de voltar -->
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Voltar à Página Inicial</a>
    </div>
</div>

</body>
</html>