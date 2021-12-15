$(document).ready(function () {

    var translationForm = $('#frmTranslation');

    var translationFormParsley = translationForm.parsley({
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span class='help-block' style='color: #bf3636;'></span>",
        errorTemplate: "<span></span>",
    });


    $(document).on('show.bs.modal', '#addNewModal', function () {
        translationForm.get(0).reset();
        $("#inputLanguage").val('').trigger("change");
        $("#inputTranslationKey").val('').trigger("change");
        $('#inputTranslationText').val('');
    });

    $("#inputLanguage").bind("change click", function () {
        $("#spanTranslationExist").text('');
    });
    $("#inputTranslationKey").bind("change click", function () {
        $("#spanTranslationExist").text('');
    });

    $("#btnAddNew").click(function () {
        translationFormParsley.validate();
        if (translationFormParsley.isValid())
        {
            translationForm.submit();
        }
    });

    translationForm.on("submit", function (event) {
        event.preventDefault();

        var modal = $("#addNewModal");
        modal.find(".modal-footer").hide();
        var formData = new FormData(translationForm[0]);

        $.ajax({
            url: "/translation/store",
            type: "POST",
            dataType: 'json', // type of response data
            data: formData,
            processData: false,
            contentType: false,
            success: function (response, status, xhr) {
                $("#spanTranslationNameExist").text('');

                // success callback function       
                if (response.status === "SUCCESS")
                {
                    modal.modal('hide'); //Hide the modal
                    refreshListsTable(response.data);
                    translationForm.get(0).reset();
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
                modal.find(".modal-footer").show();
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback
                console.log(textStatus);
                console.log(errorMessage);
            }
        });
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

    function refreshListsTable(data)
    {
        if (data.length > 0)
        {
            $("#tblLists").DataTable().clear().destroy();
            $('#tblLists tbody > tr').remove();
            $.each(data, function (index, val) {
                var updateButton = '<a href="/translation/show/' + val.translationID + '" class="dropdown-item text-primary-600"><i class="icon-pencil7"></i>View</a>';

                var action = '<div class="list-icons"><div class="dropdown">' +
                        '<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a>' +
                        '<div class="dropdown-menu dropdown-menu-right">' + updateButton + '</div></div>' +
                        '</div>';

                var status = "";
                if (val.status === "ACTIVE")
                {
                    status = '<span class="badge bg-success">' + val.status + '</span>'
                }
                if (val.status === "DELETED")
                {
                    status = '<span class="badge bg-danger">' + val.status + '</span>'
                }
                if (val.status === "INACTIVE")
                {
                    status = '<span class="badge bg-primary">' + val.status + '</span>'
                }

                var tr_str = "<tr data-translationid='" + val.translationID + "'>" +
                        "<td>" + val.translationID + "</td>" +
                        "<td style='text-align:left;'>" + val.language + "</td>" +
                        "<td style='text-align:left;'>" + val.translationKey + "</td>" +
                        "<td style='text-align:left;'>" + val.locale + "</td>" +
                        "<td style='text-align:left;'>" + status + "</td>" +
                        "<td style='text-align:left;'>" + val.createdAt + "</td>" +
                        "<td class='text-center'>" + action + "</td>" +
                        "</tr>";
                $("#tblLists tbody").append(tr_str);
            });

            if (!$.fn.dataTable.isDataTable('#tblLists')) {
                $("#tblLists").DataTable({"order": [[0, "desc"]]}).draw();
            }
        }
    }

    $("#btnExport").click(function () {    
        window.setTimeout(function () {
            window.location.href = "/translation/export";
        }, 2000);
        
         
    });

    $('#addNewModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    });
});