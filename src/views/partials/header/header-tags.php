<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<title>
    <?= $meta_titulo_pagina == "" ? $titulo_pagina : $meta_titulo_pagina ?>
</title>
<meta name="description" content="<?= $meta_descricao_pagina ?>" />
<meta name="robots" content="index" />


<!-- CONFIGURAÇÕES DE COMPARTILHAMENTO DE LINK -->
<meta property="og:title" content="<?= $meta_titulo_pagina == "" ? $titulo_pagina : $meta_titulo_pagina ?>" />
<meta property="og:type" content="website" />
<meta property="og:description" content="<?= $meta_descricao_pagina?>" />
<meta property="og:url" content="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"]?>" />
<meta property="og:image" content="<?= isset($imagem_og) ? $imagem_og : IMAGEM_OG_PADRAO ?>" />
<meta property="og:image:width" content="135">
<meta property="og:image:height" content="135">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://<?=$_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"]?>">
<meta property="twitter:title" content="<?= $meta_titulo_pagina == "" ? $titulo_pagina : $meta_titulo_pagina ?>">
<meta property="twitter:description" content="<?= $meta_descricao_pagina ?>">
<meta property="twitter:image" content="<?= isset($imagem_og)  ? $imagem_og : IMAGEM_OG_PADRAO ?>">
<link rel="canonical" href="https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>" />

<!-- Favicon icon -->
<link rel="shortcut icon" href="<?= isset($favicon) && !empty($favicon) ? $favicon : $base . 'assets/img/favico.ico' ?>" type="image/x-icon?v=1.0">