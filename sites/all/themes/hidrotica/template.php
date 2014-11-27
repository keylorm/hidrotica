<?php
/**
 * @file
 * HTML template functions.
 */

/**
 * Implements hook_preprocess_html().
 * Meta tags https://drupal.org/node/1468582#comment-5698732
 */
function hidrotica_preprocess_html(&$variables) {
  $meta_charset = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'charset' => 'utf-8',
    ),
  );
  drupal_add_html_head($meta_charset, 'meta_charset');

  $meta_x_ua_compatible = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'x-ua-compatible',
      'content' => 'ie=edge, chrome=1',
    ),
  );
  drupal_add_html_head($meta_x_ua_compatible, 'meta_x_ua_compatible');

  $meta_mobile_optimized = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'MobileOptimized',
      'content' => 'width',
    ),
  );
  drupal_add_html_head($meta_mobile_optimized, 'meta_mobile_optimized');

  $meta_handheld_friendly = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'HandheldFriendly',
      'content' => 'true',
    ),
  );
  drupal_add_html_head($meta_handheld_friendly, 'meta_handheld_friendly');

  $meta_viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1',
    ),
  );
  drupal_add_html_head($meta_viewport, 'meta_viewport');

  $meta_cleartype = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'cleartype',
      'content' => 'on',
    ),
  );
  drupal_add_html_head($meta_cleartype, 'meta_cleartype');

   // Use html5shiv.
  if (theme_get_setting('html5shim')) {
    $element = array(
      'element' => array(
        '#tag' => 'script',
        '#value' => '',
        '#attributes' => array(
          'type' => 'text/javascript',
          'src' => file_create_url(drupal_get_path('theme', 'hidrotica') . '/js/html5shiv-printshiv.js'),
        ),
      ),
    );
    $html5shim = array(
      '#type' => 'markup',
      '#markup' => "<!--[if lt IE 9]>\n" . theme('html_tag', $element) . "<![endif]-->\n",
    );
    drupal_add_html_head($html5shim, 'sonambulo_html5shim');
  }

  // Use Respond.js.
  if (theme_get_setting('respond_js')) {
    drupal_add_js(drupal_get_path('theme', 'hidrotica') . '/js/respond.min.js', array('group' => JS_LIBRARY, 'weight' => -100));
  }

  // Use normalize.css
  if (theme_get_setting('normalize_css')) {
    drupal_add_css(drupal_get_path('theme', 'hidrotica') . '/css/normalize.css', array('group' => CSS_SYSTEM, 'weight' => -100));
  }

  
}

/**
 * Implements hook_html_head_alter().
 */
function hidrotica_html_head_alter(&$head_elements) {

  // Remove system content type meta tag.
  unset($head_elements['system_meta_content_type']);
}

/**
 * Implements hook_page_alter().
 * https://gist.github.com/jacine/1378246
 */
function hidrotica_page_alter(&$page) {
  // Remove all the region wrappers.
  foreach (element_children($page) as $key => $region) {
    if (!empty($page[$region]['#theme_wrappers'])) {
      $page[$region]['#theme_wrappers'] = array_diff($page[$region]['#theme_wrappers'], array('region'));
    }
  }
  // Remove the wrapper from the main content block.
  if (!empty($page['content']['system_main'])) {
    $page['content']['system_main']['#theme_wrappers'] = array_diff($page['content']['system_main']['#theme_wrappers'], array('block'));
  }
}

function hidrotica_preprocess_node(&$vars) {
  // Add a striping class.
  $vars['classes_array'][] = 'node-' . $vars['zebra'];
}

function hidrotica_preprocess_block(&$vars, $hook) {
  // Add a striping class.
  $vars['classes_array'][] = 'block-' . $vars['zebra'];
}

function hidrotica_form_alter(&$form, &$form_state, $form_id) {
   if ($form_id == 'search_block_form') {

      //$form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield

      // Add extra attributes to the text box
      $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Buscar';}";
      $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Buscar') {this.value = '';}";
      // Prevent user from searching the default text
      $form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Buscar'){ alert('Por favor ingrese una búsqueda'); return false; }";

      // Alternative (HTML5) placeholder attribute instead of using the javascript
      $form['search_block_form']['#attributes']['placeholder'] = t('Search');

      $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/preheader-buscar-icon.png');

   }
}

function hidrotica_preprocess_field(&$vars) {
  //dpm($vars);
}


function hidrotica_menu_link(array $variables) {
//add class for li
   $variables['element']['#attributes']['class'][] = 'menu-' . $variables['element']['#original_link']['mlid'];
//add class for a
   $variables['element']['#localized_options']['attributes']['class'][] = 'menu-' . $variables['element']['#original_link']['mlid'];
//dvm($variables['element']);
  return theme_menu_link($variables);
}

function hidrotica_form_comment_form_alter(&$form, &$form_state, &$form_id) {

  //agregar atributo placeholder al campo subject
  if(isset($form['author']['name']['#value'])){
    $name = $form['author']['name']['#value'];
    $form['author']['name']['#attributes']['placeholder'] = t( $name );
    $form['author']['mail']['#attributes']['placeholder'] = t( 'Email:' );
    $form['comment_body'][LANGUAGE_NONE][0]['#attributes']['placeholder'] = t( 'Comment:' );
  }

  unset ($form['actions']['preview']);
  $form['actions']['submit']['#value'] = t('Send');
  $form['comment_body']['#after_build'][] = 'configure_comment_form';
}

function configure_comment_form(&$form) {
  unset($form[LANGUAGE_NONE][0]['format']);
  return $form;
}

function hidrotica_breadcrumb(&$variables){
  if (count($variables['breadcrumb']) > 0) {
     $lastitem = sizeof($variables['breadcrumb']);
     $crumbs = '<div class="breadcrumbs">';
     $a=1;
     foreach($variables['breadcrumb'] as $value) {
         if ($a!=$lastitem){
          $crumbs .= '<div class="breadcrumb breadcrumb-'.$a.'">'. $value . ' ' . '</div>';
          $crumbs .= '<div class="breadcrumb crumbs-separator"> '.$variables['crumbs_separator'].' </div>';
          $a++;
         }
         else {
             $crumbs .= '<div class="breadcrumb breadcrumb-last">'.$value.'</div>';
         }
     }
     $crumbs .= '</div>';
   return $crumbs;
   }
   else {
     return t("Home");
   }
}