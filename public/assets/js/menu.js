
$('#close-menu-modal').click(function(){
    $('.modal-desktop').css('display','none')
})

var $listaMenu = $('.modal-desktop');
var $btnToggle = $('.btn-menu-m');

// Função para alternar a visibilidade da lista de bairros
$btnToggle.on('click', function (e) {

     $listaMenu.toggle();
    e.stopPropagation(); // Previne que o clique se propague para o document
});

// Função para fechar a lista de bairros ao clicar fora dela
$(document).on('click', function (e) {
    if (!$listaMenu.is(e.target) && $listaMenu.has(e.target).length === 0 && !$btnToggle.is(e.target)) {
        $listaMenu.hide();
    }
});

// Impede que cliques dentro da lista de bairros fechem a lista
$listaMenu.on('click', function (e) {
    e.stopPropagation();
});
