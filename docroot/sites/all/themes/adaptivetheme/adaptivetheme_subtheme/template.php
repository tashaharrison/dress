<?php // $Id: template.php,v 1.2.2.1 2010/09/14 20:13:12 jmburnz Exp $

/**
 * @file template.php
 */

if (db_is_active()) {
  include_once(drupal_get_path('theme', 'adaptivetheme') .'/inc/template.custom-functions.inc');
}

/*
if (theme_get_setting('style_enable_schemes') == 'on') {
 drupal_add_css(drupal_get_path('theme', 'adaptivetheme_subtheme') .'/css/'. get_at_styles(), 'theme');
}
*/

/**
 * Override or insert variables into all templates.
 */
/*
function adaptivetheme_subtheme_preprocess(&$vars, $hook) {
}
*/

/**
 * Override or insert variables into the page templates.
 */
/*
function adaptivetheme_subtheme_preprocess_page(&$vars, $hook) {
}
*/

/**
 * Override or insert variables into the node templates.
 */
/*
function adaptivetheme_subtheme_preprocess_node(&$vars, $hook) {
}
*/

/**
 * Override or insert variables into the comment templates.
 */
/*
function adaptivetheme_subtheme_preprocess_comment(&$vars, $hook) {
}
*/

/**
 * Override or insert variables into the block templates.
 */
/*
function adaptivetheme_subtheme_preprocess_block(&$vars, $hook) {
}
*/
