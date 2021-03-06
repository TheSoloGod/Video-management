$(document).ready(function () {

    //upload video
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
        complete: function () {
            $('#upload').attr('hidden', 'hidden');
            $('#file').attr('hidden', 'hidden');
        }
    });

    $('#cancel').click(function () {
        $('#uploadForm').removeEventListener('progress');
        // $('#uploadForm').abort();
    });


    // upload info video
    $('#formInfoVideo').submit(function (event) {
        event.preventDefault();
        let formData = new FormData($(this)[0]);
        formData.append('csrfmiddlewaretoken', '{{ csrf_token }}');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: 'http://video.local/admin/video/store',
            data: formData,
            type: 'post',
            contentType: false,
            processData: false,
            success: function (result) {
                console.log(result);
                if (result['status']) {
                    // console.log(result['status']);
                    $('#formInfoVideoSubmit').attr('hidden', 'hidden');
                    $('#upload').attr('hidden', 'hidden');
                    $('#file').attr('hidden', 'hidden');
                    $('#cancel').attr('hidden', 'hidden');
                    $('#uploadInfoVideoError').attr('hidden', 'hidden');
                    $('#uploadInfoVideoSuccess').removeAttr('hidden');
                } else {
                    console.log(result['status']);
                    $('#uploadInfoVideoError').removeAttr('hidden');
                }
            }
        });
    });
});
