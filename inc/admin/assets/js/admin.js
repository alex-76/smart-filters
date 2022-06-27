;
(function( $ ) {

    $(document).on('ready', function () {

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

            let taxonomyWrp = $('#ymc-taxonomy-select');
            let termWrp     = $('#ymc-terms');

            const data = {
                'action': 'ymc_get_taxonomy',
                'nonce_code' : _global_object.nonce,
                'cpt' : $(this).val()
            };

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: _global_object.ajax_url,
                data: data,
                beforeSend: function () {},
                success: function (res) {

                    // Get Taxonomies
                    if( res.data.tax.length ) {

                        taxonomyWrp.html('');

                        res.data.tax.forEach((el) => {
                            taxonomyWrp.append("<option value='"+el+"'>"+el+"</option>");
                        });
                    }
                    else {
                        taxonomyWrp.html('').append("<option selected disabled value='0'>No data for Post Type / Taxonomy</option>");
                    }

                    // Get Terms
                    if( res.data.terms.length ) {

                        termWrp.html('');

                        termWrp.append(`<li class="all-categories">
                                        <input name='all-select' class='category-all' id='category-all-btn' type='checkbox'>
                                        <label for='category-all-btn' class='category-all-label'>All</label></li>`);

                        res.data.terms.forEach((el) => {
                            termWrp.append(`<li><input name="category-list[]" class="category-list" id="category-id-${el.term_id}" type="checkbox" value="${el.term_id}">
                            <label for='category-id-${el.term_id}' class='category-list-label'>${el.name}</label></li>`);
                        });
                    } else  {
                        termWrp.html('');
                        termWrp.html('').append("<span class='notice-error'>no data for Post Type / Taxonomy</span>");
                    }
                },
                error: function (obj, err) {
                    console.log( obj, err );
                }
            });

        });

        // Taxonomy Event
        $(document).on('change','.ymc__container-settings #general #ymc-taxonomy-select',function (e) {

            let termWrp = $('#ymc-terms');

            const data = {
                'action': 'ymc_get_terms',
                'nonce_code' : _global_object.nonce,
                'taxonomy' : $(this).val()
            };

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: _global_object.ajax_url,
                data: data,
                beforeSend: function () {},
                success: function (res) {

                    // Get Terms
                    if( res.data.terms.length ) {

                        termWrp.html('');

                        termWrp.append(`<li class="all-categories">
                                        <input name='all-select' class='category-all' id='category-all-btn' type='checkbox'>
                                        <label for='category-all-btn' class='category-all-label'>All</label></li>`);

                        res.data.terms.forEach((el) => {
                            termWrp.append(`<li><input name="category-list[]" class="category-list" id="category-id-${el.term_id}" type="checkbox" value="${el.term_id}">
                            <label for='category-id-${el.term_id}' class='category-list-label'>${el.name}</label></li>`);
                        });
                    } else  {
                        termWrp.html('');
                        termWrp.html('').append("<span class='notice-error'>no data for Post Type / Taxonomy</span>");
                    }
                },
                error: function (obj, err) {
                    console.log( obj, err );
                }
            });


        });





    });

}( jQuery ))