<?php
// Função recursiva para listar todos os arquivos .html
function listarArquivos($dir) {
    $arquivos = [];
    // Usamos RecursiveIteratorIterator para navegar em todas as subpastas
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($it as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) == 'html') {
            // Armazenar o caminho completo do arquivo
            $arquivos[] = $file;
        }
    }
    return $arquivos;
}

// Diretório base onde estão as pastas dos alunos
$diretorioAlunos = './';

// Pegando a lista de arquivos HTML
$arquivosHTML = listarArquivos($diretorioAlunos);

// Função para extrair o nome do aluno (nome da pasta)
function obterNomeAluno($arquivo) {
    return basename(dirname($arquivo));
}

// Ordena a lista de arquivos com base no nome da pasta (nome do aluno)
usort($arquivosHTML, function($a, $b) {
    return strcasecmp(obterNomeAluno($a), obterNomeAluno($b));
});
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Perfis dos Alunos</title>
    
    <!-- Incluindo Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Perfis dos Alunos</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h2 class="mb-4 text-center">Lista de Perfis dos Alunos de Computação- 2º Médio 2024</h2>
                
                <div class="list-group">
                    <?php
                    // Para cada arquivo HTML encontrado
                    foreach ($arquivosHTML as $arquivo) {
                        // Pega o nome da pasta (nome do aluno)
                        $nomeAluno = obterNomeAluno($arquivo);
                        
                        // Gera o link completo
                        $link = str_replace('\\', '/', $arquivo); // Corrige barras invertidas para barras normais
                        //$link = urlencode($link); // Codifica o link para evitar problemas com espaços

                        // Exibe o link como item de lista com Bootstrap
                        echo "<a href='$link' target='_blank' class='list-group-item list-group-item-action'>
                                <strong>$nomeAluno</strong>
                              </a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluindo Bootstrap JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
