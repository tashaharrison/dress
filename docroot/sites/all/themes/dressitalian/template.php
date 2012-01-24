<?php

/**
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "dressitalian" to match
 *    your subthemes name, e.g. if you name your theme "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "dressitalian".
 * 2. Uncomment the required function to use.
 */

/**
 * Override or insert variables into the html templates.
 */
function dressitalian_preprocess_html(&$vars) {
  // Load the media queries styles
  // Remember to rename these files to match the names used here - they are
  // in the CSS directory of your subtheme.
  $media_queries_css = array(
    'dressitalian.responsive.style.css',
    'dressitalian.responsive.gpanels.css'
  );
  load_subtheme_media_queries($media_queries_css, 'dressitalian');

 /**
  * Load IE specific stylesheets
  * AT automates adding IE stylesheets, simply add to the array using
  * the conditional comment as the key and the stylesheet name as the value.
  *
  * See our online help: http://adaptivethemes.com/documentation/working-with-internet-explorer
  *
  * For example to add a stylesheet for IE8 only use:
  *
  *  'IE 8' => 'ie-8.css',
  *
  * Your IE CSS file must be in the /css/ directory in your subtheme.
  */
  /* -- Delete this line to add a conditional stylesheet for IE 7 or less.
  $ie_files = array(
    'lte IE 7' => 'ie-lte-7.css',
  );
  load_subtheme_ie_styles($ie_files, 'dressitalian');
  // */
}

/* -- Delete this line if you want to use this function
function dressitalian_process_html(&$vars) {
}
// */

/**
 * Override or insert variables into the page templates.
 */
/*function dressitalian_preprocess_page(&$vars, $hook) {

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
}*/
/* -- Delete this line if you want to use these functions
function dressitalian_process_page(&$vars) {
}
// */

/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function dressitalian_preprocess_node(&$vars) {
}

function dressitalian_process_node(&$vars) {
}
// */

/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function dressitalian_preprocess_comment(&$vars) {
}

function dressitalian_process_comment(&$vars) {
}
// */

/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function dressitalian_preprocess_block(&$vars) {
}

function dressitalian_process_block(&$vars) {
}
// */

/**
 * Add the Style Schemes if enabled.
 * NOTE: You MUST make changes in your subthemes theme-settings.php file
 * also to enable Style Schemes.
 */
/* -- Delete this line if you want to enable style schemes.
// DONT TOUCH THIS STUFF...
function get_at_styles() {
  $scheme = theme_get_setting('style_schemes');
  if (!$scheme) {
    $scheme = 'style-default.css';
  }
  if (isset($_COOKIE["atstyles"])) {
    $scheme = $_COOKIE["atstyles"];
  }
  return $scheme;
}
if (theme_get_setting('style_enable_schemes') == 'on') {
  $style = get_at_styles();
  if ($style != 'none') {
    drupal_add_css(path_to_theme() . '/css/schemes/' . $style, array(
      'group' => CSS_THEME,
      'preprocess' => TRUE,
      )
    );
  }
}
// */
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

/**
 * Theme function to render the field content.
 *
 * @param string $content The content to render.
 * @param array $field Collection of field properties.
 */
function dressitalian_ds_field($content, $field) {
  $output = '';

  if (!empty($content)) {
    if ($field['type'] == 'ds') {

      $output .= '<div class="field '. $field['class'] .'">';
      // Above label.
      if ($field['labelformat'] == 'above') {
        $output .= '<div class="field-label">'. $field['title'] .' </div>';
      }
      // Inline label
      if ($field['labelformat'] == 'inline') {
        $output .= '<div class="field-label-inline-first">'. $field['title'] .': </div>';
      }
      $output .= $content;
      $output .= '</div>';
    }
    else {
      $output = $content;
    }
  }

  return $output;
}
