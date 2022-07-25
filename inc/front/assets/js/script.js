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

                    let params =  JSON.parse(entry.target.closest('.ymc-smart-filter-container').dataset.params);
                    params.page++;
                    entry.target.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

                    getFilterPosts({
                        'paged'     : params.page,
                        'toggle_pg' : 0,
                        'target'    : params.data_target,
                        'type_pg'   : params.type_pg
                    });

                    observer.unobserve(entry.target);
                }
            });

        }, optionsInfinityScroll);


        // Send Main Request
        function getFilterPosts( options ) {

            let paged     = options.paged;
            let toggle_pg = options.toggle_pg; // if 1 use func: html() or 0 append(): use load-more && scroll-infinity
            let target    = options.target;
            let type_pg   = options.type_pg;  // pagination type

            let container = $("."+target+"");
            let params = JSON.parse(document.querySelector('.'+target+'').dataset.params);

            const data = {
                'action'     : 'ymc_get_posts',
                'nonce_code' : _global_object.nonce,
                'params'     : JSON.stringify(params),
                'paged'      : paged,
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

                    if(params.post_sel !== 'all') {
                        container.find('.filter-layout .posts-found').html(`<b>${res.found}</b> posts selected.`);
                    }
                    else {
                        container.find('.filter-layout .posts-found').empty();
                    }

                    switch ( type_pg ) {

                        case 'numeric' :

                            // Filter is act scroll top
                            // if(toggle_pg === 1) {
                            //     $('html, body').animate({scrollTop: container.offset().top - 100}, 300);
                            // }

                            container.find('.container-posts').
                            removeClass('loading').
                            find('.preloader').remove().end().
                            find('.post-entry').html(res.data).end().
                            find('.ymc-pagination').remove().end().
                            append(res.pagin);

                            break;

                        case 'load-more' :

                            if(toggle_pg === 0) {
                                container.find('.container-posts').
                                removeClass('loading').
                                find('.preloader').remove().end().
                                find('.post-entry').append(res.data).end().
                                find('.ymc-pagination').remove().end().
                                append(res.pagin);
                            }
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

                            if(toggle_pg === 0) {
                                container.find('.container-posts').
                                removeClass('loading').
                                find('.preloader').remove().end().
                                find('.post-entry').append(res.data).end().
                                append(res.pagin);
                            }
                            else  {
                                // Filter is act scroll top
                                //$('html, body').animate({scrollTop: container.offset().top}, 300);

                                container.find('.container-posts').
                                removeClass('loading').
                                find('.preloader').remove().end().
                                find('.post-entry').html(res.data).end().
                                append(res.pagin);
                            }

                            if(res.get_current_posts > 0) {
                                postsObserver.observe(document.querySelector('.'+target+' .post-entry .post-item:last-child'));
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
        // ( typeof window.YMCGetPosts === 'undefined' ) ? window.YMCGetPosts = getFilterPosts : console.error('YMCGetPosts is existed');


        // Init Load Posts
        document.querySelectorAll('.ymc-smart-filter-container').forEach(function (el) {

            let params      = JSON.parse(el.dataset.params);
            let data_target = params.data_target;
            let type_pg     = params.type_pg;

            // Init Load Posts
            getFilterPosts({
                'paged'     : 1,
                'toggle_pg' : 1,
                'target'    : data_target,
                'type_pg'   : type_pg
            });
        });


        /*** FILTERS LAYOUTS ***/

        // Filter Posts / Layout1 / Simple Posts Filter
        $(document).on('click','.ymc-smart-filter-container .filter-layout1 .filter-link',function (e) {
            e.preventDefault();

            let link = $(this);
            let term_id = link.data('termid');
            let term_sel = link.data('selected');

            if(link.hasClass('multiple')) {

                link.toggleClass('active').closest('.filter-item').siblings().find('.all').removeClass('active');

                term_id = '';

                let listActiveItems = link.closest('.filter-entry').find('.active');
                if(listActiveItems.length > 0) {

                    link.closest('.filter-entry').find('.active').each(function (){
                        term_id += $(this).data('termid')+',';
                    });

                    term_id = term_id.replace(/,\s*$/, "");
                }
                else {
                    term_id = link.closest('.filter-entry').find('.all').data('termid');
                }
            }
            else {
                link.addClass('active').closest('.filter-item').siblings().find('.filter-link').removeClass('active');
            }

            let params = JSON.parse( this.closest('.ymc-smart-filter-container').dataset.params);
            params.terms = term_id;
            params.page = 1;
            params.search = '';
            params.post_sel = term_sel;
            this.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

            getFilterPosts({
                'paged'      : 1,
                'toggle_pg'  : 1,
                'target'     : params.data_target,
                'type_pg'    : params.type_pg
            });
        });

        // Filter Posts / Layout2 / Taxonomy Filter
        $(document).on('click','.ymc-smart-filter-container .filter-layout2 .filter-link',function (e) {
            e.preventDefault();

            let link = $(this);
            let term_id = link.data('termid');
            let term_sel = link.data('selected');

            if(link.hasClass('multiple')) {

                link.toggleClass('active').closest('.filter-entry').find('.all').removeClass('active');

                term_id = '';

                let listActiveItems = link.closest('.filter-entry').find('.active');
                if(listActiveItems.length > 0) {

                    link.closest('.filter-entry').find('.active').each(function (){
                        term_id += $(this).data('termid')+',';
                    });

                    term_id = term_id.replace(/,\s*$/, "");
                }
                else {
                    term_id = link.closest('.filter-entry').find('.all').data('termid');
                }
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

            let params = JSON.parse( this.closest('.ymc-smart-filter-container').dataset.params);
            params.terms = term_id;
            params.page = 1;
            params.search = '';
            params.post_sel = term_sel;
            this.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

            getFilterPosts({
                'paged'     : 1,
                'toggle_pg' : 1,
                'target'    : params.data_target,
                'type_pg'   : params.type_pg
            });
        });

        // Filter Post / Layout3 (Dropdown) / Dropdown Filter
        $(document).on('click','.ymc-smart-filter-container .filter-layout3 .dropdown-filter .menu-active',function (e) {
            e.preventDefault();
            $el = $(this);
            $el.find('.arrow').toggleClass('open').end().next().toggle();
            $el.closest('.dropdown-filter').siblings().find('.menu-passive').hide();
        });

        $(document).on('click','.ymc-smart-filter-container .filter-layout3 .dropdown-filter .menu-passive .btn-close',function (e) {
            e.preventDefault();
            $(this).closest('.dropdown-filter').find('.down').removeClass('open').end().find('.menu-passive').hide();
        });

        $(document).on('click','.ymc-smart-filter-container .filter-layout3 .dropdown-filter .menu-passive .menu-link',function (e) {
            e.preventDefault();
            let link = $(this);
            let term_id = '';
            let term_sel = link.data('selected');

            link.toggleClass('active');

            // Single selected terms
            if( !link.hasClass('multiple') ) {

                link.closest('.menu-passive__item').
                siblings().find('.menu-link').
                removeClass('active');

                link.closest('.dropdown-filter').find('.menu-active span').html($(this).data('name'));
            }

            let listActiveItems = link.closest('.filter-entry').find('.active');

            if(listActiveItems.length > 0) {

                link.closest('.filter-entry').find('.active').each(function (){
                    term_id += $(this).data('termid')+',';
                });

                term_id = term_id.replace(/,\s*$/, "");

                if( link.hasClass('multiple') ) {
                    // Add selected terms
                    let allLinks = $(link.closest('.filter-entry')).find('.dropdown-filter .menu-link');
                    let selItem = '';

                    term_id.split(',').forEach(function (el) {
                        allLinks.each(function () {
                            if ($(this).data('termid') === parseInt(el)) {
                                selItem += `<span data-trm="${el}" class="item">${$(this).data('name')} <small>x</small></span>`;
                            }
                        });
                    });

                    $(link.closest('.filter-entry')).find('.selected-items').html(selItem);
                }
            }
            else {
                term_id = link.closest('.filter-entry').data('terms');
                $(link.closest('.filter-entry')).find('.selected-items').empty();
            }

            // Update data params
            let params = JSON.parse( this.closest('.ymc-smart-filter-container').dataset.params);
            params.terms = term_id;
            params.page = 1;
            params.search = '';
            params.post_sel = term_sel;
            this.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

            getFilterPosts({
                'paged'     : 1,
                'toggle_pg' : 1,
                'target'    : params.data_target,
                'type_pg'   : params.type_pg
            });
        });

        $(document).on('click','.ymc-smart-filter-container .filter-layout3 .filter-entry .selected-items small',function (e) {
            e.preventDefault();

            let _self = $(this);

            let term_id = _self.closest('.item').data('trm');

            let isItems = _self.closest('.selected-items').find('.item').length - 1;

            let term_sel = (isItems > 0 ) ? isItems : 'all';

            let params = JSON.parse( this.closest('.ymc-smart-filter-container').dataset.params);
            let arrTerms = params.terms.split(',');
            let newTerms = arrTerms.filter(function(f) { return parseInt(f) !== term_id });
            if(newTerms.length > 0) {
                newTerms = newTerms.join(',');
            }
            else {
                newTerms = _self.closest('.filter-entry').data('terms');
            }

            params.terms = newTerms;
            params.page = 1;
            params.search = '';
            params.post_sel = term_sel;
            this.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

            _self.closest('.filter-entry').find('.active').each(function () {
                if(parseInt($(this).data('termid')) === term_id) {
                    $(this).removeClass('active');
                }
            });

            _self.closest('.item').remove();

            getFilterPosts({
                'paged'     : 1,
                'toggle_pg' : 1,
                'target'    : params.data_target,
                'type_pg'   : params.type_pg
            });

        });

        $(document).on('click','.ymc-smart-filter-container .filter-layout3 .filter-entry .btn-all',function (e) {
            e.preventDefault();

            let _self = $(this);
            let terms = _self.data('terms');
            let term_sel = _self.data('selected');

            let params = JSON.parse( this.closest('.ymc-smart-filter-container').dataset.params);
            params.terms = terms;
            params.page = 1;
            params.search = '';
            params.post_sel = term_sel;
            this.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

            _self.siblings('.selected-items').empty();
            _self.siblings('.dropdown-filter').find('.active').removeClass('active');
            _self.siblings('.dropdown-filter').find('.menu-passive').hide();

            getFilterPosts({
                'paged'     : 1,
                'toggle_pg' : 1,
                'target'    : params.data_target,
                'type_pg'   : params.type_pg
            });
        });

        /*** PAGINATION TYPES ***/

        // Pagination / Type: Default (Numeric)
        $(document).on('click','.ymc-smart-filter-container .pagination-numeric li a',function (e) {
            e.preventDefault();

            let paged = parseInt($(this).attr("href").replace(/\D/g, ""));
            let data_target = JSON.parse(this.closest('.ymc-smart-filter-container').dataset.params).data_target;
            let type_pg = JSON.parse(this.closest('.ymc-smart-filter-container').dataset.params).type_pg;

            getFilterPosts({
                'paged'     : paged,
                'toggle_pg' : 1,
                'target'    : data_target,
                'type_pg'   : type_pg
            });

        });

        // Pagination / Type: Load More
        $(document).on('click','.ymc-smart-filter-container .pagination-load-more .btn-load',function (e) {
            e.preventDefault();

            let params = JSON.parse(this.closest('.ymc-smart-filter-container').dataset.params);
            params.page++;
            this.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

            let data_target = params.data_target;
            let type_pg     = params.type_pg;
            let paged       = params.page;

            getFilterPosts({
                'paged'      : paged,
                'toggle_pg'  : 0,
                'target'     : data_target,
                'type_pg'    : type_pg
            });

        });


        /*** SEARCH POSTS ***/

        $(document).on('click','.ymc-smart-filter-container .search-form .btn-submit',function (e) {
            e.preventDefault();

            let phrase = $(this).siblings('.component-input').find('.field-search').val();

            if( phrase.trim() !== '' ) {

                let allTerms = $(this).
                    closest('.ymc-smart-filter-container').
                    find('.filter-layout .filter-link.all').
                    data('termid');


                let params = JSON.parse( this.closest('.ymc-smart-filter-container').dataset.params);
                params.search = phrase;
                params.terms = allTerms;
                params.post_sel = 'all';
                this.closest('.ymc-smart-filter-container').dataset.params = JSON.stringify(params);

                let container =  $('.'+params.data_target+'');
                container.find('.filter-layout .filter-link').removeClass('active');

                container.find('.filter-layout3').find('.selected-items').empty();
                container.find('.filter-entry .active').each(function () {
                    $(this).removeClass('active');
                });

                getFilterPosts({
                    'paged'      : 1,
                    'toggle_pg'  : 1,
                    'target'     : params.data_target,
                    'type_pg'    : params.type_pg
                });
            }
        });




        /*** Autocomplete search ======> DEV***/
        // https://w3collective.com/autocomplete-search-javascript/

        $(document).on('input','.ymc-smart-filter-container .search-form .field-search',function (e) {

            let _self = $(this);

            let resultsHTML = _self.siblings("#results");

            let results = '';

            let userInput = _self.val();

            resultsHTML.innerHTML = "";

            console.log(userInput);

            if (userInput.length > 0) {
                results = getResults(userInput);
                resultsHTML.show();
                for (i = 0; i < results.length; i++) {
                    results +=("<li>" + results[i] + "</li>");
                }

                resultsHTML.html(results);
            }

            resultsHTML.on('click', function (event) {
                const setValue = event.target.innerText;
                _self.val(setValue);
                //this.innerHTML = "";
            });

            // resultsHTML.onclick = function (event) {
            //     const setValue = event.target.innerText;
            //     console.log(event);
            //     _self.val(setValue);
            //     this.innerHTML = "";
            // };

        });


        function getResults(input) {

            const data = ["red", "blue", "green", "yellow", "purple", "orange", "black", "white", "brown"];

            const results = [];
            for (i = 0; i < data.length; i++) {
                //if (input === data[i].slice(0, input.length)) {
                    results.push(data[i]);
                //}
            }
            return results;
        }









    });

}( jQuery ));