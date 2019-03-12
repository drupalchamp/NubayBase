
<?php if ($page == 0): ?>
  <!--Caption node teaser-->
  <?php
	$canvas_css = '';
	$canvas_back_color_css = '';
	$canvas_back_img_css = '';
	$canvas_text = '';

    $field_text_content = '';
    $title =  $node->title;
    $field_upload_background_image_url = 'none';
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
      $canvas_back_color_css .= ' background-color:'.$node->field_specify_color_for_backgrou['und'][0]['rgb'].'; ';
    }else{
      $canvas_back_color_css .= 'background-color:transparent;';
	}

    if(!empty($node->field_upload_background_image)&& in_array('2',$background_options)){
      $canvas_back_img_css .= 'background-size: cover;background-image:url('.file_create_url($node->field_upload_background_image['und'][0]['uri']).'); background-repeat:no-repeat;';
    }else{
   	  $canvas_back_img_css .= ' background-image:none; ';
	}

	/////////////margin of an text box within and outside
	if(!empty($node->field_text_box_margin_top_bottom) || !empty($node->field_text_box_margin_left_right)){ 
	  $top_val = $node->field_text_box_margin_top_bottom['und'][0]['value'];
	  $left_val = $node->field_text_box_margin_left_right['und'][0]['value'];
      $canvas_text .= 'margin:'.$top_val.'px '.$left_val.'px; ';
      $canvas_text .= 'padding:'.$top_val.'px '.$left_val.'px; ';
	}

	if(!empty($node->field_image_corners_radius)){ 
      $canvas_css .= 'overflow:hidden; border-radius:'.$node->field_image_corners_radius['und'][0]['value'].'px; ';
	}
	///////image width height calcualtion
	if(!empty($node->field_image_height) || !empty($node->field_image_width)){ 
	  if(!empty($node->field_image_height) && empty($node->field_image_width)){
	    $canvas_back_img_css .= 'width:100%; ';
 	    $canvas_back_img_css .= 'height:'.$node->field_image_height['und'][0]['value'].'px; ';
	  }else if(!empty($node->field_image_width) && empty($node->field_image_height)){
	    $canvas_back_img_css .= 'height:auto; ';
 	    $canvas_back_img_css .= 'width:'.$node->field_image_width['und'][0]['value'].'px; ';
	  }else if(!empty($node->field_image_width) && !empty($node->field_image_height)){
 	    $canvas_back_img_css .= 'width:'.$node->field_image_width['und'][0]['value'].'px; ';
 	    $canvas_back_img_css .= 'height:'.$node->field_image_height['und'][0]['value'].'px; ';
 	  }
	}else if(!empty($node->field_auto)){
	  $canvas_back_img_css .= 'width:100%; ';
 	  $canvas_back_img_css .= 'height:auto; ';
	}
	/////////Text Box - Location on image
	$text_box_css = '';
	if(empty($node->field_text_box_location_on_image)){ 
 	  $canvas_back_img_css .= 'text-align:center;';
	  $canvas_text .= 'text-align:center;';
	}else{
	  $text_box_location_on_image =  $node->field_text_box_location_on_image['und'][0]['value'];
	  $canvas_css .= 'display: table; width:100%;';
	  $canvas_back_color_css .= 'display: table-row;';
      $canvas_back_img_css .= 'display: table-cell;';
  	  if($text_box_location_on_image == 'ml'){
        $canvas_back_img_css .= 'vertical-align: middle;';
      }
  	  if($text_box_location_on_image == 'mc'){
        $canvas_back_img_css .= 'vertical-align: middle;text-align:center;';
      }
  	  if($text_box_location_on_image == 'mr'){
        $canvas_back_img_css .= 'vertical-align: middle;text-align:right;';
      }
  	  if($text_box_location_on_image == 'tl'){
        $canvas_back_img_css .= 'vertical-align: top;';
      }
  	  if($text_box_location_on_image == 'tc'){
        $canvas_back_img_css .= 'vertical-align: top;text-align:center;';
      }
  	  if($text_box_location_on_image == 'tr'){
        $canvas_back_img_css .= 'vertical-align: top;text-align:right;';
      }
      if($text_box_location_on_image == 'bl'){
        $canvas_back_img_css .= 'vertical-align: bottom;';
      }
  	  if($text_box_location_on_image == 'bc'){
        $canvas_back_img_css .= 'vertical-align: bottom;text-align:center;';
      }
  	  if($text_box_location_on_image == 'br'){
        $canvas_back_img_css .= 'vertical-align: bottom;text-align:right;';
      }
	}
	///////text background css
	if(!empty($node->field_text_box_back_color) || !empty($node->field_text_box_background_transp)){
	  $hex = $node->field_text_box_back_color['und'][0]['rgb'];
      list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	  $transp = $node->field_text_box_background_transp['und'][0]['value']/100;
      $canvas_text .= ' background-color:rgba('.$r.','.$g.','. $b.','.$transp.'); display: inline-block;';
	}else{
      $canvas_text .= 'background-color:transparent; display: inline-block;';
	}
	/*if(!empty($node->field_text_box_background_transp)){
	  $transp = $node->field_text_box_background_transp['und'][0]['value']/100;
      $canvas_text .= ' opacity: '.$transp.';filter: alpha(opacity='.$node->field_text_box_background_transp['und'][0]['value'].');';
	}*/
  ?>

  <div id="canvas-<?php print $node->nid; ?>" class="canvas" style="<?php print $canvas_css; ?>">
    <div class="canvas-background-color" style="<?php print $canvas_back_color_css; ?>">
	  <div class="canvas-background-image" style="<?php print $canvas_back_img_css; ?>">
	    <div class="canvas-text" style="color:#ffffff;<?php print $canvas_text; ?>"><?php print $field_text_content; ?></div>
	  </div>
	</div>
  </div>
  
