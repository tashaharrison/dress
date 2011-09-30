<?php // $Id: template.preprocess-comment-wrapper.inc,v 1.2.2.1 2010/09/14 20:13:12 jmburnz Exp $

/**
 * @file
 * Override or insert variables into the comment-wrapper template.
 */
global $theme;
$classes = array();
if (function_exists('node_skinr_data') && !empty($vars['skinr'])) {
  $classes[] = $vars['skinr'];
}
$classes[] = $vars['node']->type .'-comments';
$vars['classes'] = implode(' ', $classes);