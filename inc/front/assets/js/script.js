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

        // Path preloader image
        const pathPreloader = _global_object.path+"/front/assets/images/preloader.gif";

        function getFilterPosts( options ) {

            let container = $(".ymc-smart-container");
            let params = container.data("params");

            let tr_id = options.term_id || '';
            let pd    = options.paged || 1;


            const data = {
                'action': 'ymc_get_posts',
                'nonce_code' : _global_object.nonce,
                'params' : JSON.stringify(params),
                'term_ids' : tr_id,
                'paged' :  pd,
            };

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: _global_object.ajax_url,
                data: data,
                beforeSend: function () {
                    container.find('.container-posts').addClass('loading').
                    prepend(`<img class="preloader" src="${pathPreloader}">`);
                },
                success: function (res) {

                    container.find('.container-posts').removeClass('loading').html(res.data);

                },
                error: function (obj, err) {
                    console.log( obj, err );
                }
            });
        }

        // Filter Posts
        $(document).on('click','.ymc-smart-container .filter-layout .filter-link',function (e) {
            e.preventDefault();

            let link = $(this);

            link.addClass('active').closest('.filter-item').siblings().find('.filter-link').removeClass('active');

            let term_id = link.data('id');
            let p = JSON.parse(document.querySelector(".ymc-smart-container").dataset.params);
            p.terms = term_id;
            document.querySelector(".ymc-smart-container").dataset.params = JSON.stringify(p);

            getFilterPosts({
                'term_id' : term_id,
                'paged' : 1
            });
        });

        // Pagination / Type: Default
        $(document).on('click','.ymc-smart-container .pagination-default li a',function (e) {
            e.preventDefault();

            let paged = parseInt($(this).attr("href").replace(/\D/g, ""));
            let term_id = JSON.parse(document.querySelector(".ymc-smart-container").dataset.params).terms;

            getFilterPosts({
                'term_id' : term_id,
                'paged' : paged
            });

        });

        // Load posts
        getFilterPosts({
            'term_id' : '',
            'paged' : 1
        });


    });

}( jQuery ))