
<?php if ($page == 0): ?>
  <!--Caption node teaser-->

  <?php   print $node->title;  ?>

<?php else: ?>
  <!--Caption node Default-->

  <?php
    $field_text_content = '';
    $title =  $node->title;
    $field_upload_background_image_url = 'none';
    $field_specify_color_for_background = 'transparent';

    if(!empty($node->field_text_content)){
      $field_text_content = $node->field_text_content['und'][0]['value'];
    }
	if(!empty($node->field_specify_color_for_backgrou)){
      $field_specify_color_for_background = $node->field_specify_color_for_backgrou['und'][0]['rgb'];
    }
    if(!empty($node->field_upload_background_image)){
      $field_upload_background_image_url = 'url('.file_create_url($node->field_upload_background_image['und'][0]['uri']).')';
    }
  ?>

  <div id="canvas-<?php print $node->nid; ?>" class="canvas">
    <div class="canvas-background-color" style="background-color:<?php print $field_specify_color_for_background; ?>;">
	  <div class="canvas-background-image" style="background-image: <?php print $field_upload_background_image_url; ?>; background-repeat:no-repeat;">
	    <div class="canvas-text" style="text-align:center; color:#ffffff;"><?php print $field_text_content; ?></div>
	  </div>
	</div>
  </div>
  

<?php endif; ?>
