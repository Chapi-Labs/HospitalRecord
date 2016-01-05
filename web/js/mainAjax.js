function ajaxAO()
{
    $('body').on('submit', '.ajaxFormAO', function (e) {

        e.preventDefault();
        

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
           
            dataOptions = data[0];
            dataIds     = data[1];
            
            // Get the raw DOM object for the select box
            select = document.getElementById('paciente_form_clasificacionAO');
            // Clear the old options
            select.options.length = 0;

            // Load the new options
            // Or whatever source information you're working with
            for (var index = 0; index < dataOptions.length; index++) {
                option = dataOptions[index];
                opt1 = document.createElement("option");
                opt1.text = option['key'];
                opt1.value = dataIds[index]['value'];
               
                
                select.options.add(opt1);
            }
            
            
            $('#myModal').modal('hide');
         }
        })
        .done(function (data) {
            if (typeof data.message !== 'undefined') {
                alert(data.message);
            }
            
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    $('#form_body').html(jqXHR.responseJSON.form);
                }

                $('.form_error').html(jqXHR.responseJSON.message);

            } else {
                alert(errorThrown);
            }

        });
    });
}
function ajaxProcedimiento()
{
    $('body').on('submit', '.ajaxFormProcedimiento', function (e) {

        e.preventDefault();
        

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
           
            dataOptions = data[0];
            dataIds     = data[1];
            
            // Get the raw DOM object for the select box
            select = document.getElementById('paciente_form_procedimientoRealizado');
            // Clear the old options
            select.options.length = 0;

            // Load the new options
            // Or whatever source information you're working with
            for (var index = 0; index < dataOptions.length; index++) {
                option = dataOptions[index];
                opt1 = document.createElement("option");
                opt1.text = option['key'];
                opt1.value = dataIds[index]['value'];
               
                
                select.options.add(opt1);
            }
            
            
            $('#modalProcedimiento').modal('hide');
         }
        })
        .done(function (data) {
            if (typeof data.message !== 'undefined') {
                alert(data.message);
            }
            
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    $('#form_body').html(jqXHR.responseJSON.form);
                }

                $('.form_error').html(jqXHR.responseJSON.message);

            } else {
                alert(errorThrown);
            }

        });
    });
}