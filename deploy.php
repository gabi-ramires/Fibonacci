<?php

$hash = md5($_GET['senha']);

if ($hash == 'd1aa72f9cae9ff4a4377fc58a5ae2fe9') {
    //Removendo o backup
    function deleteDirectory($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $path = $dir . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($path)) {
                        //Se for um diretório, chame a função recursivamente
                        deleteDirectory($path);
                    } else {
                        //Se for um arquivo, exclua-o
                        unlink($path);
                    }
                }
            }
            //Após excluir todos os arquivos e subdiretórios, exclua o diretório principal
            rmdir($dir);
        }
    }

    //Use a função para excluir um diretório e seu conteúdo
    deleteDirectory('../htdocs');

    //Diretório de destino onde você deseja implantar o repositório
    rename('../htdocs','../htdocs_old');

    $destino = '../';

    // URL do arquivo ZIP do repositório do GitHub (main.zip)
    $githubZipUrl = 'https://github.com/gabi-ramires/Fibonacci/archive/refs/heads/main.zip';

    // Extraindo nome do projeto
    $pattern = '/gabi-ramires\/(.*?)\/archive/';
    if (preg_match($pattern, $githubZipUrl, $matches)) {
        $projeto = $matches[1];
        echo $projeto."<br>";
    } else {
        echo "Nome do projeto não encontrado.";
    }


    // Extraindo "main" ou "master"
    $pattern = '/\/refs\/heads\/(main|master)\.zip/i';
    if (preg_match($pattern, $githubZipUrl, $matches)) {
        $branch = $matches[1];
        echo $branch."<br>";
    } else {
        echo "Palavra main/master não encontrada.";
    }


    // Nome do arquivo ZIP local
    $zipFilename = '../htdocs.zip';

    echo "Baixando o zip...<br>";
    // Baixar o arquivo ZIP do GitHub
    file_put_contents($zipFilename, file_get_contents($githubZipUrl));

    // Descompactar o arquivo ZIP no diretório de destino
    $zip = new ZipArchive;
    if ($zip->open($zipFilename) === TRUE) {
        $zip->extractTo($destino);
        $zip->close();
        echo "Excluindo zip...<br>";
        unlink($zipFilename); // Excluir o arquivo ZIP após a extração
        echo "<span style='color: green;'>Zip excluido!</span><br>";

        echo "Renomeando...<br>";
        rename('../'.$projeto.'-'.$branch.'','../htdocs');
        echo "<span style='color: green;'>Renomeado!</span><br>";

        echo "<span style='color: green;'>Repositório implantado com sucesso!</span><br>";
    } else {
        echo "<span style='color: red;'>Falha ao implantar o repositório.</span><br>";
    }

    echo '<br><br><a href="./">Voltar</a>';
} else {
    echo "Página restrita!! Cai fora....";
}



