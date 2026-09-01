<?php
/**
 * Front Page Template: Melkino Vila
 *
 * The visual homepage is currently kept in index.html so the first WordPress
 * installation remains pixel-consistent with the approved design. Assets are
 * loaded through functions.php and the next step can progressively replace
 * static sections with dynamic WordPress queries.
 */
if (!defined('ABSPATH')) {
    exit;
}

include get_template_directory() . '/index.html';
