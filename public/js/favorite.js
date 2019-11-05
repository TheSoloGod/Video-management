$(document).ready(function () {
   $('#favorite').click(function () {
       let videoId = $(this).attr('video_id');

       $.ajax({
           url: "http://video.local/member/favorite",
           type: 'get',
           data: {
               video_id: videoId
           },
           success: function (result) {
               console.log(result['video_id']);
           }
       })
   })
});
