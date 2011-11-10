<?php // $Id: template.php,v 1.2.2.1 2010/09/14 20:13:12 jmburnz Exp $

/**
 * @file template.php
 */

if (db_is_active()) {
  include_once(drupal_get_path('theme', 'adaptivetheme') .'/inc/template.custom-functions.inc');
}

/*
if (theme_get_setting('style_enable_schemes') == 'on') {
 drupal_add_css(drupal_get_path('theme', 'dressitalian') .'/css/'. get_at_styles(), 'theme');
}
*/

/**
 * Override or insert variables into all templates.
 */
/*
function dressitalian_preprocess(&$vars, $hook) {
}
*/

/**
 * Override or insert variables into the page templates.
 */

function dressitalian_preprocess_page(&$vars, $hook) {

$classes = explode(' ', $vars['body_classes']);
if ($index = array_search(preg_replace('![^abcdefghijklmnopqrstuvwxyz0-9-_]+!s', '', 'page-'. drupal_strtolower(arg(0))), $classes)) {
  unset($classes[$index]);
}
$classes = str_replace('node-type-', 'page-type-', $classes);
$classes = str_replace('sidebar-left', 'sidebar-first', $classes);
$classes = str_replace('sidebar-right', 'sidebar-last', $classes);
$path_alias = drupal_get_path_alias($_GET['q']);
if (!$vars['is_front']) {
  list($section, ) = explode('/', $path_alias, 2);
  $classes[] = safe_string('section-'. $section);
}
if (!$vars['is_front']) {
  list($section,$section2,) = explode('/', $path_alias, 3);
  $classes[] = safe_string('subsection-'. $section2);
}
$vars['classes'] = trim(implode(' ', $classes));
}



/**
 * Override or insert variables into the node templates.
 */

/**
 * Override or insert variables into the comment templates.
 */
/*
function dressitalian_preprocess_comment(&$vars, $hook) {
}
*/

/**
 * Override or insert variables into the block templates.
 */
/*
function dressitalian_preprocess_block(&$vars, $hook) {
}
*/
function dressitalian_preprocess_print_node(&$variables, $hook) {
  $format = $variables['type'];
$type = $variables['node']->type;
$additions = _content_field_invoke_default('preprocess_node', $variables['node']);
$variables = array_merge($variables, $additions);

$variables['node']->render_by_ds = TRUE; //extra line
  
  template_preprocess_node($variables);
if (function_exists('_nd_preprocess_node')) {
  _nd_preprocess_node($variables, $hook);
}
  $variables['template_files'][] = "node";
  $variables['template_files'][] = "node-$type";
  $variables['template_files'][] = "print_node";
  $variables['template_files'][] = "print_node_$format";
  $variables['template_files'][] = "print_node_$format.node-$type";
}
