<?php
/**
 * Melkino Vila theme fallback template.
 */
get_header();
if (file_exists(get_template_directory() . '/index.html')) {
    include get_template_directory() . '/index.html';
}
get_footer();
