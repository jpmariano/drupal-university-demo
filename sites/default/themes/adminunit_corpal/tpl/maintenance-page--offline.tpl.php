  <?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['slideshow']: Items for the slideshow region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 * - $panel_first: Items for the regions in panel_first.
 * - $panel_second: Items for the regions in panel_second.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see nucleus_preprocess_page()
 */
?>
<style>


body {
  background: url(/sites/all/themes/adminunit_corpal/images/bg-body.gif);
  font-family: Calibri, howard_sans_regular, Candara, "Helvetica Neue", "Trebuchet MS", Arial, Helvetica, sans-serif;
}

#page.page-maintenance {
  background: #ffffff;
  box-shadow: 0 0 5px #ccc;
  max-width: 1200px;
  margin: 0 auto;
  overflow: hidden;
  position: relative;
}

.page-maintenance #header-wrapper .header-container {
  background: transparent;
}

.page-maintenance #header-wrapper {
  position: fixed;
  top: 0px;
  margin: auto;
  z-index: 100000;
  width: 100%;
  max-width: 1200px;
  text-align: center;
}



.page-maintenance #header {
  height: 80px;
  background: #003a63;
}


.page-maintenance #logo {
  height: 100%;
  margin: 0; 
}

.page-maintenance #logo img {
  height: 75%;
  margin-top: 10px;
}


.page-maintenanc div#header-bottom {
  height: 40px;
  display: inline-block;
}

div#header-bottom div.empty-box {
  background: #2a6ebb;
}

#name-and-slogan {
  width: 100%;
  height: 100%;
  float: left;
  background: #2a6ebb;
  line-height: 1.2;
  padding-bottom: 10px;
}

.fs-large {
  font-size: 1.4em;
}

.site-name {
  margin: 0;
}

.site-name a {
  color: #ffffff;
  margin-top: 10px;
  display: block;
  text-transform: uppercase;
  font-weight: normal;
  text-decoration: none;
}

div#main-content {
  margin: 150px auto 0;
  text-align: center;
}

div#main-content #content {
	padding-bottom: 20px;
}

ul {
  text-decoration: none;
  list-style: none;
  text-align: left;
  max-width: 250px;
  margin: 0 auto;


</style>
<div id="page" class="page-default page-maintenance <?php print isset($page['nucleus_skin_classes']) ? $page['nucleus_skin_classes'] : ""; ?>">
		  <a name="Top" id="Top"></a>

		  <!-- HEADER -->
		  <div id="header-wrapper" class="wrapper">
			<div class="header-container">
			  <div class="grid-inner clearfix">
				<div id="header" class="clearfix">
         
				  <?php if ($logo): ?>
					<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" id="logo" class="grid-24">
					  <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
					</a>
				  <?php endif; ?>
				</div>
				
				 <div id="header-bottom" class="grid-24 clearfix">
					  <?php if ($site_name || $site_slogan): ?>
						<div id="name-and-slogan" class="hgroup">
						  <?php if ($site_name): ?>
							<h1 class="site-name fs-large">
							  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
								<?php print $site_name; ?>
							  </a>
							</h1>
						  <?php endif; ?>
						  <!--
						  <?php if ($site_slogan): ?>
							<p class="site-slogan"><?php print $site_slogan; ?></p>
						  <?php endif; ?>
						  -->
						</div>
					 <?php endif; ?>
			
				</div>
			  </div>
			</div>
		  </div>
		  <!-- /#HEADER -->


			<div id="main-wrapper" class="wrapper">
			<div class="container clearfix">
					
			  <div class="<?php print nucleus_group_class("content, sidebar_first"); ?>">
			
				<!-- MAIN CONTENT -->
				
				  <div id="main-content" class="section">
					<div class="grid-inner clearfix">				  
						
						
						    
                      	 <div id="content">
				          <p>Howard University is currently under maintenance. We should be back shortly. Thank you for your patience.</p>
						<br>
						<p>Please see below for links to some of our most visited sites:</p>
						<ul>
						<li><a href="https://bisonweb.howard.edu/PROD/twbkwbis.P_WWWLogin">Bison Web</a></li>
						<li><a href="https://blackboard.howard.edu/">Blackboard</a></li>
						<li><a href="http://www.howard.edu/calendars/">Calendars</a></li>
						<li><a href="http://auxiliary.howard.edu/bison-one-card.html">Bison One Card</a></li>
						<li><a href="http://mail.bison.howard.edu/">Student Email</a></li>
						<li><a href="http://webmail.howard.edu/">Faculty/Staff Email</a></li>
						<li><a href="http://outlook.com/owa/howard.edu">365 Email</a></li>
						<li><a href="https://secure.howard.edu/">Remote Access / VPN</a></li>
						<li><a href="http://www.howard.edu/alumni/dar/index.html">Alumni Relations</a></li>
						</p>
						</strong>

				        </div> <!-- /content -->
						
					</div>
				  </div>
			
				<!-- /#MAIN CONTENT -->
				
			  </div>
			</div>
		 </div> <!-- End Main-Wrapper -->
	
		
</div>
