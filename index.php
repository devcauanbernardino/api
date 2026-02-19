<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

//Padrao PSR7
$app->get('/postagens', function (Request $request, Response $response) {
    //Escreve no corpo da resposta utilizando o padrao PSR7
    $response->getBody()->write("Lista postagens");
    return $response;
    //echo "";
});

/* 
Tipos de requisicao ou Verbos HTTP

get -> Recuperar recursos no servidor (Select)
post -> Criar dados no servidor (Insert)
put -> Atualizar dados no servidor (Update)
delete -> Deletar dados no servidor (Delete)

*/

$app->delete('/usuarios/remove/{id}', function (Request $request, Response $response) {
    
    $id = $request->getAttribute('id');
    return $response->getBody()->write("Sucesso ao deletar " . $id);
});

$app->put('/usuarios/atualiza', function (Request $request, Response $response) {
    //Recupera post ($_POST)
    $post = $request->getParsedBody();
    $id = $post['id'];
    $nome = $post['nome'];
    $email = $post['email'];


    return $response->getBody()->write("Sucesso ao atualizar " . $id);
});

$app->post('/usuarios/adiciona', function (Request $request, Response $response) {
    //Recupera post ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];
    return $response->getBody()->write($nome . " - " . $email);
});

$app->run()

// $app->get('/postagens2', function () {
//     echo "Lista postagens";
// });

// // definindo o id como opcional com o []
// $app->get('/usuarios[/{id}]', function ($request, $response) {
//     $id = $request->getAttribute('id');

//     //Verificar se ID é valido e existe no BD

//     echo "Lista de usuarios ou ID: " . $id;
// });

// $app->get('/postagens[/{ano}[/{mes}]]', function ($request, $response) {
//     $ano = $request->getAttribute('ano');
//     $mes = $request->getAttribute('mes');

//     //Verificar se ID é valido e existe no BD

//     echo "Lista de postagens Ano: " . $ano . " mes: " . $mes;
// });

// $app->get('/lista/{itens: .*}', function ($request, $response) {
//     $itens = $request->getAttribute('itens');

//     //Verificar se ID é valido e existe no BD

//     echo $itens;
//     echo '<pre>';
//     var_dump(explode('/', $itens));
//     echo '</pre>';
// });

// //Nomear Rotas
// $app->get('/blog/postagens/{id}', function ($request, $response) {
//     echo "Listar postagem para um ID ";
// })->setName("blog");

// $app->get('/meusite', function ($request, $response) {
//     $retorno = $this->get("router")->pathFor("blog", ["id" => "10"]);
//     echo $retorno;
// });


// //Agrupar Rotas
// $app->group('/v1', function () {

//     $this->get('/usuarios', function () {
//         echo "Lista de usuarios";
//     });

//     $this->get('/postagens', function () {
//         echo "Lista de postagens";
//     });

// });




?>