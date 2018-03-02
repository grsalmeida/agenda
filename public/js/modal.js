$(document).ready(function () { 
	//adiciona modal cadastar
  	$("body").delegate("#adicionar", "click", function (e) {
        $('.modal').fadeIn();
        $('.modal').hide();
        $("input").val('');
        $("#divForm").find(".cadastrar").attr("id", "cadastrar").text("Cadastrar");
        $("#divForm").show();
    });
      // abre o modal editar
    $("body").delegate(".editar", "click", function (e) {
        $('.modal').fadeIn();
        $('.modal').hide();
        $("#divForm").find(".cadastrar").attr("id", "editar").text("Editar");
        $("input").val('');
        $("#divForm").show();
        var id = $(this).data('id');
        $("#form").find("#id").val(id);
        var inputs = $("#form").find("input:visible");
        var pessoa = $('#'+ id).find("td");
        for (var i = 0; i < (pessoa.length - 1); i++) {
            $(inputs[i]).val($(pessoa[i]).text());
        }
    });

    //abre modal para remover
 	$("body").delegate(".deletar", "click", function (e) {
        $('.modal').fadeIn();
        $('.modal').hide();
        $("#deletar").show();
        $("#deletar").find('input').val($(this).data('id'));
    });
     //evento de cancelar na hora de remover
    $('.close, #cancelar').on("click", function () {
        $('.modal').fadeIn();
        $(".modal").hide();
        $("#form").find("input").removeClass("error");
    });
});