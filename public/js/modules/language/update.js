$(document).ready(function () {

    var languageForm = $('#frmLanguage');

    var languageFormParsley = languageForm.parsley({
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest(".form-group");
        },
        //          errorsContainer: function (el) {
        //              return el.$element.closest(".form-group");
        //          },
        errorsWrapper: "<span class='help-block' style='color: #bf3636;'></span>",
        errorTemplate: "<span></span>",
    }
    );

    $("#inputName").bind("change keyup", function () {
        $("#spanNameExist").text('');
    });
    $("#inputISO").bind("change keyup", function () {
        $("#spanIsoExist").text('');
    });

    $("#btnUpdate").click(function (event) {
        event.preventDefault();
        languageFormParsley.validate();
        if (languageFormParsley.isValid())
        {
            var formData = new FormData(languageForm[0]);
            formData.append('languageID', languageForm.attr('data-languageid'));
              
            $.ajax({
                url: "/language/update",
                type: "POST",
                dataType: 'json', // type of response data
                data: formData,
                processData: false,
                contentType: false,
                success: function (response, status, xhr) {
                    // success callback function       
                    if (response.status === "SUCCESS")
                    {
                        altMessage('success', response.message);
                    }
       
                    if (response.statusName === "EXIST")
                    {
                        $("#spanNameExist").text(response.messageNameExist);
                    }
                    if (response.statusIso === "EXIST")
                    {
                        $("#spanIsoExist").text(response.messageIsoExist);
                    }
                    if (response.status === "ERROR")
                    {
                        altMessage('error', response.message);
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    console.log(textStatus);
                    console.log(errorMessage);
                }
            });
        }
    });

    function altMessage(icon, message)
    {
        Swal.fire({
            position: 'center',
            icon: icon,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
});