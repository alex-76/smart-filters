<?php
	defined( 'ABSPATH' ) or exit;
?>


<div id="search-layout" class="search-layout">

    <form class="search-form">

        <div class="form-inner">

            <div class="component-input">
                <input id="field-search" class="search-form__input field-search" type="text" name="search" autocomplete="off" value="" placeholder="Search posts...">
                <ul id="results"></ul>
            </div>

            <button class="search-form__submit btn-submit">
                <?php echo esc_html__($ymc_search_text_button, 'ymc-smart-filter');  ?>
            </button>

        </div>

    </form>

</div>








