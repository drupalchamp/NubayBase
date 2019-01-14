<?php if ($page == 0): ?>

<?php
  $node_obj = node_load($node->nid);

		$box_location = '';
		$ck_text = '';
        $image_corner_radius = '';


if(!empty($node_obj->field_text_box_location)){
		  $box_location = $node_obj->field_text_box_location['und'][0]['value'];
		}
if(!empty($node_obj->field_ckeditor_text)){
    $ck_text = $node_obj->field_ckeditor_text['und'][0]['value'];
  }
if(!empty($node_obj->field_border_radius)){
    $image_corner_radius = $node_obj->field_border_radius['und'][0]['value'].'px';
  }
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
		
		   		   <div id="position_<?php print $box_location; ?>">

       <div class="position">
							     <div class="slide_title"><?php print render($content['field_ckeditor_text']); ?></div>  
				  	</div>
					</div>
</div>

<!--Caption text for mobile device-->
<div class="mobile_image_text_box_caption">
    <div class="slide_title"><h2>
					<?php print render($content['field_ckeditor_text']); ?>
				<h2></div>  
				<div class="slide_text">
						<?php 	if(!empty($node_obj->field_ckeditor_text)){
									 print $node_obj->field_ckeditor_text['und'][0]['value'];
       }	?>
					</div>
				
</div>
<!--end Caption text-->

<?php else: ?>

<?php
  $node_obj = node_load($node->nid);

		$box_location = '';
		$ck_text = '';
        $image_corner_radius = '';


if(!empty($node_obj->field_text_box_location)){
		  $box_location = $node_obj->field_text_box_location['und'][0]['value'];
		}
if(!empty($node_obj->field_ckeditor_text)){
    $ck_text = $node_obj->field_ckeditor_text['und'][0]['value'];
  }
if(!empty($node_obj->field_border_radius)){
    $image_corner_radius = $node_obj->field_border_radius['und'][0]['value'].'px';
  }
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
		
		   		   <div id="position_<?php print $box_location; ?>">

       <div class="position">
							     <div class="slide_title"><?php print render($content['field_ck_text']); ?></div>  
												
				  	</div>
					</div>
</div>

<!--Caption text for mobile device-->
<div class="mobile_image_text_box_caption">
    <div class="slide_title"><h2>
					<?php print render($content['field_ckeditor_text']); ?>
				<h2></div>  
				<div class="slide_text">
						<?php 	if(!empty($node_obj->field_ckeditor_text)){
									 print $node_obj->field_ckeditor_text['und'][0]['value'];
       }	?>
					</div>
				
</div>
<!--end Caption text-->
<?php endif; ?>