function onLoadCallback() {
    grecaptcha.render('captcha-tenho-interesse', {
        'sitekey': $('#captcha-tenho-interesse').attr('data-sitekey')
    });

    grecaptcha.render('captcha-imovel-ideal', {
        'sitekey': $('#captcha-imovel-ideal').attr('data-sitekey')
    });
   
    grecaptcha.render('captcha-agendar-visita', {
        'sitekey': $('#captcha-agendar-visita').attr('data-sitekey')
    });
   
}
