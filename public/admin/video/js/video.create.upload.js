$(document).ready(function () {

    $('#uploadForm').ajaxForm({
        beforeSend: function () {
            $('#status').empty();
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('.progress-bar').text(percentComplete + '%');
            $('.progress-bar').css('width', percentComplete + '%');
        },
        success: function (data) {
            if (data.errors) {
                $('.progress-bar').text('0%');
                $('.progress-bar').css('width', '0%');
                $('#status').html('<span class="text-danger"><b>' + data.errors + '</b></span>');
            }
            if (data.success) {
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
                $('#status').html('<span class="text-success"><b>' + data.success + '</b></span><br /><br />');
                $('#status').append(data.image);
            }
        },
        // complete: function (xhr) {
        // }
    });

    $('#cancel').click(function () {
        $('#uploadForm').removeEventListener('progress');
        // $('#uploadForm').abort();
    })

});
