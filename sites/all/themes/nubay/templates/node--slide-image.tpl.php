
<?php if ($page == 0): ?>

<?php
  $node_obj = node_load($node->nid);

		$box_location = '';
		$box_width = '';
		$box_bg_color = '';
		$text_color = '';
		$font_size = '';
		$title_font_size = '';
		$font_typeface = '';
		$link_bg_color = '';
		$head_font_color = '';
		$head_font_typeface = '';
		$link_color = '';
        $link_font_typeface = '';
        $head_line_spacing = '';
   $image_corner_radius = '';
$link_button_width = '';


		if(!empty($node_obj->field_text_box_location)){
		  $box_location = $node_obj->field_text_box_location['und'][0]['value'];
		}
		if(!empty($node_obj->field_text_box_width)){
    $box_width = $node_obj->field_text_box_width['und'][0]['value'].'px';
  }
		if(!empty($node_obj->field_text_box_background_color)){
    $box_bg_color = $node_obj->field_text_box_background_color['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_text_font_color)){
    $text_color = $node_obj->field_text_font_color['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_text_font_size)){
    $font_size = $node_obj->field_text_font_size['und'][0]['value'].'px';
  }
		if(!empty($node_obj->field_text_font_typefaces)){
    $font_typeface = $node_obj->field_text_font_typefaces['und'][0]['value'];
  }
		if(!empty($node_obj->field_title_font_size)){
    $title_font_size = $node_obj->field_title_font_size['und'][0]['value'].'px';
  }
		if(!empty($node_obj->field_head_font_color)){
    $head_font_color = $node_obj->field_head_font_color['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_link_color)){
    $link_color = $node_obj->field_link_color['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_link_background)){
    $link_bg_color = $node_obj->field_link_background['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_head_font_typefaces)){
    $head_font_typeface = $node_obj->field_head_font_typefaces['und'][0]['value'];
  }
if(!empty($node_obj->field_link_font_typeface)){
    $link_font_typeface = $node_obj->field_link_font_typeface['und'][0]['value'];
  }
if(!empty($node_obj->field_head_line_spacing)){
    $head_line_spacing = $node_obj->field_head_line_spacing['und'][0]['value'].'em';
  }
		if(!empty($node_obj->field_slide_image_corner_radius)){
    $image_corner_radius = $node_obj->field_slide_image_corner_radius['und'][0]['value'].'px';
  }
if(!empty($node_obj->field_link_button_width)){
    $link_button_width = $node_obj->field_link_button_width['und'][0]['value'].'px';
  }
		$text_align = $node_obj->field_text_justify['und'][0]['value'];
?>
<div id="slideshow">
	 <div class="slideshow_img">
	   <?php
			   if(user_access('administer nodes')){
            print "<div class='edit_link'>".l(t('EDIT'),'node/'.$node->nid.'/edit', array('query'=>drupal_get_destination()))."</div>";
      }
			   $image_settings = array(
			   'style_name' => 'slideshow',
			   'path' => $node_obj->field_slider_image['und'][0]['uri'],
               'border-radius' => $image_corner_radius['und'][0]['value'].'px',
			   'attributes' => array('class' => 'slider-image'),
			   'getsize' => TRUE,
			   );
			   $image_path = theme('image_style', $image_settings);
						print $image_path;
    ?>
	 </div>
		
		   <div id="position_<?php print $box_location; ?>" class="slideshow_text" style="width:<?php print $box_width; ?>; background-color:<?php print $box_bg_color; ?>; text-align:<?php print $text_align; ?>;">
       <div class="position">
							     <div class="slide_title" style="font-size:<?php print $title_font_size; ?>; color:<?php print $head_font_color; ?>; font-family:<?php print $head_font_typeface; ?>;"><?php print render($content['field_head']); ?></div>  
												<div class="slide_text" style="font-size:<?php print $font_size; ?>; color:<?php print $text_color; ?>;font-family:<?php print $font_typeface; ?>; line-height: <?php print $head_line_spacing; ?>">
												<?php 
										  		if(!empty($node_obj->field_text_box)){
												    print $node_obj->field_text_box['und'][0]['value'];
              }
												?>
												</div>
												<div class="link_text" style="color:<?php print $link_color; ?>; background:<?php print $link_bg_color; ?>; font-family:<?php print $link_font_typeface; ?>; padding: 10px 10px; border-radius: 10px; width: <?php print $link_button_width; ?>; text-align:<?php print $text_align; ?>"><?php print render($content['field_link_text']); ?></div>
				  	</div>
					</div>
</div>

<!--Caption text for mobile device-->
<div class="mobile_image_text_box_caption">
    <div class="slide_title"><h2>
					<?php print render($content['field_head']); ?>
				<h2></div>  
				<div class="slide_text">
						<?php 	if(!empty($node_obj->field_text_box)){
									 print $node_obj->field_text_box['und'][0]['value'];
       }	?>
					</div>
				<div class="link_text" style="background:<?php print $link_bg_color; ?>; color:<?php print $link_color; ?>"><?php print render($content['field_link_text']); ?></div>
</div>
<!--end Caption text-->

<?php else: ?>

<?php

		$box_location = '';
		$box_width = '';
		$box_bg_color = '';
		$text_color = '';
		$font_size = '';
		$title_font_size = '';
		$font_typeface = '';
		$link_bg_color = '';
		$head_font_color = '';
		$head_font_typeface = '';
		$link_color = '';
        $link_font_typeface = '';
        $head_line_spacing = '';
        $image_corner_radius = '';
$link_button_width = '';


if(!empty($node->field_text_box_location)){
		  $box_location = $node->field_text_box_location['und'][0]['value'];
		}
		if(!empty($node->field_text_box_width)){
    $box_width = $node->field_text_box_width['und'][0]['value'].'px';
  }
		if(!empty($node->field_text_box_background_color)){
    $box_bg_color = $node->field_text_box_background_color['und'][0]['rgb'];
  }
		if(!empty($node->field_text_font_color)){
    $text_color = $node->field_text_font_color['und'][0]['rgb'];
  }
		if(!empty($node->field_text_font_size)){
    $font_size = $node->field_text_font_size['und'][0]['value'].'px';
  }
		if(!empty($node->field_text_font_typefaces)){
    $font_typeface = $node->field_text_font_typefaces['und'][0]['value'];
  }
		if(!empty($node->field_title_font_size)){
    $title_font_size = $node->field_title_font_size['und'][0]['value'].'px';
  }
		if(!empty($node_obj->field_head_font_color)){
    $head_font_color = $node_obj->field_head_font_color['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_link_color)){
    $link_color = $node_obj->field_link_color['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_link_background)){
    $link_bg_color = $node_obj->field_link_background['und'][0]['rgb'];
  }
		if(!empty($node_obj->field_head_font_typefaces)){
    $head_font_typeface = $node_obj->field_head_font_typefaces['und'][0]['value'];
  }
               if(!empty($node_obj->field_link_font_typeface)){
    $link_font_typeface = $node_obj->field_link_font_typeface['und'][0]['value'];
  }
        if(!empty($node_obj->field_head_line_spacing)){
    $head_line_spacing = $node_obj->field_head_line_spacing['und'][0]['value'].'em';
  }
        		if(!empty($node_obj->field_slide_image_corner_radius)){
    $image_corner_radius = $node_obj->field_slide_image_corner_radius['und'][0]['value'].'px';
  }
        if(!empty($node_obj->field_link_button_width)){
    $link_button_width = $node_obj->field_link_button_width['und'][0]['value'].'px';
  }

		$text_align = $node->field_text_justify['und'][0]['value'];
?>
<div id="slideshow">
	 <div class="slideshow_img" style="border-radius:<?php print $image_corner_radius; ?>">
	   <?php
			   if(user_access('administer nodes')){
            print "<div class='edit_link'>".l(t('EDIT'),'node/'.$node->nid.'/edit', array('query'=>drupal_get_destination()))."</div>";
      }
			   $image_settings = array(
			   'style_name' => 'slideshow',
			   'path' => $node->field_slider_image['und'][0]['uri'],
			   'attributes' => array('class' => 'slider-image'),
			   'getsize' => TRUE,
			   );
			   $image_path = theme('image_style', $image_settings);
						print $image_path;
    ?>
	 </div>
		
		   <div id="position_<?php print $box_location; ?>" class="slideshow_text" style="width:<?php print $box_width; ?>; background:<?php print $box_bg_color; ?>; text-align:<?php print $text_align; ?>;">
       <div class="position">
							     <div class="slide_title" style="font-size:<?php print $title_font_size; ?>; font-family:<?php print $head_font_typeface; ?>; color:<?php print $head_font_color; ?>"><?php print render($content['field_head']); ?></div>  
												<div class="slide_text"  style="font-size:<?php print $font_size; ?>; font-family:<?php print $font_typeface; ?>; color:<?php print $text_color; ?>">
												<?php 
										  		if(!empty($node->field_text_box)){
												    print $node->field_text_box['und'][0]['value'];
              }
												?>
												</div>
												<div class="link_text" style="color:<?php print $link_color; ?>; background: <?php print $link_bg_color; ?> font-family:<?php print $link_font_typeface; ?>; padding: 10px 10px; border-radius: 10px; width: <?php print $link_button_width; ?>; text-align:<?php print $text_align; ?>"><?php print render($content['field_link_text']); ?></div>
				  	</div>
					</div>

</div>

<!--Caption text for mobile device-->
<div class="mobile_image_text_box_caption">
    <div class="slide_title"><h2>
					<?php   print $node->title;  ?>
				<h2></div>  
				<div class="slide_text">
						<?php 	if(!empty($node->field_text_box)){
									 print $node->field_text_box['und'][0]['value'];
       }	?>
					</div>
				<div class="link_text"><?php print render($content['field_link_text']); ?></div>
</div>
<!--end Caption text-->

<?php endif; ?>
