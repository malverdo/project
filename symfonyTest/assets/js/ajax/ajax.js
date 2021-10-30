$(document).ready(function(){
    $("#search_save").on("click", function(event){
        let input = document.getElementById('search_title').value;
        $.ajax({
            url:        '/post/search',
            type:       'POST',
            dataType:   'json',
            data: {search:input},

            success: function(data) {
                console.log(data)
                $('#aye', e).html('');
                for(i = 0; i < data.length; i++) {
                    var post = data[i];
                    var e = $(
                        '<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray"><a id = "link" ></a><br><br><a id = "normal"></a></p>'
                    );
                    $('#link', e).html(post['title']);
                    $('#normal', e).html(post['body'].slice(0,255) + "...");
                    $('#aye').prepend(e);
                    $("#link").attr("href", post['slug']);
                }
            }
        });
    });
});