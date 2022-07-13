/*;(function(window) {

    'use strict';

    const _YMCGetPosts = (function () {

        return function () {
            console.log(123);
        }

    }());

    ( typeof window.YMCGetPosts === 'undefined' ) ? window.YMCGetPosts = _YMCGetPosts : console.error('YMCGetPosts is existed');


}(window))*/


;
(function( $ ) {

    $(document).on('ready', function () {

        // Path preloader image
        const pathPreloader = _global_object.path+"/front/assets/images/preloader.gif";

        // Type Pagination
        const type_pg = JSON.parse(document.querySelector(".ymc-smart-filter-container").dataset.params).type_pg;

        // Options IntersectionObserver
        const optionsInfinityScroll = {
            root: null,
            rootMargin: '0px',
            threshold: 0.7
        }

        // Object Observer
        const postsObserver = new IntersectionObserver((entries, observer) => {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    _global_object.current_page++;

                    let term_id = JSON.parse(document.querySelector(".ymc-smart-filter-container").dataset.params).terms;
                    let paged = _global_object.current_page;

                    getFilterPosts({
                        'term_id' : term_id,
                        'paged' : paged
                    });

                    observer.unobserve(entry.target);
                }
            });

        }, optionsInfinityScroll);

        // Send Main Request
        function getFilterPosts( options ) {

            let container = $(".ymc-smart-filter-container");
            let params = container.data("params");

            let tr_id  = options.term_id || '';
            let paged  = options.paged || 1;
            let filter = options.filter || 0;

            const data = {
                'action': 'ymc_get_posts',
                'nonce_code' : _global_object.nonce,
                'params' : JSON.stringify(params),
                'term_ids' : tr_id,
                'paged' :  paged,
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

                    switch ( type_pg ) {

                        case 'default' :

                            // Filter is act scroll top
                            if(filter === 1) {
                                //$('html, body').animate({scrollTop: container.offset().top}, 300);
                            }

                            container.find('.container-posts').
                            removeClass('loading').
                            find('.preloader').remove().end().
                            find('.post-entry').html(res.data).end().
                            find('.ymc-pagination').remove().end().
                            append(res.pagin);

                            break;

                        case 'load-more' :

                            // Filter is not act
                            if(filter === 0) {
                                container.find('.container-posts').
                                removeClass('loading').
                                find('.preloader').remove().end().
                                find('.post-entry').append(res.data).end().
                                find('.ymc-pagination').remove().end().
                                append(res.pagin);
                            } // Filter is act
                            else  {
                                container.find('.container-posts').
                                removeClass('loading').
                                find('.preloader').remove().end().
                                find('.post-entry').html(res.data).end().
                                find('.ymc-pagination').remove().end().
                                append(res.pagin);
                            }

                            if(res.get_current_posts <= 0) {
                                container. find('.pagination-load-more').remove();
                            }

                            break;

                        case 'scroll-infinity' :

                            // Filter is not act
                            if(filter === 0) {
                                container.find('.container-posts').
                                removeClass('loading').
                                find('.preloader').remove().end().
                                find('.post-entry').append(res.data).end().
                                append(res.pagin);
                            } // Filter is act
                            else  {
                                // Filter is act scroll top
                                $('html, body').animate({scrollTop: container.offset().top}, 300);

                                container.find('.container-posts').
                                removeClass('loading').
                                find('.preloader').remove().end().
                                find('.post-entry').html(res.data).end().
                                append(res.pagin);
                            }

                            if(res.get_current_posts > 0) {
                                postsObserver.observe(document.querySelector('.ymc-pagination-scroll-infinity .post-item:last-child'));
                            }

                            break;
                    }
                },
                error: function (obj, err) {
                    console.log( obj, err );
                }
            });
        }

        // Set Function getFilterPosts global
        ( typeof window.YMCGetPosts === 'undefined' ) ? window.YMCGetPosts = getFilterPosts : console.error('YMCGetPosts is existed');


        // Init Load Posts
        getFilterPosts({
            'term_id' : '',
            'paged' : 1
        });

        // Filter Posts / Layout1
        $(document).on('click','.ymc-smart-filter-container .filter-layout1 .filter-link',function (e) {
            e.preventDefault();

            let link = $(this);
            let term_id = link.data('termid');

            _global_object.current_page = 1;

            if(link.hasClass('multiple')) {

                link.toggleClass('active').closest('.filter-item').siblings().find('.all').removeClass('active');

                term_id = '';

                $('.ymc-smart-filter-container .filter-layout .active').each(function (){

                    term_id += $(this).data('termid')+',';

                });

                term_id = term_id.replace(/,\s*$/, "");

            }
            else {
                link.addClass('active').closest('.filter-item').siblings().find('.filter-link').removeClass('active');
            }

            let p = JSON.parse(document.querySelector(".ymc-smart-filter-container").dataset.params);
            p.terms = term_id;
            document.querySelector(".ymc-smart-filter-container").dataset.params = JSON.stringify(p);

            getFilterPosts({
                'term_id' : term_id,
                'paged' : 1,
                'filter' : 1
            });
        });

        // Filter Posts / Layout2
        $(document).on('click','.ymc-smart-filter-container .filter-layout2 .filter-link',function (e) {
            e.preventDefault();

            let link = $(this);
            let term_id = link.data('termid');

            _global_object.current_page = 1;

            if(link.hasClass('multiple')) {

                link.toggleClass('active').closest('.filter-entry').find('.all').removeClass('active');

                term_id = '';

                $('.ymc-smart-filter-container .filter-layout .active').each(function (){

                    term_id += $(this).data('termid')+',';

                });

                term_id = term_id.replace(/,\s*$/, "");
            }
            else {
                link.addClass('active').
                closest('.filter-item').
                siblings().find('.filter-link').
                removeClass('active').
                closest('.group-filters').siblings().
                find('.filter-link').
                removeClass('active');
            }

            if(link.hasClass('all')) {
                link.addClass('active').closest('.filter-item').siblings().find('.filter-link').removeClass('active');
            }

            let p = JSON.parse(document.querySelector(".ymc-smart-filter-container").dataset.params);
            p.terms = term_id;
            document.querySelector(".ymc-smart-filter-container").dataset.params = JSON.stringify(p);

            getFilterPosts({
                'term_id' : term_id,
                'paged' : 1,
                'filter' : 1
            });
        });


        // Filter Post / Layout3 (Dropdown)
        // do something...



        // Pagination / Type: Default (Numeric)
        $(document).on('click','.ymc-smart-filter-container .pagination-default li a',function (e) {
            e.preventDefault();

            let paged = parseInt($(this).attr("href").replace(/\D/g, ""));
            let term_id = JSON.parse(document.querySelector(".ymc-smart-filter-container").dataset.params).terms;

            getFilterPosts({
                'term_id' : term_id,
                'paged' : paged,
                'filter' : 1
            });

        });

        // Pagination / Type: Load More
        $(document).on('click','.ymc-smart-filter-container .pagination-load-more .btn-load',function (e) {
            e.preventDefault();

            _global_object.current_page++;

            let term_id = JSON.parse(document.querySelector(".ymc-smart-filter-container").dataset.params).terms;
            let paged = _global_object.current_page;

            getFilterPosts({
                'term_id' : term_id,
                'paged' : paged
            });

        });




    });

}( jQuery ))