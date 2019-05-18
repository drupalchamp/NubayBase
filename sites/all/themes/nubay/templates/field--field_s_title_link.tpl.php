<?php

/**
 * @file
 * Theme implementation for a field that contains one or more column paragraphs.
 *
 * Available variables:
 * - $content: Rendered HTML of content items.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - paragraphs-items
 *   - paragraphs-items-{field_name}
 *   - paragraphs-items-{field_name}-{view_mode}
 *   - paragraphs-items-{view_mode}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_paragraphs_items()
 * @see template_process()
 */
  $column_count = count(element_children($element));
  $classes .= ' col-' . $column_count;

?>
<?php
	//print '<pre>';print_r($element['#object']->field_s_title_link['und'][0]['title']);print '</pre>';
   if(!empty($element['#object']->field_s_title_link['und'][0]['url'])){
	  $url = $element['#object']->field_s_title_link['und'][0]['url'];
   } else {
	  $url = 'javascript:void(0)';
   }
   $title = $element['#object']->field_s_title_link['und'][0]['title'];
?>
<h2 class="<?php print $classes; ?>"<?php print $attributes; ?>><a href="<?php print $url; ?>"><?php print $title; ?></a></h2>

