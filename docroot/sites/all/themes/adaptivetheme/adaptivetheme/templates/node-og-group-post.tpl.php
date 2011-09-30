<?php // $Id: node-og-group-post.tpl.php,v 1.2.2.1 2010/09/14 20:13:12 jmburnz Exp $

/**
 * @file
 * Og has added a brief section at bottom for printing links to affiliated groups.
 * This template is used by default for non group nodes.
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Helper variables:
 * - $article_id: Outputs a unique id for each article (node).
 * - $classes: Outputs dynamic classes for advanced themeing.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see genesis_preprocess_node()
 */
?>
<div id="<?php print $article_id; ?>" class="<?php print $classes; ?> clearfix">
  <?php if (!$page): ?>
   <h2 class="<?php print $title_classes; ?>">
     <a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a>
     <?php print $unpublished; ?>
   </h2>
  <?php endif; ?>
  <?php if ($article_aside && !$teaser): ?>
    <div id="article-aside" class="aside"><?php print $article_aside; ?></div>
  <?php endif; ?>
  <?php if ($submitted): ?>
    <p class="submitted"><?php print $submitted; ?></p>
  <?php endif; ?>
  <?php if ($picture): print $picture; endif; ?>
  <?php print $content; ?>
  <?php
    if ($node->og_groups && $page) {
      print '<div class="groups">'. t('Groups'). ': ';
      print '<div class="links">'.  $og_links['view']. '</div></div>';
    }
  ?>
  <?php if ($links): print $links; endif; ?>
</div>
