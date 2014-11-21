<?php
	$imagen =""; 
?>
	<!-- Place somewhere in the <body> of your page -->
<?php for ($i=0; $i < count($items); $i++) { 
	$imagen .= "<li>
	     		 <a href=\"".$items[$i]['field_enlace_banner']['#items'][0]['url']."\"><img src=\"/sites/default/files/imagenes_banner/".$items[$i]['field_banner']['#items'][0]['filename']."\" /></a>
	 		   </li>";
} ?>
<div class="<?php print $classes; ?>">
	<div class="flexslider">
	  <ul class="slides">
	    <?php print $imagen ?>
	  </ul>
	</div>
</div>