<?php
//script que vem do CMS
echo $pos_body;
?>

<!-- inputs globais -->
<input type="hidden" id="DISPOSITIVO_MOBILE" value="<?= DISPOSITIVO_MOBILE ?>" />

<!-- OS VALORES DAS VARIAVEIS ESTÃO NA CONFIG -->
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "<?= IMOBILIARIA ?>",
    "description": "<?= DESCRIPTION ?>",
    "address": {
      "@type": "PostalAddress",
      "addressCountry": {
        "@type": "Country",
        "name": "BR"
      },
      "addressLocality": "<?= ADDRESSLOCALITY ?>",
      "addressRegion": "<?= ADDRESSREGION ?>"
    },
    "brand": {
      "@type": "Brand",
      "logo": "<?= $base ?>assets/images/logo-link.png"
    },
    "URL": "https://<?= $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] ?>"
  }
</script>


<?php if (CHAT != 0) : ?>

  <script type="text/javascript">
    (function(window, document, caminhoJS, caminhoCsss) {
      try {
        var head = document.head || document.getElementsByTagName("head")[0],
          css = document.createElement("link");
        css.setAttribute("type", "text/css");
        css.setAttribute("rel", "stylesheet");
        css.setAttribute("href", caminhoCsss);

        script = document.createElement("script");
        script.setAttribute("type", "text/javascript");
        script.setAttribute("src", caminhoJS);

        head.appendChild(script);
        head.appendChild(css);
        document.write('<div id="chatbot-imoview"></div>');
        script.onload = function() {
          IMOVIEW.Exec({
            corFundo: "#001b5f", //Opcional - Cor hexadecimal primária do chat, recomendamos a cor primário do site.
            avatarUrlChat: "https://s3.imoview.com.br/avatar.jpg", //Cole a URL completa do avatar que aparecerá no chat ao abri-lo"
            mensagemChatFechado: "Como posso te ajudar?", //Texto que irá aparecer para o cliente clicar no chat
            posicao: "esquerda", //Lado que o botão ficará -- direito ou esquerda
            nomeHeaderChat: "ChatBot Universal", // Nome que aparecerá do chat ao abri-lo
            rota: "<?= ROTA ?>", //Rota da imobiliária - é obtido no sistema Imoview clicando no menu canto direito superior e clique em "Detalhes convênio"
          });
        };
      } catch (e) {}
    })

    (window, document, "https://api.imoview.com.br/scripts/externo/chatbot/chatbot-imoview.js?versao=<?= date('Ymd')  ?>", "https://api.imoview.com.br/scripts/externo/chatbot/chatbot.css?versao=<?= date('Ymd')  ?>");
  </script>
<?php endif ?>



<?php $render('cookie'); ?>