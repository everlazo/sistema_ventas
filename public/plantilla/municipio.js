$(function () {
    $('#select-departamento').on('change', onSelectDepartmentChange);
});

function onSelectDepartmentChange() {
    var id_depto = $(this).val();

    if(!id_depto){
        $('#select-ciudad').html('<option value="">Seleccione una ciudad</option>');
        return;
    }

    //AJAX
    $.get('/api/tercero/'+id_depto, function (data) {
        var html_select = '<option value="">Seleccione una ciudad</option>';
        for (var i=0; i<data.length; ++i)
        html_select += '<option value="'+data[i].id_dominio+'">'+data[i].nombre+'</option>';
        console.log(data[i]);
        $('#select-ciudad').html(html_select);

    });
};