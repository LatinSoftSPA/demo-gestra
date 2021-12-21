$(document).ready(function(){
    function actualizarHora(){
        const fechaActual = new Date();
        //const horaActual = fechaActual.toTimeString().slice(0, 8);
        const horaActual = fechaActual.toLocaleTimeString();
        
        $(".txtHora").text(horaActual);
    }
    setInterval(function(){ actualizarHora(); }, 1000);
});
