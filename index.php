<?php

use MyApp\View;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as Capsule;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();
$container['db'] = function () {

    $capsule = new Capsule;
    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'slim',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    
    return $capsule;
};

$app->get('/usuarios', function (Request $request, Response $response) {
    $db = $this->get('db');
    //Criar Tabela
    // $db->schema()->dropIfExists('usuarios');
    // $db->schema()->create('usuarios', function($table) {
    //     $table->increments('id');
    //     $table->string('nome');
    //     $table->string('email');
    //     $table->timestamps();
    // });

    //Inserir dados para a tabela usuarios
    // $db->table('usuarios')->insert([
    //     'nome' => 'Jamilton Damasceno',
    //     'email' => 'jamilton@gmail.com'
    // ]);

    //Atualizar
    // $db->table('usuarios')->where('id', 1)->update([
    //     'nome' => 'Jorge',
    // ]);

    //Deletar
    // $db->table('usuarios')->where('id', 2)->delete();

    //Listar
    $usuarios = $db->table('usuarios')->get();
    foreach($usuarios as $usuario) {
        echo $usuario->nome . '<br>';

    }
});



$app->run();

//-----------------------------------------------------------------------------------------

//Tipos de respostas: cabecalho, texto, json, xml

// $app->get('/header', function (Request $request, Response $response) {
//     $response->write('Esse e um retorno header');
//     return $response->withHeader('allow', 'PUT')->withAddedHeader('Content-Length', 10);
// });

// $app->get('/json', function (Request $request, Response $response) {
//     return $response->withJson([
//         "nome" => "Cauan",
//         "endereco" => "Endereco tal.."
//     ]);
// });

// $app->get('/xml', function (Request $request, Response $response) {
//     $xml = file_get_contents('arquivo');
//     $response->write($xml);

//     return $response->withHeader('Content-Type', 'application/xml');
// });


//-----------------------------------------------------------------------------------------

//Middleware

// $app->add( function($request, $response, $next) {
//     $response->write('Inicio camada 1 + ');
//     // return $next($request, $response);
//     $response = $next($request, $response);
//     $response->write(' + Fim da camada 1');
//     return $response;
// });

// $app->add( function($request, $response, $next) {
//     $response->write('Inicio camada 2 + ');
//     // return $next($request, $response);
//     $response = $next($request, $response);
//     $response->write(' + Fim da camada 2');
//     return $response;
// });


// $app->add( function($request, $response, $next) {
//     $response->write('Inicio camada 2 + ');
//     return $next($request, $response);
// });

// $app->get('/usuarios', function (Request $request, Response $response) {
//     $response->write('Acao principal usuarios');

// });

// $app->get('/postagens', function (Request $request, Response $response) {
//     $response->write('Acao principal postagens');

// });


//-----------------------------------------------------------------------------------------


//Container depency injection

// class Servico {}
// $servico = new Servico();

// //Container Pimple
// $container = $app->getContainer();
// $container['Home'] = function () {
//     return new MyApp\controllers\Home(new MyApp\View);
// };

// $app->get('/servico', function (Request $request, Response $response) {
//     $servico = $this->get('servico');
//     var_dump($servico);
// });

// //Controllers como servico
// $app->get('/usuario', 'Home:index');


//-----------------------------------------------------------------------------------------

//Padrao PSR7

// $app->get('/postagens', function (Request $request, Response $response) {
//     //Escreve no corpo da resposta utilizando o padrao PSR7
//     $response->getBody()->write("Lista postagens");
//     return $response;
//     //echo "";
// });

//-----------------------------------------------------------------------------------------

/* 
Tipos de requisicao ou Verbos HTTP

get -> Recuperar recursos no servidor (Select)
post -> Criar dados no servidor (Insert)
put -> Atualizar dados no servidor (Update)
delete -> Deletar dados no servidor (Delete)

*/

// $app->delete('/usuarios/remove/{id}', function (Request $request, Response $response) {

//     $id = $request->getAttribute('id');
//     return $response->getBody()->write("Sucesso ao deletar " . $id);
// });

// $app->put('/usuarios/atualiza', function (Request $request, Response $response) {
//     //Recupera post ($_POST)
//     $post = $request->getParsedBody();
//     $id = $post['id'];
//     $nome = $post['nome'];
//     $email = $post['email'];


//     return $response->getBody()->write("Sucesso ao atualizar " . $id);
// });

// $app->post('/usuarios/adiciona', function (Request $request, Response $response) {
//     //Recupera post ($_POST)
//     $post = $request->getParsedBody();
//     $nome = $post['nome'];
//     $email = $post['email'];
//     return $response->getBody()->write($nome . " - " . $email);
// });


//------------------------------------------------------------------------------------


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
