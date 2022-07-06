/*;(function(window) {

    'use strict';

    const _YMCGetPosts = (function () {

        return function () {
            console.log(123);
        }

    }());

    ( typeof window.YMCGetPosts === 'undefined' ) ? window.YMCGetPosts = _YMCGetPosts : console.error('YMCGetPosts is existed');


}(window));
*/

;
(function( $ ) {

    $(document).on('ready', function () {

        function getFilterPosts(ids) {

            let container = $(".ymc-smart-container");
            let params    = container.data("params");
            let term_ids = ids || '';

            const data = {
                'action': 'ymc_get_posts',
                'nonce_code' : _global_object.nonce,
                'params' : JSON.stringify(params),
                'term_ids' : term_ids,
                'page' :  _global_object.current_page,
            };

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: _global_object.ajax_url,
                data: data,
                beforeSend: function () {
                    //container.addClass('loading').
                    //prepend(`<img class="preloader" src="${pathPreloader}">`);
                },
                success: function (res) {
                    container.find('.container-posts .post-entry').html(res.data);
                },
                error: function (obj, err) {
                    console.log( obj, err );
                }
            });

        }


        // Filter Posts
        $(document).on('click','.ymc-smart-container .filter-layout .filter-link',function (e) {

            e.preventDefault();

            let link = $(e.target);
            let id = link.data('id');

            getFilterPosts(id);

        });


        getFilterPosts();


    });

}( jQuery ))