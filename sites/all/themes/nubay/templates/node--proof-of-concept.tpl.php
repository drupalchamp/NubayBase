
<?php if ($page == 0): ?>
  <!--Caption node teaser-->


  <?php
    $field_text_content = '';
    $title =  $node->title;
    $field_upload_background_image_url = 'none';
    $field_specify_color_for_background = 'transparent';
    $background_options = array();
	if(!empty($node->field_background_options['und'])){
	  foreach($node->field_background_options['und'] as $background_option){
        $background_options [] = $background_option['value'];
	  }
	}
    if(!empty($node->field_text_content)){
      $field_text_content = $node->field_text_content['und'][0]['value'];
    }
	if(!empty($node->field_specify_color_for_backgrou) && in_array('1',$background_options)){
      $field_specify_color_for_background = $node->field_specify_color_for_backgrou['und'][0]['rgb'];
    }
    if(!empty($node->field_upload_background_image)&& in_array('2',$background_options)){
      $field_upload_background_image_url = 'url('.file_create_url($node->field_upload_background_image['und'][0]['uri']).')';
    }
  ?>

  <div id="canvas-<?php print $node->nid; ?>" class="canvas">
    <div class="canvas-background-color" style="background-color:<?php print $field_specify_color_for_background; ?>;">
	  <div class="canvas-background-image" style="background-image: <?php print $field_upload_background_image_url; ?>; background-repeat:no-repeat;">
	    <div class="canvas-text" style="color:#ffffff;"><?php print $field_text_content; ?></div>
	  </div>
	</div>
  </div>
  


<?php else: ?>
  <!--Caption node Default-->

  <?php
    $field_text_content = '';
    $title =  $node->title;
    $field_upload_background_image_url = 'none';
    $field_specify_color_for_background = 'transparent';
    $background_options = array();
	if(!empty($node->field_background_options['und'])){
	  foreach($node->field_background_options['und'] as $background_option){
        $background_options [] = $background_option['value'];
	  }
	}
    if(!empty($node->field_text_content)){
      $field_text_content = $node->field_text_content['und'][0]['value'];
    }
	if(!empty($node->field_specify_color_for_backgrou) && in_array('1',$background_options)){
      $field_specify_color_for_background = $node->field_specify_color_for_backgrou['und'][0]['rgb'];
    }
    if(!empty($node->field_upload_background_image)&& in_array('2',$background_options)){
      $field_upload_background_image_url = 'url('.file_create_url($node->field_upload_background_image['und'][0]['uri']).')';
    }
  ?>

  <div id="canvas-<?php print $node->nid; ?>" class="canvas">
    <div class="canvas-background-color" style="background-color:<?php print $field_specify_color_for_background; ?>;">
	  <div class="canvas-background-image" style="background-image: <?php print $field_upload_background_image_url; ?>; background-repeat:no-repeat;">
	    <div class="canvas-text" style="color:#ffffff;"><?php print $field_text_content; ?></div>
	  </div>
	</div>
  </div>
  

<?php endif; ?>
