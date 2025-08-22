
$('.btn_recente_popular').click(function(){

    $('.btn_recente_popular').removeClass('active-button');
    $(this).addClass('active-button')

    $('.container-posts-populares').removeClass('posts_destaques_active');
    $('.container-posts-recentes').removeClass('posts_destaques_active');

    if($(this).text() == 'DESTAQUES'){
        $('.container-posts-populares').addClass('posts_destaques_active');
    }else{
        $('.container-posts-recentes').addClass('posts_destaques_active');
    }
})



