
$(document).ready(function () {
    $("#yourFormId").submit(function (event) {
        var isValid = true;
        var errors = [];
        var $errorMessages = $("#errorMessages");
        $errorMessages.hide();
        $("#errorList").empty();
        if (!$('input[name="type"]:checked').length) {
            errors.push("<li>Please select a type.</li>");
            isValid = false;
        }
        var title = $("#title").val().trim();
        if (title === "") {
            errors.push("<li>Title is required.</li>");
            isValid = false;
        }
        var description = $("#description").val().trim();
        if (description === "") {
            errors.push("<li>Description is required.</li>");
            isValid = false;
        }
        var categoryId = $('select[name="category_id"]').val();
        if (categoryId === "") {
            errors.push("<li>Please select a category.</li>");
            isValid = false;
        }
        if (!$('#image')[0].files.length) {
            errors.push("<li>Please upload an image.</li>");
            isValid = false;
        }
        if (!isValid) {
            $("#errorList").html(errors.join(""));
            $errorMessages.show();
            event.preventDefault();
        }
    });
    $(document).on('click', '#errorMessages svg', function () {
        $("#errorMessages").hide();
    });
});
