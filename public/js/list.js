$(document).ready(function () { 
    // excuta de cadastrar
    //$('#str_telefone').mask('(99) 9999-9999');
    //$('#str_celular').mask('(99) 99999-9999');
    
    $("body").delegate("#cadastrar", "click", function (e) {
        e.preventDefault();
        var str_nome        =   $("#form").find("#str_nome").val().trim();
        var str_telefone   =   $("#form").find("#str_telefone").val().trim();
        var str_celular    =   $("#form").find("#str_celular").val().trim();
        var str_email    =   $("#form").find("#str_email").val().trim();
        var status = true;

        if(str_nome.length == 0){
           $("#form").find("#str_nome").addClass("error");
            status = false;
        } 

        if(str_celular.length == 0){
            $("#form").find("#str_celular").addClass("error");
            status = false;
        }

        if (status == false) {
            return;
        }
        $.ajax({
            url: "/cadastrar",
            type: "POST",
            data: {'str_nome':str_nome,'str_telefone':str_telefone,'str_celular':str_celular,'str_email':str_email},
            dataType: "JSON",
            success: function (data) {
                if (data !== 'undefined' && data != false) {
                    var html =  "<tr id='"+data+"' data-id='"+data+"'>";
                    html += "<td>"+str_nome+"</td>";
                    html += "<td>"+str_telefone+"</td>";
                    html += "<td>"+str_celular+"</td>";
                    html += "<td>"+str_email+"</td>";
                    html += "<td class='content-options'>";
                    html += "<div class='content-div-edit editar' title='Editar' data-id='"+data+"'><i class='fa fa-pencil fa-lg'></i></div>"; 
                    html += "<div class='content-div-remove deletar' title='Remover' data-id='"+data+"'><i class='fa fa-remove fa-lg'></i></div>";      
                    html += "</td></tr>";   
                    if($("#td-vazio").hasClass('vazio')!= false){
                        $("#td-vazio").remove();
                    }                         
                    $("tbody").append(html);
                    alert("Registro adicionado com sucesso");
                    $("#form").find("input").removeClass("error");
                }else{
                    alert('Erro ao cadastrar ao cadastrar o registrto!');
                }
            }
        });
        $(".modal").hide();
    });

    // excuta editar
    $("body").delegate("#editar", "click", function (e) {
         e.preventDefault();
        var str_nome        =   $("#form").find("#str_nome").val().trim();
        var str_telefone    =   $("#form").find("#str_telefone").val().trim();
        var str_celular     =   $("#form").find("#str_celular").val().trim();
        var str_email       =   $("#form").find("#str_email").val().trim();
        var id              =   $("#form").find("#id").val();
        var status = true;

        if(str_nome.length == 0){
           $("#form").find("#str_nome").addClass("error");
            status = false;
        }

        if(str_celular.length == 0){
            $("#form").find("#str_celular").addClass("error");
            status = false;
        }

        if (status == false) {
            return;
        }
        var formulario = $("#form").serializeArray();
        $.ajax({
            url: "/editar",
            type: "POST",
            data: {'id':id,'str_nome':str_nome,'str_telefone':str_telefone,'str_celular':str_celular,'str_email':str_email},
            dataType: "JSON",
            success: function (data) {
                if (data !== 'undefined' && data != false) {
                    var inputs = $("#form").find("input:visible");
                    var pessoas = $('#'+data).find("td");
                    for (var i = 0; i < (pessoas.length - 1); i++) {
                        $(pessoas[i]).text($(inputs[i]).val());
                    }
                    $(".modal").hide();
                    alert("Registro editado com sucesso");
                    $("#form").find("input").removeClass("error");
                }else{
                    alert("Houve um erro ao editar o registro!");
                }
            }
        });
    });
    // confirma excluir
    $("body").delegate("#sim", "click", function (e) {
        e.preventDefault();
        $.ajax({
            url: "/remover",
            type: "POST",
            data: {id: $("#idDeletar").val()},
            dataType: "JSON",
            success: function (data) {
                if (data !== 'undefined' && data != false) {
                    $("#"+ data).remove();
                    alert("Registro removido com sucesso");
                    $("#form").find("input").removeClass("error");
                }else{
                    alert("Houve um erro ao deletar o registro!");
                }
            }
        });
        $(".modal").hide();
    });
    $("body").delegate("#dash", "click", function(e){
        $(location).attr('href', '/admin/dashboard');
    });
});