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



        function getFilterPosts() {

            let container = $(".ymc-smart-container");
            let params    = container.data("params");


            const data = {
                'action': 'ymc_get_posts',
                'nonce_code' : _global_object.nonce,
                'params' : JSON.stringify(params),
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

                    container.append(res.data);

                },
                error: function (obj, err) {
                    console.log( obj, err );
                }
            });

        }

        getFilterPosts();


    });

}( jQuery ))