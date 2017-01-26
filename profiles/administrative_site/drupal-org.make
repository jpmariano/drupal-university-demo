; administrative_site make file for d.o. usage
core = "7.x"
api = "2"

; +++++ Modules +++++

projects[admin_menu][version] = "3.0-rc5"
projects[admin_menu][subdir] = "contrib"

projects[module_filter][version] = "2.0"
projects[module_filter][subdir] = "contrib"

projects[features_administrative_content_types][version] = "1.0"
projects[features_administrative_content_types][subdir] = "contrib"

projects[ctools][version] = "1.7"
projects[ctools][subdir] = "contrib"

projects[date][version] = "2.8"
projects[date][subdir] = "contrib"

projects[profiler_builder][version] = "1.2"
projects[profiler_builder][subdir] = "contrib"

projects[entityform][version] = "2.0-rc1"
projects[entityform][subdir] = "contrib"

projects[features][version] = "2.5"
projects[features][subdir] = "contrib"

projects[features_override][version] = "2.0-rc2"
projects[features_override][subdir] = "contrib"

projects[features_extra][version] = "1.0-beta1"
projects[features_extra][subdir] = "contrib"

projects[email][version] = "1.3"
projects[email][subdir] = "contrib"

projects[entityreference][version] = "1.1"
projects[entityreference][subdir] = "contrib"

projects[field_collection][version] = "1.0-beta8"
projects[field_collection][subdir] = "contrib"

projects[field_group][version] = "1.4"
projects[field_group][subdir] = "contrib"

projects[filefield_sources][version] = "1.9"
projects[filefield_sources][subdir] = "contrib"

projects[link][version] = "1.3"
projects[link][subdir] = "contrib"

projects[linkimagefield][version] = "1.x-dev"
projects[linkimagefield][subdir] = "contrib"

projects[youtube][version] = "1.5"
projects[youtube][subdir] = "contrib"

projects[imageapi][version] = "1.x-dev"
projects[imageapi][subdir] = "contrib"

projects[imce][version] = "1.9"
projects[imce][subdir] = "contrib"

projects[media][version] = "1.5"
projects[media][subdir] = "contrib"

projects[video_embed_field][version] = "2.0-beta8"
projects[video_embed_field][subdir] = "contrib"

projects[metatags_quick][version] = "2.9"
projects[metatags_quick][subdir] = "contrib"

projects[nodequeue][version] = "2.0-beta1"
projects[nodequeue][subdir] = "contrib"

projects[auto_entitylabel][version] = "1.3"
projects[auto_entitylabel][subdir] = "contrib"

projects[autologout][version] = "4.3"
projects[autologout][subdir] = "contrib"

projects[block_class][version] = "2.1"
projects[block_class][subdir] = "contrib"

projects[colorbox][version] = "2.8"
projects[colorbox][subdir] = "contrib"

projects[diff][version] = "3.2"
projects[diff][subdir] = "contrib"

projects[entity][version] = "1.6"
projects[entity][subdir] = "contrib"

projects[fast_404][version] = "1.5"
projects[fast_404][subdir] = "contrib"

projects[fontawesome][version] = "2.1"
projects[fontawesome][subdir] = "contrib"

projects[image_field_caption][version] = "2.1"
projects[image_field_caption][subdir] = "contrib"

projects[imageblock][version] = "1.3"
projects[imageblock][subdir] = "contrib"

projects[libraries][version] = "2.2"
projects[libraries][subdir] = "contrib"

projects[menu_attributes][version] = "1.0-rc3"
projects[menu_attributes][subdir] = "contrib"

projects[menu_block][version] = "2.5"
projects[menu_block][subdir] = "contrib"

projects[menu_breadcrumb][version] = "1.6"
projects[menu_breadcrumb][subdir] = "contrib"

projects[pathauto][version] = "1.2"
projects[pathauto][subdir] = "contrib"

projects[pdf][version] = "1.6"
projects[pdf][subdir] = "contrib"

projects[redirect][version] = "1.0-rc1"
projects[redirect][subdir] = "contrib"

projects[shs][version] = "1.6"
projects[shs][subdir] = "contrib"

projects[strongarm][version] = "2.0"
projects[strongarm][subdir] = "contrib"

projects[token][version] = "1.6"
projects[token][subdir] = "contrib"

projects[weight][version] = "2.5"
projects[weight][subdir] = "contrib"

projects[rules][version] = "2.9"
projects[rules][subdir] = "contrib"

projects[seckit][version] = "1.9"
projects[seckit][subdir] = "contrib"

projects[services][version] = "3.12"
projects[services][subdir] = "contrib"

projects[uuid][version] = "1.0-alpha6"
projects[uuid][subdir] = "contrib"

projects[uuid][version] = "1.0-alpha6"
projects[uuid][subdir] = "contrib"

projects[calendar_block][version] = "3.x-dev"
projects[calendar_block][subdir] = "contrib"

projects[ckeditor][version] = "1.16"
projects[ckeditor][subdir] = "contrib"

projects[jquery_update][version] = "2.5"
projects[jquery_update][subdir] = "contrib"

projects[options_element][version] = "1.12"
projects[options_element][subdir] = "contrib"

projects[views][version] = "3.11"
projects[views][subdir] = "contrib"

projects[workbench][version] = "1.2"
projects[workbench][subdir] = "contrib"

projects[workbench_access][version] = "1.2"
projects[workbench_access][subdir] = "contrib"

projects[workbench_media][version] = "1.1"
projects[workbench_media][subdir] = "contrib"

projects[workbench_moderation][version] = "1.4"
projects[workbench_moderation][subdir] = "contrib"

; +++++ TODO modules without versions +++++

projects[howard_gcs][version] = "" ; TODO add version
projects[howard_gcs][subdir] = "contrib"

; +++++ Themes +++++

; adminimal_theme
projects[adminimal_theme][type] = "theme"
projects[adminimal_theme][version] = "1.21"
projects[adminimal_theme][subdir] = "contrib"

; +++++ Libraries +++++

; ColorBox
libraries[colorbox][directory_name] = "colorbox"
libraries[colorbox][type] = "library"
libraries[colorbox][destination] = "libraries"
libraries[colorbox][download][type] = "get"
libraries[colorbox][download][url] = "https://github.com/jackmoore/colorbox/archive/master.zip"

; Flexslider
libraries[flexslider][directory_name] = "flexslider"
libraries[flexslider][type] = "library"
libraries[flexslider][destination] = "libraries"
libraries[flexslider][download][type] = "get"
libraries[flexslider][download][url] = "https://github.com/woothemes/FlexSlider/archive/flexslider1.zip"

; jQuery Superfish
libraries[superfish][directory_name] = "superfish"
libraries[superfish][type] = "library"
libraries[superfish][destination] = "libraries"
libraries[superfish][download][type] = "get"
libraries[superfish][download][url] = "https://github.com/mehrpadin/Superfish-for-Drupal/archive/master.zip"

