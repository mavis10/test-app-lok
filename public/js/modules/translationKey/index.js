$(document).ready(function () {

    var translationKeyForm = $('#frmTranslationKey');

    var translationKeyFormParsley = translationKeyForm.parsley({
        successClass: "has-success",
        errorClass: "has-error",
        classHandler: function (el) {
            return el.$element.closest(".form-group");
        },
        errorsWrapper: "<span class='help-block' style='color: #bf3636;'></span>",
        errorTemplate: "<span></span>",
    }
    );

    $("#inputTranslationKeyName").bind("change keyup", function () {
        $("#spanTranslationKeyNameExist").text('');
    });

    $("#btnAddNew").click(function () {
        translationKeyFormParsley.validate();
        if (translationKeyFormParsley.isValid())
        {
            translationKeyForm.submit();
        }
    });

    translationKeyForm.on("submit", function (event) {
        event.preventDefault();

        var modal = $("#addNewModal");
        modal.find(".modal-footer").hide();
        var formData = new FormData(translationKeyForm[0]);

        $.ajax({
            url: "/translationKey/store",
            type: "POST",
            dataType: 'json', // type of response data
            data: formData,
            processData: false,
            contentType: false,
            success: function (response, status, xhr) {
                $("#spanTranslationKeyNameExist").text('');

                // success callback function       
                if (response.status === "SUCCESS")
                {
                    modal.modal('hide'); //Hide the modal
                    refreshListsTable(response.data);
                    translationKeyForm.get(0).reset();
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
                modal.find(".modal-footer").show();
            },
            error: function (jqXhr, textStatus, errorMessage) { // error callback
                console.log(textStatus);
                console.log(errorMessage);
            }
        });
    });

    $(document).on("click", "a#btnOpenDeleteModal", function (e) {
        var tr = $(this).closest('tr');

        $('#spanName').text('');

        var translationKeyID = tr.attr('data-translationkeyid');
        var translationKeyName = tr.attr('data-translationkeyname');

        $('#spanName').text(translationKeyName);

        translationKeyForm.attr('data-translationkeyid', translationKeyID)
    });

    $(document).on("click", "button#btnDelete", function (e) {
        var formData = new FormData();
        formData.append('translationKeyID', translationKeyForm.attr('data-translationkeyid'));

        $.ajax({
            url: "/translationKey/destroy",
            type: "POST",
            dataType: 'json', // type of response data
            data: formData,
            processData: false,
            contentType: false,
            success: function (response, status, xhr) {
                // success callback function       
                if (response.status === "SUCCESS")
                {
                    refreshListsTable(response.data);
                    translationKeyForm.get(0).reset();
                    altMessage('success', response.message);
                }

                if (response.status === "ERROR")
                {
                    altMessage('error', response.message);
                }
                $("#deleteModal").modal('hide');
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
                var updateButton = '<a href="/translationKey/show/' + val.translationKeyID + '" class="dropdown-item text-primary-600"><i class="icon-pencil7"></i>View</a>';

                var deleteButton = '';
                if (val.status === "ACTIVE")
                {
                    deleteButton = '<a href="#" class="dropdown-item text-danger-600" data-toggle="modal" data-target="#deleteModal" id="btnOpenDeleteModal"><i class="icon-trash"></i>Delete</a>';
                }

                var action = '<div class="list-icons"><div class="dropdown">' +
                        '<a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i></a>' +
                        '<div class="dropdown-menu dropdown-menu-right">' + updateButton + deleteButton + '</div></div>' +
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

                var tr_str = "<tr data-translationkeyid='" + val.translationKeyID + "' data-translationkeyname='" + val.name + "'>" +
                        "<td>" + val.translationKeyID + "</td>" +
                        "<td style='text-align:left;'>" + val.name + "</td>" +
                        "<td style='text-align:left;'>" + status + "</td>" +
                        "<td style='text-align:left;'>" + val.createdAt + "</td>" +
                        "<td class='text-center'>" + action + "</td>" +
                        "<td class='text-center'></td>" +
                        "</tr>";
                $("#tblLists tbody").append(tr_str);
            });

            if (!$.fn.dataTable.isDataTable('#tblLists')) {
                $("#tblLists").DataTable({"order": [[0, "desc"]]}).draw();
            }
        }
    }

    $('#addNewModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    });
    $('#deleteModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    });
});