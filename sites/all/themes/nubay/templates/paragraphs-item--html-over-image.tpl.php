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

<?php

$radius = '0px';
if(!empty($elements['#entity']->field_html_over_background)){
    if($elements['#entity']->field_html_over_background['und'][0]['value'] == '1'){
        if(!empty($elements['#entity']->field_html_over_background_color)){
            $background = $elements['#entity']->field_html_over_background_color['und'][0]['rgb'];
        }else{
            $background = '';
        }
    } else {
        if(!empty($elements['#entity']->field_html_over_backgound_image)){
            $background = "url('".file_create_url($elements['#entity']->field_html_over_backgound_image['und'][0]['uri'])."')";
            if(!empty($elements['#entity']->field_html_over_backgound_image)){
			   $radius = $elements['#entity']->field_html_over_image_radius['und'][0]['value'].'px';
            }
        } else {
            $background = '';
        }
    }
}

if(!empty($elements['#entity']->field_wrapper_html_over_width)){
   $width = $elements['#entity']->field_wrapper_html_over_width['und'][0]['value'].'px';
   $tablewidth = $elements['#entity']->field_wrapper_html_over_width['und'][0]['value'].'px';
} else {
   $width = '';
   $tablewidth = '100%';
}

if(!empty($elements['#entity']->field_wrapper_html_over_height)){
   $height = $elements['#entity']->field_wrapper_html_over_height['und'][0]['value'].'px';
} else {
   $height = '';
}

if(!empty($elements['#entity']->field_html_over_text_alignment)){
   $string = $elements['#entity']->field_html_over_text_alignment['und'][0]['value'];
   $alignment = explode (" ", $string);
   if($alignment[1] == 'left'){
      $margin = 'auto auto 15px 0px';
   }elseif($alignment[1] == 'right'){
      $margin = 'auto 0px 15px auto';
   }elseif($alignment[1] == 'center') {
      $margin = 'auto auto 15px';
   } else {
      $margin = '0px 0px 15px';
   }
} else {
   $alignment = '';
   $margin = '0px 0px 15px';
}

if(!empty($elements['#entity']->field_wrapper_html_over_padding)){
    $padding = $elements['#entity']->field_wrapper_html_over_padding['und']['0']['value'].'px';
} else {
	$padding = '0px';
}

if(!empty($elements['#entity']->field_text_content_color)){
    $text_content_color = $elements['#entity']->field_text_content_color['und']['0']['rgb'];
} else {
	$text_content_color = '';
}

?>

<style>

#html_over_image_wrapper_<?php print $elements['#entity']->item_id;?> {
	width: <?php print $width; ?>;
	height: <?php print $height;?>;
	margin: <?php print $margin;?>;
	padding: <?php print $padding.' '; ?> 15px;
	border-radius: <?php print $radius;?>;
	background: <?php print $background; ?>;
	background-position: 50% 50%;
	background-repeat: no-repeat;
	background-size: cover;
	overflow: hidden;
}

#html_over_image_wrapper_<?php print $elements['#entity']->item_id;?> table {
	width: <?php print $tablewidth; ?>;
	height: <?php print $height;?>;
}

#html_over_image_wrapper_<?php print $elements['#entity']->item_id;?> tbody {
	border: 0px;
}

#html_over_image_wrapper_<?php print $elements['#entity']->item_id;?> tr {
	background: none;
}

#html_over_image_wrapper_<?php print $elements['#entity']->item_id;?> tr td {
	padding: 0px;
	border: 0px;
	text-align: <?php print $alignment[1];?>;
    color: <?php print $text_content_color; ?>;
}

</style>
<?php //print '<pre>';print_r($elements['#entity']->field_html_over_title);print '</pre>'; ?>

<div id="html_over_image_wrapper_<?php print $elements['#entity']->item_id;?>">

<table>
	<tr>
        <td align="<?php print $alignment[1];?>" valign="<?php print $alignment[0];?>">        
            <?php 
             if(!empty($elements['#entity']->field_html_over_text_content['und'])){ ?>
             <div class="body"><?php print $elements['#entity']->field_html_over_text_content['und'][0]['value']; ?></div>
             <?php } ?>
         </td>
     </tr>
</table>
</div>