<?php

spl_autoload_register(function($className) {
    $filePath = str_replace('\\', '/', $className).'.php';

    if (!str_starts_with($filePath, 'App/')) {
        die("O namespace das classes deve começar sempre com \"App/\", e as classes devem ser 
        declaradas sempre no diretório App.");
    }

    if (file_exists($filePath)) {
        include $filePath;
        return;
    }

    die("Nenhum arquivo \"$filePath\" foi encontrado. Verifique se o nome do arquivo coincide com
    o nome da classe ou se a rota do arquivo solicitado foi definida corretamente.");
});