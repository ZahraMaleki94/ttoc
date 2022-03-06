Zepto(function($){

  function noRemainigPosts() {
    $('.ttoc-load-more-posts').remove();
    $('.ttoc-has-more-posts').val('no');
  }

  $('.ttoc-load-more-posts').click(function() {
    var self = $(this),
        selfText = self.html(),
        page = $('.ttoc-current-page').val(),
        loadMorePosts = $('.ttoc-load-more-posts').val();
    if ('no' === loadMorePosts) {
      return;
    }
    console.log(page);
    $.ajax({
      type: 'GET',
      url: ttoc_params.rest_url + 'wp/v2/posts',
      data: {
        page: page,
        per_page: 3,
        order: 'desc',
        orderby: 'date',
        _embed: true,
      },
      headers: {
        'X-WP-Nonce': ttoc_params.rest_nonce,
      },
      beforeSend: function() {
          self.addClass('loading').html('Please wait ...');
      },
      success: function(response, textStatus, request) {

        for(var i = 0 ; i < response.length ; i++) {

          var postUrl   = response[i].link;
          var postTitle = response[i].title.rendered;
          var postExcerpt = response[i].excerpt.rendered;
          var postImage   = false;
          if (response[i]["_embedded"]['wp:featuredmedia']) {
            postImage = response[i]["_embedded"]["wp:featuredmedia"][0]["source_url"];
          }

          let template = '<div class="card single-post">';
          template += '<img src="' + postImage + '" />';
          template += '<div class="card-body">';
          template += '<h5 class="card-title">' +  postTitle + '</h5>';
          template += '<p class="card-text">' + postExcerpt + '</p>';
          template += '<a class="d-inline-block btn btn-outline-dark mt-2" href="' + postUrl + '">';
          template += 'Read More';
          template += '</a>'
          template += '</div>';
          template += '</div>';

          $('.posts-wrapper').append(template);

        }

        // Check if we have posts
        let totalPages = request.getResponseHeader('X-WP-TotalPages');
        if (totalPages == page) {
          noRemainigPosts();
          return;
        }

        // Increase page number
        $('.ttoc-current-page').val(parseInt(page) + 1);

      },
      error: function() {
        noRemainigPosts();
      },
      complete: function() {
        self.removeClass('loading').html(selfText);
      },
    });
  });
});
