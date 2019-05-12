$(document).ready(function(){
    $(document).on("click",".exportarexcel",function(e){
        e.preventDefault();
        var c=$(this).attr("data-rel");
        fnExcelReport(c);
    });
    $(document).ajaxStart(function() {
		$("#CuadroCargador").fadeIn('slow');
    });
    $(document).ajaxStop(function() {
		$("#CuadroCargador").fadeOut('slow');
	});
    //$(".menuopcion[rel="+(Cookies.get("Opcion"))+"]").parent().addClass("active");
    $(".seleccionar").select2();
});