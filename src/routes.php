<?php
use core\Router;
$router = new Router();

//PAGINA SOBRE A EMPRESA
$router->get('/sobre', 'SobreController@index');

//PAGINA SOBRE A EMPRESA
$router->get('/nossa-equipe', 'EquipeController@index');
$router->post('/retornar-detalhes-colaborador', 'EquipeController@retornarDetalhesColaborador');

//PAGINA CONDOMINIOS
$router->get('/condominio/{nome}/{id}', 'CondominioController@index');
$router->post('/get-condominio', 'CondominioController@getCondominio');
$router->get('/condominios', 'CondominioController@condominiosView');
$router->post('/get-condominios', 'CondominioController@getCondominios');
$router->post('/get-condominios-paginacao', 'CondominioController@getCondominiosPaginacao');
$router->post('/detalhe-condominio-enviar-lead-form', 'CondominioController@enviarLead');

$router->post('/retornar-tipos-disponiveis', 'TipoController@retornarTiposImoveisDisponiveis');
$router->post('/retornar-bairros-disponiveis', 'BairroController@retornarBairrosDisponiveis');
$router->post('/retornar-cidades-disponiveis', 'CidadeController@retornarCidadeDisponiveis');
$router->post('/retornar-enderecos-disponiveis', 'EnderecoController@retornarEnderecosDisponiveis');

$router->get('/retornar-bairros-codigo', 'BuscaBairrosController@retornarBuscaBairros');

//RETORNAR IMOVEIS DISPONÍVEIS
$router->post('/retornar-imoveis-disponiveis', 'ImovelController@retornarImoveisDisponiveis');
$router->post('/retornar-imoveis-disponiveis-mapa', 'ImovelController@retornarImoveisDisponiveisMapa');

$router->post('/retornar-imoveis-empreendimentos-filho', 'ImovelController@retornarImoveisEmpreendimentosFilhosDisponiveis');

//RETRNAR IMOVEIS POR CÓDIGO...
$router->post('/retornar-imoveis-codigo', 'ImovelController@retornarImovelCodigo');

//RETORNAR PARAMENTROS INSERIDOS NA URL
$router->post('/retornar-parametros-url', 'ImovelController@getParametrosURL');

//RETORNA TODAS AS REFERENCIAS TIPOS,BAIRROS,CIDADES
$router->post('/retornar-parametros-gerais', 'ImovelController@getParametrosGerais');

//RETORNAR LANCAMENTO
$router->post('/retornar-lancamentos', 'ImovelController@retornarImoveisLancamento');
$router->post('/retornar-destaques', 'ImovelController@retornarImoveisDestaques');
$router->post('/retornar-detalhe-imovel', 'ImovelController@imovelDetalhesDados');
//$router->post('/retornar-imoveis-similares','ImovelController@imovelDetalhesDados');

//RETORNAR SIMILARES
$router->post('/retornar-imoveis-similares', 'ImovelController@retornarImoveisSimilares');
$router->post('/detalhe-imovel-nao-achou-imovel-form', 'ImovelController@naoAchouImovel');

//ROTAS PARA CONTROLLER FAVORITOS
$router->post('/addFavoritos', 'FavoritosController@addFavoritos');
$router->post('/removerFavoritos', 'FavoritosController@removerFavoritos');
$router->post('/retornar-favoritos', 'FavoritosController@getFavoritos');

$router->get('/imoveis-favoritos', 'FavoritosController@index');
$router->get('/contato', 'ContatoController@index');
$router->post('/contato-form', 'ContatoController@enviarFormulario');

//CAPTACAO DE IMÓVEIS
$router->get('/captacao', 'AnuncieImovelController@captacaoRedirecionamento');
$router->get('/anuncie-seu-imovel', 'AnuncieImovelController@index');
$router->post('/anuncie-imovel-form', 'AnuncieImovelController@enviarCaptacao');

$router->get('/site-universal-software/','SitesUniversalSoftwareController@index');
$router->get('/site-universal-software','SitesUniversalSoftwareController@index');

$router->get('/trabalhe-conosco', 'TrabalheConoscoController@index');
$router->post('/trabalhe-conosco-form', 'TrabalheConoscoController@trabalheConoscoFormEnviarCurriculo');

$router->get('/ouvidoria', 'OuvidoriaController@index');
$router->post('/ouvidoria-form', 'OuvidoriaController@enviarOuvidoria');

//RETORNAR CALENDARIO
$router->post('/retornar-calendario', 'AgendaController@getCalendario');
$router->post('/retornar-horarios', 'AgendaController@getHorarios');

//INCLUIR VISITA 
$router->post('/detalhe-imovel-agendar-visita-form', 'AgendaController@agendarVisita');

//INCLUIR VISITA 
$router->post('/detalhe-imovel-incluir-lead-form', 'LeadController@incluirLead');

//PAGINAS DE OBRIGADO
$router->get('/obrigado/{rota}/{codigo}', 'ObrigadoController@index');
$router->get('/obrigado/{rota}/{codigo}/', 'ObrigadoController@index');

$router->get('/granvitta/', 'GranvittaController@index');
$router->get('/granvitta', 'GranvittaController@index');

$router->get('/documentos/', 'DocumentosController@index');
$router->get('/documentos', 'DocumentosController@index');

$router->get('/manutencao', 'ManutencaoController@index');
$router->get('/imovel-nao-encontrado', 'ImovelController@imovelNaoEncontrado');
$router->get('/politica-privacidade', 'PoliticaController@index');

$router->post('/retornar-campos-extas-disponiveis','CamposExtrasDisponiveisController@retornarCamposExtras');

//GERAR SITE MAPS DO SITE
$router->get('/atualizar-sitemap/', 'SitemapController@sitemap_xml');
$router->get('/atualizar-sitemap', 'SitemapController@sitemap_xml');

//BLOG
//$router->get('/blog', 'BlogController@index');
//$router->get('/blog/{url}/{codigopagina}','BlogController@detalhe');

//ROTA DE DETALHE DO IMÓVEL
$router->get('/imovel/{imovel}/{id}', 'ImovelController@detalhe');

//ROTAS PARA FILTRO DE IMÓVEIS
$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}/{condominio}/{opcaoimovel}/{param}/', 'ImovelController@index');
$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}/{condominio}/{opcaoimovel}/{param}', 'ImovelController@index');

$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}/{condominio}/{opcaoimovel}/', 'ImovelController@index');
$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}/{condominio}/{opcaoimovel}', 'ImovelController@index');

$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}/{condominio}/', 'ImovelController@index');
$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}/{condominio}', 'ImovelController@index');

$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}/', 'ImovelController@index');
$router->get('/{finalidade}/{tipos}/{cidades}/{bairros}', 'ImovelController@index');

$router->get('/{finalidade}/{tipos}/{cidades}/', 'ImovelController@index');
$router->get('/{finalidade}/{tipos}/{cidades}', 'ImovelController@index');

$router->get('/{finalidade}/{tipos}/', 'ImovelController@index');
$router->get('/{finalidade}/{tipos}', 'ImovelController@index');

$router->get('/{finalidade}/', 'ImovelController@index');
$router->get('/{finalidade}', 'ImovelController@index');

//PAGINA INICIAL
$router->get('/', 'HomeController@index');
