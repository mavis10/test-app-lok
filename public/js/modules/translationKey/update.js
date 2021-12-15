$(document).ready(function () {

    var translationKeyForm = $('#frmTranslationKey');

    var translationKeyFormParsley = translationKeyForm.parsley({
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

    $("#inputTranslationKeyName").bind("change keyup", function () {
        $("#spanTranslationKeyNameExist").text('');
    });

    $("#btnUpdate").click(function (event) {
        event.preventDefault();
        translationKeyFormParsley.validate();
        if (translationKeyFormParsley.isValid())
        {
            var formData = new FormData(translationKeyForm[0]);
            formData.append('translationKeyID', translationKeyForm.attr('data-translationkeyid'));

            $.ajax({
                url: "/translationKey/update",
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
                    if (response.statusTranslationKeyName === "EXIST")
                    {
                        $("#spanTranslationKeyNameExist").text(response.messageTranslationKeyNameExist);
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