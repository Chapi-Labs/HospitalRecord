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
             dataOptions = data[0];
             dataIds     = data[1];
             console.log(data);
             console.log(dataOptions);
            
            // Get the raw DOM object for the select box
            select = document.getElementById('paciente_form_clasificacionAO');
            console.log(select);
            // Clear the old options
            select.options.length = 0;

            // Load the new options
            // Or whatever source information you're working with
            for (var index = 0; index < dataOptions.length; index++) {
              option = dataOptions[index];
              opt1 = document.createElement("option");
              opt1.text = option['identificador'];
              console.log('testeando');
              console.log(dataIds[index]);
              console.log(dataIds[index]['idNum']);
              opt1.value = dataIds[index]['idNum'];
               //console.log(opt1);
                
              select.options.add(opt1);
            }
            console.log(select);
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