<?php else: ?>
  <!--Caption node Default-->

  <?php
	$canvas_css = '';
	$canvas_back_color_css = '';
	$canvas_back_img_css = '';
	$canvas_text = '';

    $field_text_content = '';
    $title =  $node->title;
    $field_upload_background_image_url = 'none';
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
      $canvas_back_color_css .= ' background-color:'.$node->field_specify_color_for_backgrou['und'][0]['rgb'].'; ';
    }else{
      $canvas_back_color_css .= 'background-color:transparent;';
	}

    if(!empty($node->field_upload_background_image)&& in_array('2',$background_options)){
      $canvas_back_img_css .= 'background-size: cover;background-image:url('.file_create_url($node->field_upload_background_image['und'][0]['uri']).'); background-repeat:no-repeat;';
    }else{
   	  $canvas_back_img_css .= ' background-image:none; ';
	}

	/////////////margin of an text box within and outside
	if(!empty($node->field_text_box_margin_top_bottom) || !empty($node->field_text_box_margin_left_right)){ 
	  $top_val = $node->field_text_box_margin_top_bottom['und'][0]['value'];
	  $left_val = $node->field_text_box_margin_left_right['und'][0]['value'];
      $canvas_text .= 'margin:'.$top_val.'px '.$left_val.'px; ';
      $canvas_text .= 'padding:'.$top_val.'px '.$left_val.'px; ';
	}

	if(!empty($node->field_image_corners_radius)){ 
      $canvas_css .= 'overflow:hidden; border-radius:'.$node->field_image_corners_radius['und'][0]['value'].'px; ';
	}
	///////image width height calcualtion
	if(!empty($node->field_image_height) || !empty($node->field_image_width)){ 
	  if(!empty($node->field_image_height) && empty($node->field_image_width)){
	    $canvas_back_img_css .= 'width:100%; ';
 	    $canvas_back_img_css .= 'height:'.$node->field_image_height['und'][0]['value'].'px; ';
	  }else if(!empty($node->field_image_width) && empty($node->field_image_height)){
	    $canvas_back_img_css .= 'height:auto; ';
 	    $canvas_back_img_css .= 'width:'.$node->field_image_width['und'][0]['value'].'px; ';
	  }else if(!empty($node->field_image_width) && !empty($node->field_image_height)){
 	    $canvas_back_img_css .= 'width:'.$node->field_image_width['und'][0]['value'].'px; ';
 	    $canvas_back_img_css .= 'height:'.$node->field_image_height['und'][0]['value'].'px; ';
 	  }
	}else if(!empty($node->field_auto)){
	  $canvas_back_img_css .= 'width:100%; ';
 	  $canvas_back_img_css .= 'height:auto; ';
	}
	/////////Text Box - Location on image
	$text_box_css = '';
	if(empty($node->field_text_box_location_on_image)){ 
 	  $canvas_back_img_css .= 'text-align:center;';
	  $canvas_text .= 'text-align:center;';
	}else{
	  $text_box_location_on_image =  $node->field_text_box_location_on_image['und'][0]['value'];
	  $canvas_css .= 'display: table; width:100%;';
	  $canvas_back_color_css .= 'display: table-row;';
      $canvas_back_img_css .= 'display: table-cell;';
  	  if($text_box_location_on_image == 'ml'){
        $canvas_back_img_css .= 'vertical-align: middle;';
      }
  	  if($text_box_location_on_image == 'mc'){
        $canvas_back_img_css .= 'vertical-align: middle;text-align:center;';
      }
  	  if($text_box_location_on_image == 'mr'){
        $canvas_back_img_css .= 'vertical-align: middle;text-align:right;';
      }
  	  if($text_box_location_on_image == 'tl'){
        $canvas_back_img_css .= 'vertical-align: top;';
      }
  	  if($text_box_location_on_image == 'tc'){
        $canvas_back_img_css .= 'vertical-align: top;text-align:center;';
      }
  	  if($text_box_location_on_image == 'tr'){
        $canvas_back_img_css .= 'vertical-align: top;text-align:right;';
      }
      if($text_box_location_on_image == 'bl'){
        $canvas_back_img_css .= 'vertical-align: bottom;';
      }
  	  if($text_box_location_on_image == 'bc'){
        $canvas_back_img_css .= 'vertical-align: bottom;text-align:center;';
      }
  	  if($text_box_location_on_image == 'br'){
        $canvas_back_img_css .= 'vertical-align: bottom;text-align:right;';
      }
	}
	///////text background css
	if(!empty($node->field_text_box_back_color) || !empty($node->field_text_box_background_transp)){
	  $hex = $node->field_text_box_back_color['und'][0]['rgb'];
      list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	  $transp = $node->field_text_box_background_transp['und'][0]['value']/100;
      $canvas_text .= ' background-color:rgba('.$r.','.$g.','. $b.','.$transp.'); display: inline-block;';
	}else{
      $canvas_text .= 'background-color:transparent; display: inline-block;';
	}
	/*if(!empty($node->field_text_box_background_transp)){
	  $transp = $node->field_text_box_background_transp['und'][0]['value']/100;
      $canvas_text .= ' opacity: '.$transp.';filter: alpha(opacity='.$node->field_text_box_background_transp['und'][0]['value'].');';
	}*/
  ?>

  <div id="canvas-<?php print $node->nid; ?>" class="canvas" style="<?php print $canvas_css; ?>">
    <div class="canvas-background-color" style="<?php print $canvas_back_color_css; ?>">
	  <div class="canvas-background-image" style="<?php print $canvas_back_img_css; ?>">
	    <div class="canvas-text" style="color:#ffffff;<?php print $canvas_text; ?>"><?php print $field_text_content; ?></div>
	  </div>
	</div>
  </div>
  

<?php endif; ?>
