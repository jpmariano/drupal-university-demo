<?php

/**
 * @file node.tpl.php
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
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
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<div id="article-<?php print $node->nid; ?>" class="<?php print $classes; ?> text-size  fs-medium clearfix"<?php print $attributes; ?>>

  <?php if ($title && !$page): ?>
    <div class="article-header">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h2 class="grid-22 node-title" >
          <?php print ($teaser) ? '<a href="'.$node_url.'">'.$title.'</a>': $title ?>
        </h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if (!$teaser): ?>
       <div class="compliance">
      	<button type="submit" id='hideshow' ><i class="fa fa-wheelchair fa-2x"></i></button>
      	<div id='compliance-content'> <?php print render($region['compliance']); ?> </div>
      </div>
       <?php endif; ?>
    </div>
  <?php endif; ?>
  
  <?php if(isset($tb_corpal_first_image)) print $tb_corpal_first_image;?>
  
  <?php if ($display_submitted): ?>
    <?php print $user_picture; ?>
    <div class="submitted">
      <div class="author">
      <?php
        print t('Posted by !username !comment', array(
          '!username' => $name,
          '!comment' => '<span class="comment-comments">'.render($comments_count).'</span>',
        ));
      ?>
      </div>
      <div class="time pubdate">
        <span class="public-on"><?php print t('On');?></span>
        <span class="public-day"><?php print $created_day;?></span>
        <span class="public-month"><?php print $created_month;?></span>
        <span class="public-year"><?php print $created_year;?></span>
      </div>
    </div>
  <?php endif; ?>

  <div<?php print $content_attributes; ?>>
 <?php hide($content['field_news_published_date']); ?>
 <?php hide($content['field_news_author']); ?>
 <?php hide($content['body']); ?>
 <?php hide($content['field_news_more_info_url']); ?>
 <?php hide($content['field_news_media_contact']); ?>
  <?php hide($content['field_news_topic_fk']); ?>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <div id="publisher-section-<?php print $node->nid; ?>" class="publisher-section news-publisher-section">
  	<div id="publisher-<?php print $node->nid; ?>" class="publisher grid-12">
  	
  	  <?php if (isset($press_release )): ?>
  		<div class="section field field-name-field-news-press-release field-type-text field-label-hidden">
  			<p class="fs-smallest"><?php print $press_release ?></p>
  		</div>
  	   <?php endif; ?>
  	
   		<?php print render($content['field_news_published_date']); ?>
   		<?php print render($content['field_news_author']); ?>
   	</div>
   	 <?php if (!$teaser): ?>
	   	<div id="social-share-<?php print $node->nid; ?>" class="social-share news-social-share grid-12">
	   		<?php $sharethis_block = module_invoke('sharethis', 'block_view', 'sharethis_block');
	         print render($sharethis_block['content']);
	        ?>
	   	</div>
   	<?php endif; ?>
  </div>
  <?php ?>
  
  
   <?php print render($content['body']); ?>
   <?php print render($content['field_news_more_info_url']); ?>
   <?php print render($content['field_news_media_contact']); ?>
   <div id="about-howard-news">
 	 <?php print render($region['about_howard_news']); ?>
  </div>
  <?php print render($content['field_news_topic_fk']); ?>

  <?php if ($links = render($content['links'])): ?>
    <div class="menu node-links clearfix"><?php print $links; ?></div>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
</div>