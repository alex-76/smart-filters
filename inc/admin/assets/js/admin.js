;
(function( $ ) {

    $(document).on('ready', function () {

        // Path preloader image
        const pathPreloader = _global_object.path+"/admin/assets/images/preloader.gif";

        // Wrapper tab
        const container   = $('.ymc__container-settings .tab-panel');

        document.querySelectorAll('.ymc__container-settings .nav-tabs .link').forEach((el) => {

            el.addEventListener('click',function (e) {
                e.preventDefault();

                let hash = this.hash;

                let text = $(this).find('.text').text();

                $('.ymc__header .manage-dash .title').text(text);

                $(el).addClass('active').closest('.nav-item').siblings().find('.link').removeClass('active');

                document.querySelectorAll('.tab-content .tab-panel').forEach((el) => {

                    if(hash === '#'+el.getAttribute('id')) {
                        $(el).addClass('active').siblings().removeClass('active');
                    }

                });

            });

        });

        // CPT Event
        $(document).on('change','.ymc__container-settings #general #ymc-cpt-select',function (e) {

            let taxonomyWrp = $('#ymc-tax-checkboxes');
            let termWrp     = $('#ymc-terms');

            const data = {
                'action': 'ymc_get_taxonomy',
                'nonce_code' : _global_object.nonce,
                'cpt' : $(this).val(),
                'post_id' : $(this).data('postid')
            };

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: _global_object.ajax_url,
                data: data,
                beforeSend: function () {
                    container.addClass('loading').
                    prepend(`<img class="preloader" src="${pathPreloader}">`);
                },
                success: function (res) {

                    container.removeClass('loading').find('.preloader').remove();

                    // Get Taxonomies
                    if( res.data.length ) {

                        taxonomyWrp.html('');
                        termWrp.html('').closest('.wrapper-terms').addClass('hidden');

                        res.data.forEach((el) => {
                            taxonomyWrp.append(`<div class="group-elements">
                            <input id="id-${el}" type="checkbox" name="ymc-taxonomy[]" value="${el}">
                            <label for="id-${el}">${el}</label>
                            </div>`);
                        });
                    }
                    else {
                        taxonomyWrp.html('').append(`<span class="notice">No data for Post Type / Taxonomy</span>`);
                        termWrp.html('').closest('.wrapper-terms').addClass('hidden');
                    }
                },
                error: function (obj, err) {
                    console.log( obj, err );
                }
            });

        });

        // Taxonomy Event
        $(document).on('click','.ymc__container-settings #general #ymc-tax-checkboxes input[type="checkbox"]',function (e) {

            let termWrp = $('#ymc-terms');

            let val = '';

            if($(e.target).is(':checked')) {

                val = $(e.target).val();

                const data = {
                    'action': 'ymc_get_terms',
                    'nonce_code' : _global_object.nonce,
                    'taxonomy' : val
                };

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: _global_object.ajax_url,
                    data: data,
                    beforeSend: function () {
                        container.addClass('loading').
                        prepend(`<img class="preloader" src="${pathPreloader}">`);
                    },
                    success: function (res) {

                        container.removeClass('loading').find('.preloader').remove();

                        if($(e.target).closest('.ymc-tax-checkboxes').find('input[type="checkbox"]:checked').length > 0) {
                            $('.ymc__container-settings #general .wrapper-terms').removeClass('hidden');
                        } else {
                            $('.ymc__container-settings #general .wrapper-terms').addClass('hidden');
                        }

                        // Get Terms
                        if( res.data.terms.length ) {

                            let output = '';

                            output += `<article class="group-term item-${val}">
                                       <div class="item-inner all-categories">
                                       <header class="header-tax">Taxonomy: ${val}</header>
                                       <input name='all-select' class='category-all' id='category-all-${val}' type='checkbox'>
                                       <label for='category-all-${val}' class='category-all-label'>All</label></div>`;

                            res.data.terms.forEach((el) => {
                                output += `<div class='item-inner'><input name="ymc-terms[]" class="category-list" id="category-id-${el.term_id}" type="checkbox" value="${el.term_id}">
                                <label for='category-id-${el.term_id}' class='category-list-label'>${el.name}</label></div>`;
                            });

                            output += `</article>`;

                            termWrp.append(output);

                            output = '';

                        } else  {
                            termWrp.append(`<article class="group-term item-${val}"><div class='item-inner notice-error'>No terms for taxonomy ${val}</div></article>`);
                        }
                    },
                    error: function (obj, err) {
                        console.log( obj, err );
                    }
                });
            }
            else {
                console.log('.item-'+$(e.target).val());
                termWrp.find('.item-'+$(e.target).val()).remove();
            }

        });

        // Selected All Terms
        $(document).on('click','.ymc__container-settings #general #ymc-terms .all-categories input[type="checkbox"]',function (e) {

            let input = $(e.target);

            let checkbox = input.closest('.all-categories').siblings().find('input[type="checkbox"]');

            if( input.is(':checked') ) {

                if( ! checkbox.is(':checked') ) {
                    checkbox.prop( "checked", true );
                }
            }
            else  {
                checkbox.prop( "checked", false );
            }
        });

        // Set checkbox All marked
        $('#general #ymc-terms .group-term').each(function () {
            let total = $(this).find('input[type="checkbox"]').length - 1;
            let totalChecked = $(this).find('input[checked]').length;
            if(total === totalChecked) {
                $(this).find('.all-categories input[type="checkbox"]').attr('checked','checked');
            }
        });


        // Toggle Filter Status
        $(document).on('click', '.ymc__container-settings .ymc-toggle-group .slider', function (e) {

            let input = $(e.target).siblings('input');

           // ( input.is(':checked') ) ? input.siblings('input[type="hidden"]').val('on') : input.siblings('input[type="hidden"]').val('off');

            if(input.is(':checked')) {
                input.siblings('input[type="hidden"]').val('on').closest('.wrapper-layout').find('.manage-filters').show();
            }
            else  {
                input.siblings('input[type="hidden"]').val('off').closest('.wrapper-layout').find('.manage-filters').hide();
            }

        });

        // Set Cookie
        function setCookie(cname, cvalue, exdays) {
            let d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        // Get Cookie
        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) === 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        // Set Cookie for Tab
        $(".ymc__container-settings #ymcTab a").click(function(e) {
            let hashurl = $(this).attr('href');
            setCookie("hashymc", hashurl,30);
        });

        // Display selected tab
        if(getCookie("hashymc") !== '') {

            let hash = getCookie("hashymc");

            $('.ymc__container-settings .nav-tabs a[href="' + hash + '"]').
                addClass('active').
                closest('.nav-item').
                siblings().
                find('.link').
                removeClass('active');

            document.querySelectorAll('.tab-content .tab-panel').forEach((el) => {
                if(hash === '#'+el.getAttribute('id')) {
                    $(el).addClass('active').siblings().removeClass('active');
                }
            });
        }

        // Add Color Picker for all inputs
        $('.ymc-custom-color').wpColorPicker();



    });

}( jQuery ))