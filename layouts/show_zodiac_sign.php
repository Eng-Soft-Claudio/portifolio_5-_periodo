<?php
include('header.php');
function determinarSigno($data_nascimento) {
    $xml = simplexml_load_file('sign.xml') or die("Erro: Não foi possível carregar o arquivo XML.");
    $data_nascimento_formatada = date('m-d', strtotime($data_nascimento));
    foreach ($xml->signo as $signo) {
        $dataInicio = trim((string)$signo->dataInicio);
        $dataFim = trim((string)$signo->dataFim);
        $dataInicioFormatada = DateTime::createFromFormat('d/m', $dataInicio)->format('m-d');
        $dataFimFormatada = DateTime::createFromFormat('d/m', $dataFim)->format('m-d');
        if ($dataInicioFormatada > $dataFimFormatada) {
            if ($data_nascimento_formatada >= $dataInicioFormatada || $data_nascimento_formatada <= $dataFimFormatada) {
                return $signo;
            }
        } else {
            if ($data_nascimento_formatada >= $dataInicioFormatada && $data_nascimento_formatada <= $dataFimFormatada) {
                return $signo;
            }
        }
    }
    return null;
}
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$signo = determinarSigno($data_nascimento);
if (!$signo) {
    die("Signo não encontrado para a data de nascimento fornecida.");
}
$signoAlterado = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', trim($signo->signoNome))));
$caminhoImagem = "../assets/imgs/{$signoAlterado}.png";
if (!file_exists($caminhoImagem)) {
    die("A imagem do signo não foi encontrada: {$caminhoImagem}");
}
?>
<div class="container mt-5">
    <h1 class="text-center">Olá, <?php echo $nome; ?>!</h1>
    <p class="text-center">Seu signo é: <strong><?php echo trim($signo->signoNome); ?></strong></p>
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo $caminhoImagem; ?>" alt="<?php echo trim($signo->signoNome); ?>" class="img-fluid">
        </div>
        <div class="col-md-8">
            <p class="text-justify"><?php echo trim($signo->descricao); ?></p>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Voltar à Página Inicial</a>
    </div>
</div>
</body>
</html>