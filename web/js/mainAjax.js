function initAjaxForm()
{
    $('body').on('submit', '.ajaxForm', function (e) {

        e.preventDefault();
        

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
             // optionally check if the response is what you wanted
             //if (data.response == 'deleted') {
             //
                    
            
            // Get the raw DOM object for the select box
            select = document.getElementById('paciente_form_clasificacionAO');

            // Clear the old options
            select.options.length = 0;

            // Load the new options
            // Or whatever source information you're working with
            for (var index = 0; index < data.length; index++) {
              option = data[index];
               console.log(option['identificador']);
                
              select.options.add(new Option(option['identificador'], option['identificador']));
            }
             //}
         }
        })
        .done(function (data) {
            if (typeof data.message !== 'undefined') {
                alert(data.message);
            }
             $('#paciente_form_clasificacionAO').select2({
                            data: data
                        });
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