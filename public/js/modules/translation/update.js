$(document).ready(function () {

    var translationForm = $('#frmTranslation');

    var translationFormParsley = translationForm.parsley({
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

    $("#inputLanguage").bind("change click", function () {
        $("#spanTranslationExist").text('');
    });
    $("#inputTranslationKey").bind("change click", function () {
        $("#spanTranslationExist").text('');
    });

    $("#btnUpdate").click(function (event) {
        event.preventDefault();
        translationFormParsley.validate();
        if (translationFormParsley.isValid())
        {
            var formData = new FormData(translationForm[0]);
            formData.append('translationID', translationForm.attr('data-translationid'));

            $.ajax({
                url: "/translation/update",
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
                    if (response.statusTranslationName === "EXIST")
                    {
                        $("#spanTranslationExist").text(response.messageTranslationExist);
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