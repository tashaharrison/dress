<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

/**
 * Implements hook_preprocess_html().
 */
function dressitalianresponsive_preprocess_html(&$vars) {
  $theme = alpha_get_theme();
  

  // Add a CSS class based on the current page context.
  if (!drupal_is_front_page()) {
   
	$path = drupal_get_path_alias($_GET['q']);
	list($context,$subsection) = explode('/', $path);
    
 
	if (isset ($subsection)) {
	  $vars['attributes_array']['class'][] = drupal_html_class('subsection-' . $subsection);
	}
	
  }
  
  alpha_css_include();
  alpha_libraries_include();
}
drupal_add_js (drupal_get_path('theme','dressitalianresponsive') .'/js/waypoints.min.js');
drupal_add_js (drupal_get_path('theme','dressitalianresponsive') .'/js/script.js');