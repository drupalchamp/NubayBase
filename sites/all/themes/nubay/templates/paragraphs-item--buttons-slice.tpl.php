<?php

/**
 * @file
 * Default theme implementation for a single paragraph item.
 *
 * Available variables:
 * - $content: An array of content items. Use render($content) to print them
 *   all, or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity
 *   - entity-paragraphs-item
 *   - paragraphs-item-{bundle}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened into
 *   a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>


<?php /*?><div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php print render($content); ?>
  </div>
</div><?php */?>

<?php

if(!empty($elements['#entity']->field_button_s_cover_backgroud)){
    if($elements['#entity']->field_button_s_cover_backgroud['und'][0]['value'] == '1'){
        if(!empty($elements['#entity']->field_s_cover_for_backgroud)){
            $background = $elements['#entity']->field_s_cover_for_backgroud['und'][0]['rgb'];
        }else{
            $background = '#ae163c';
        }
    } else {
        if(!empty($elements['#entity']->field_upload_background_image)){
            $background = "url('".file_create_url($elements['#entity']->field_upload_background_image['und'][0]['uri'])."')";
        }else{
            $background = '#ae163c';
        }
    }
}

//print '<pre>';print_r($elements['#entity']->field_button_s_cover_backgroud['und'][0]['value']);print '</pre>';

if(!empty($elements['#entity']->field_cover_padding_top_bottom)){
    $cover_top_padding = $elements['#entity']->field_cover_padding_top_bottom['und']['0']['value'].'px';
} else {
	$cover_top_padding = '35px';
}

if(!empty($elements['#entity']->field_cover_padding_left_right)){
    $cover_left_padding = $elements['#entity']->field_cover_padding_left_right['und']['0']['value'].'px';
} else {
	$cover_left_padding = '0px';
}

if(!empty($elements['#entity']->field_button_s_text_color)){
    $text_color = $elements['#entity']->field_button_s_text_color['und']['0']['rgb'];
} else {
	$text_color = '#ae163c';
}

if(!empty($elements['#entity']->field_button_s_text_font_size)){
    $font_size = $elements['#entity']->field_button_s_text_font_size['und']['0']['value'].'px';
} else {
	$font_size = '12px';
}

if(!empty($elements['#entity']->field_button_s_text_typeface)){
    $font_family = $elements['#entity']->field_button_s_text_typeface['und']['0']['value'];
} else {
	$font_family = 'Arial, Helvetica, sans-serif';
}

if(!empty($elements['#entity']->field_button_padding_left_right)){
    $padding_left = $elements['#entity']->field_button_padding_left_right['und']['0']['value'].'px';
} else {
	$padding_left = '10px';
}

if(!empty($elements['#entity']->field_button_padding_top_bottom)){
    $padding_top = $elements['#entity']->field_button_padding_top_bottom['und']['0']['value'].'px';
} else {
	$padding_top = '10px';
}

if(!empty($elements['#entity']->field_button_margin_left_right)){
    $margin_left = $elements['#entity']->field_button_margin_left_right['und']['0']['value'].'px';
} else {
	$margin_left = '6px';
}

if(!empty($elements['#entity']->field_button_s_background_color)){
    $button_bg_color = $elements['#entity']->field_button_s_background_color['und']['0']['rgb'];
} else {
	$button_bg_color = '#ffffff';
}

if(!empty($elements['#entity']->field_button_s_border_width)){
    $border_width = $elements['#entity']->field_button_s_border_width['und']['0']['value'].'px';
} else {
	$border_width = '3px';
}

if(!empty($elements['#entity']->field_button_border_color)){
    $border_color = $elements['#entity']->field_button_border_color['und']['0']['rgb'];
} else {
	$border_color = '#ffffff';
}

if(!empty($elements['#entity']->field_button_border_hover_color)){
    $border_hover_color = $elements['#entity']->field_button_border_hover_color['und']['0']['rgb'];
} else {
	$border_hover_color = '#ffffff';
}

if(!empty($elements['#entity']->field_button_s_border_radius)){
    $border_radius = $elements['#entity']->field_button_s_border_radius['und']['0']['value'].'px';
} else {
	$border_radius = '0px';
}

if(!empty($elements['#entity']->field_button_s_h_bg_color)){
    $bg_hover_color = $elements['#entity']->field_button_s_h_bg_color['und']['0']['rgb'];
} else {
	$bg_hover_color = '#ae163c';
}

if(!empty($elements['#entity']->field_button_s_hover_text_color)){
    $hover_text_color = $elements['#entity']->field_button_s_hover_text_color['und']['0']['rgb'];
} else {
	$hover_text_color = '#fff';
}

?>

<style>

#button_slice_wrapper {
    padding: <?php print $cover_top_padding;?> <?php print $cover_left_padding;?>;
	background: <?php print $background; ?>;
	background-position: 50% 50%;
	background-repeat: no-repeat;
}

#button_slice_wrapper ul,
#button_slice_wrapper ul li {
	padding: 0px;
	margin: 0px;
	list-style: none;
	list-style-image: none;
}

#button_slice_wrapper ul li.slice-items {
	display: inline-block;
	vertical-align: middle;
	margin: 0px <?php print $margin_left;?>;
}

#button_slice_wrapper ul li.slice-items a {
	cursor: pointer;
	text-decoration: none;
	display: inline-block;
	vertical-align: middle;
    line-height: 100%;
	color: <?php print $text_color; ?>;
	font-size: <?php print $font_size; ?>;
	font-family: <?php print $font_family; ?>;
	padding: <?php print $padding_top;?> <?php print $padding_left;?>;
	border: <?php print $border_width;?> solid <?php print $border_color;?>;
    border-radius: <?php print $border_radius; ?>;
	background-color: <?php print $button_bg_color; ?>
}

#button_slice_wrapper ul li.slice-items a:hover {
	color: <?php print $hover_text_color; ?>;
    border-color: <?php print $border_hover_color;?>;
	background-color: <?php print $bg_hover_color; ?>
}

</style>
<div id="button_slice_wrapper">
    <?php
		if(!empty($elements['#entity']->field_button_s_text)){
          print '<ul>';  
          foreach($elements['#entity']->field_button_s_text['und'] as $results){
             if(!empty($results['url'])){
                $url = $results['url'];
             } else {
                $url = 'javascript:void(0)';
             } 
             //print l($slicebutton['title'], $url, array('fragment' => '', 'external' => TRUE));
             ?>
             <li class="slice-items"><a href="<?php print $url;?>"><?php print $results['title'];?></a></li>
          <?php }
         print '</ul>';
       }
    ?>
</div>