<?php

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/postagens2', function () {
    echo "Lista postagens";
});

// definindo o id como opcional com o []
$app->get('/usuarios[/{id}]', function ($request, $response) {
    $id = $request->getAttribute('id');

    //Verificar se ID é valido e existe no BD

    echo "Lista de usuarios ou ID: " . $id;
});

$app->get('/postagens[/{ano}[/{mes}]]', function ($request, $response) {
    $ano = $request->getAttribute('ano');
    $mes = $request->getAttribute('mes');

    //Verificar se ID é valido e existe no BD

    echo "Lista de postagens Ano: " . $ano . " mes: " . $mes;
});

$app->get('/lista/{itens: .*}', function ($request, $response) {
    $itens = $request->getAttribute('itens');

    //Verificar se ID é valido e existe no BD

    echo $itens;
    echo '<pre>';
    var_dump(explode('/', $itens));
    echo '</pre>';
});

//Nomear Rotas
$app->get('/blog/postagens/{id}', function ($request, $response) {
    echo "Listar postagem para um ID ";
})->setName("blog");

$app->get('/meusite', function ($request, $response) {
    $retorno = $this->get("router")->pathFor("blog", ["id" => "10"]);
    echo $retorno;
});


//Agrupar Rotas
$app->group('/v1', function () {

    $this->get('/usuarios', function () {
        echo "Lista de usuarios";
    });

    $this->get('/postagens', function () {
        echo "Lista de postagens";
    });

});


$app->run()

?>