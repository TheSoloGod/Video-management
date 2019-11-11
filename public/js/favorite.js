$(document).ready(function () {
   $('#favorite').click(function () {
       let videoId = $(this).attr('video_id');
       let userId  = $(this).attr('user_id');
       let favorite = Number($('#totalFavorite').attr('favorite'));

       $.ajax({
           url: 'http://video.local/member/' + userId + '/favorite',
           type: 'get',
           data: {
               user_id : userId,
               video_id : videoId,
           },
           success: function (result) {
               if (result['status']) {
                   $('#favorite').html('<i class="fas fa-heart" style="font-size: 40px"></i>');
                   $('#totalFavorite').html('<strong>' + (favorite + 1) + '</strong>');
               }
           }
       })
   })
});
