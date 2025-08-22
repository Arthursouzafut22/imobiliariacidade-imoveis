<!doctype html>
<html lang="pt-br">
<head>
    
<?php $render('scripts-header', $script); ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CONFIGURAÇÕES DE COMPARTILHAMENTO DE LINK -->
    <meta property="og:title" content="Página não encontrada | <?= IMOBILIARIA ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Página não encontrada | <?= IMOBILIARIA ?>" />
    <meta property="og:url" content="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>" />
    <meta property="og:image" content="<?= $base ?>assets/img/logo.png" />

    <title>Página não encontrada | <?= IMOBILIARIA ?></title>

    <meta name="description" content="Página não encontrada | <?= IMOBILIARIA ?>" />
    <meta name="robots" content="noindex" />

    <link rel="canonical" href="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>" />

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="<?= $base ?>assets/img/favico.ico" type="image/x-icon?v=1.0">

    <!--IMPORT BOOSTRAP-->
    <link rel="stylesheet" href="<?= $base ?>assets/lib/bootstrap450/css/bootstrap.min.css?v=<?=VERSAO?>" />

    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css?v=<?=VERSAO?>" />
    <link rel="stylesheet" href="<?= $base ?>assets/css/404.css?v=<?=VERSAO?>" />

    <?php $render('scripts-pos-header', $script); ?>

</head>
<body>

<?php $render('scripts-body-inicial', $script); ?>

    <!-- IMPORTAÇÃO DO HEADER -->
    <?php $render('header', $configuracoes); ?>
    <div class="container-fluid">
        <div id="banner-anuncie" class="row justify-content-around">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1 class="titulo_principal text-center" style="font-size:30px">Página não encontrada</h1>
                    </div>
                    <div class="container-link">
                        <h6 class="text-center">Encontre mais imóveis em sua região</h6>
                        <div>
                            <a id="link-ver-mais-destaque" href="<?= $base ?>venda" class="btn btn-light btn-lg btn-primario-light">buscar imóveis</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- IMPORTAÇÃO DO FOOTER -->
    <?php $render('footer', $configuracoes); ?>
    <?php $render('whatsapp', $configuracoes); ?>

    <script src="<?= $base ?>assets/lib/jquery.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/utils.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/lib/bootstrap450/js/bootstrap.min.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/home/favoritos.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/objImovel.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/menu.js?v=<?= VERSAO ?>"></script>
    <script src="<?= $base ?>assets/js/404/index.js?v=<?= VERSAO ?>"></script>

    <?php $render('scripts-footer', $script) ?>

</body>
</html>