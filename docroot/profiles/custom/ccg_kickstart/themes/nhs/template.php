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
 * Implements hook_process_region().
 */
function nhs_alpha_process_zone(&$vars) {

  switch($vars['zone']){
  
    case 'branding':
      $image = '/' . drupal_get_path('theme', 'nhs') . '/images/global/feedback-tab.png';
      $vars['feedback'] = '<a id="give-feedback" class="simple-dialog" href="/node/63" name="region-content" rel="width:545;resizable:false;position:[center,60]" title="Feedback"><img src="' . $image . '" alt="Feedback" /></a>';
    break;
  
  }

}

/**
 * Implements hook_FORM_ID_form_alter().
 * Alter search form to change submit button to image & add label
 */

function nhs_preprocess_html(&$vars) {

 /*
  * Global JS for NHS
  */
  drupal_add_js(drupal_get_path('theme', 'nhs') . '/js/global.js', array(
    'scope' => 'header',
    'weight' => '15'
  ));

  /*
   * FS Widget Finder
   * Custom widget finder - tmp & only on homepage
   */
  drupal_add_js(drupal_get_path('theme', 'nhs') . '/js/nhs.fs.widget.js', array(
    'scope' => 'header',
    'weight' => '18'
  ));

}

function nhs_form_search_block_form_alter(&$form, &$form_state) {
  $form['search_block_form']['#title_display'] = 'before';
  $form['actions']['submit']['#type'] = 'image_button';
  $form['actions']['submit']['#src'] = drupal_get_path('theme', 'nhs') . '/images/global/search-icon.png';
  $form['search_block_form']['#attributes']['accesskey'] = '4';
}

function nhs_css_alter(&$css) {
  // Remove defaults.css file.
  unset($css[drupal_get_path('theme', 'alpha') . '/css/grid/alpha_default/normal/alpha-default-normal-12.css']);  
}

function nhs_alpha_preprocess_region(&$vars) {
  $menu_object = menu_get_object();
  if (isset($menu_object->type) && $vars['region'] == 'content') {
    $vars['theme_hook_suggestions'][] = 'region__content__'.$menu_object->type;
    $vars['attributes_array']['class'][] = 'region-content-'.$menu_object->type;
  }
}

// Nest regions within regions (Home page content)
function nhs_alpha_page_structure_alter(&$vars) {

  // Nest our welcome block
  if (!empty($vars['#excluded']['content_welcome_profile'])) {
    $vars['#excluded']['content_footer_block_first']['#weight'] = 1;
    $vars['content']['content']['content']['content_welcome_profile'] = $vars['#excluded']['content_welcome_profile'];
  }

  // Nest welcome videos (Homepage only)
  if (!empty($vars['#excluded']['content_welcome_videos'])) {
    $vars['#excluded']['content_footer_block_first']['#weight'] = 2;
    $vars['content']['content']['content']['content_welcome_videos'] = $vars['#excluded']['content_welcome_videos'];
  }

  // Nest have your say block
  if (!empty($vars['#excluded']['content_your_say'])) {
    $vars['#excluded']['content_footer_block_first']['#weight'] = 4;
    $vars['content']['content']['content']['content_your_say'] = $vars['#excluded']['content_your_say'];
  }

  // Nest our Video Content
  if (!empty($vars['#excluded']['content_footer_block_first'])) {
    $vars['#excluded']['content_footer_block_first']['#weight'] = 3;
    $vars['content']['content']['content']['content_footer_block_first'] = $vars['#excluded']['content_footer_block_first'];
  }

  // Nest our FS Widget
  if (!empty($vars['#excluded']['content_footer_block_second'])) {
    $vars['#excluded']['content_footer_block_second']['#weight'] = 4;
    $vars['content']['content']['content']['content_footer_block_second'] = $vars['#excluded']['content_footer_block_second'];
  }

}

/*
 * Customise the output of the breadcrumb
 */
function nhs_breadcrumb($vars) {

  if (!empty($vars['breadcrumb'])) {
    if (!empty($vars['breadcrumb'])) {
      $crumbs = "";
      $vars['breadcrumb'][] = '<span class="active">' . drupal_get_title() . '</span>';
      $breadcrumb = $vars['breadcrumb'];


      // Provide a navigational heading to give context for breadcrumb links to
      // screen-reader users. Make the heading invisible with .element-invisible.
      $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';


      $output .= theme('item_list', array(
          'items' => $breadcrumb,
          'type' => 'ul',
          'attributes' => array('id' => 'main-breadcrumbs', 'class' => array('breadcrumbs', 'clearfix')),
        )
      );

      return $output;
    }
  }
}

/* Remove menu title from output of sitemap /sitemap */
function nhs_site_map_box($vars) {
  $title = $vars['title'];
  $content = $vars['content'];
  $attributes = $vars['attributes'];

  $output = '';
  if (!empty($title) || !empty($content)) {
    $output .= '<div' . drupal_attributes($attributes) . '>';
    if (!empty($content)) {
      $output .= '<div class="content">' . $content . '</div>';
    }
    $output .= '</div>';
  }

  return $output;
}

function nhs_preprocess_field(&$variables, $hook) {
  if( isset($variables['items'][0]['#field']) ){
    $element = &$variables['items'][0]['#field'];  
    switch($element['field_name']){
      case 'field_org_ratings_url':
        $element['label'] = 'Reviews and ratings';
      break;
      case 'field_org_leave_review_url':
        $element['label'] = 'Leave a review';
      break;
      case 'field_org_perf_url':
        $element['label'] = 'Information on how we perform';
      break;
      case 'field_orginal_article_url':
        $element['label'] = 'Information on condition from NHS Choices';
      break; 
    }
  }
}

