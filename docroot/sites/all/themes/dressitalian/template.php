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
    /*'dressitalian.responsive.gpanels.css'*/
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
  /**
 
/** 
 * Add subsection class in the body tag
 */
  
    if (theme_get_setting('extra_page_classes')) {
    // Classes for body element. Allows advanced theming based on context
    // (home page, node of certain type, etc.), cheers Zen.
    if (!$vars['is_front']) {
	// Add unique class for each page.
      $path = drupal_get_path_alias($_GET['q']);
	// Add unique class for each website section.
	  list($section,$subsection, ) = explode('/', $path);
	  if (isset ($subsection)) {
		  $vars['classes_array'][] = drupal_html_class('subsection-' . $subsection);
	  }
    }
  }
}

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
function dressitalian_field($variables) {
  $output = '';

 // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . '&nbsp;</div>';
  }

  // Render the items.
  $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  $output .= '</div>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}
