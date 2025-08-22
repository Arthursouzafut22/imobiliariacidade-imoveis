//função de carregamento da pagina
function loadScripts(sources) {
    sources.forEach(function (src) {
        var script = document.createElement('script');
        script.src = src;
        script.rel= "preload";
        script.async = false; //<-- the important part
        document.body.appendChild(script); //<-- make sure to append to body instead of head 
    });
}

