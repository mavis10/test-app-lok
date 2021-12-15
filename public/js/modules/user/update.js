$(document).ready(function () {

    var userForm = $('#frmUser');

    var userFormParsley = userForm.parsley({
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span class='help-block' style='color: #bf3636;'></span>",
        errorTemplate: "<span></span>",
    }
    );

    $("#inputUsername").bind("change keyup", function () {
        $("#spanUsernameExist").text('');
    });

    $("#inputEmail").bind("change keyup", function () {
        $("#spanEmailExist").text('');
    });

    $("#btnUpdate").click(function (event) {
        event.preventDefault();
        userFormParsley.validate();
        if (userFormParsley.isValid())
        {
            var formData = new FormData(userForm[0]);
            formData.append('userID', userForm.attr('data-userid'));

            $.ajax({
                url: "/user/update",
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
                        
                        window.setTimeout(function () {
                            window.location.href = "/dashboard";
                        }, 2000);
                    }
                    if (response.statusEmail === "EXIST")
                    {
                        $("#spanEmailExist").text(response.messageEmailExist);
                    }
                    if (response.statusUsername === "EXIST")
                    {
                        $("#spanUsernameExist").text(response.messageUsernameExist);
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