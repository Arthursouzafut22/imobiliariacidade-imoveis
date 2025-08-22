<!doctype html>
<html lang="pt-br">

<?php
// O endereço da URL que você deseja chamar
$url = BASE_URL_CMS . 'configuracao_cms_'.ROTA.'.json'; // Substitua pela sua URL

// Inicializa uma nova sessão cURL
$ch = curl_init();

// Configurações da sessão cURL
curl_setopt($ch, CURLOPT_URL, $url); // Define a URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta como string em vez de imprimir

// Executa a chamada cURL
$respostajson = curl_exec($ch);

// Verifica se ocorreu algum erro
if (curl_errno($ch)) {
    echo 'Erro cURL: ' . curl_error($ch);
} else {
    // Exibe a resposta
    // echo 'Resposta: ' . $respostajson;
}

// Fecha a sessão cURL
curl_close($ch);

$respostajson = json_decode($respostajson);
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--IMPORT COMUM-->
    <link rel="stylesheet" href="assets/lib/bootstrap450/css/bootstrap.min.css?v=<?=time()?>" />
    <link rel="stylesheet" href="assets/css/style.css?v=<?=time()?>" />
    <!-- IMPORTAÇÃO DA PAGINA -->
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            gap: 1.5rem;
        }

        h1 {
            margin-bottom: 1rem;
        }

        p {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            text-align: center;
        }

        img {
            width: 300px;
            max-width: 100%;
            margin-bottom: 1rem;
        }

        button {
            padding-left: 24px;
            padding-right: 24px;
            height: 40px;
            border-radius: 24px;
            border: none;
            border: 1px solid black;
            background-color: #fff;
        }

        strong {
            font-size: 2rem;
        }

        span {
            font-size: 1.5rem;
        }

        .card-info {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
            flex-direction: column;
            width: 100%;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cont-titulo">
                    <div class="text-center">
                        <img src="<?= $respostajson->logo ?>" alt="">
                        <h1>Aviso de Manutenção</h1>
                    </div>
                    <p>Estamos realizando atualizações em nosso site. Pedimos desculpas pela inconveniência e
                        agradecemos sua paciência, tente novamente mais tarde!</p>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="card-info">
                    <strong>Telefone</strong>
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $respostajson->tel_fixo ) ?>">
                        <span><?= $respostajson->tel_fixo ?></span>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="card-info">
                    <strong>E-mail</strong>
                    <a href="mailto:<?= preg_replace('/[^0-9]/', '', $respostajson->email ) ?>">
                        <!-- <button> -->
                        <span><?= $respostajson->email ?></span>
                        <!-- </button> -->
                    </a>
                </div>
            </div>
        </div>
        <div class="container-info">

            <a href="<?= BASE_URL ?>">
                <button>
                    <span>Tentar acessar o site</span>
                </button>
            </a>
        </div>
    </div>
</body>

</html>