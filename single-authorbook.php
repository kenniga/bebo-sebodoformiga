<?php
get_header();
$load_page = 'list';
if (bebostore_option('enable_author_ajax') != NULL) {
    if (bebostore_option('enable_author_ajax') == 2) {
        $load_page = 'detail';
    }
}
get_template_part('templates/author', $load_page);
get_footer();
 ?>