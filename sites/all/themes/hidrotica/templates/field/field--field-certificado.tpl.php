<?php
	$imagen =""; 
	$url = "";
?>
	<!-- Place somewhere in the <body> of your page -->
<?php for ($i=0; $i < count($items); $i++) { 

	if (isset($items[$i]['field_enlace_banner']['#items'][0]['url'])){
		$url = $items[$i]['field_enlace_banner']['#items'][0]['url'];
	}

	$imagen .= "<li>
	     		 <a href=\"".$url."\" target=\"_blank\"><img src=\"/sites/default/files/imagen_certificado/".$items[$i]['field_image']['#items'][0]['filename']."\" /></a>
	 		   </li>";
} ?>
<div class="<?php print $classes; ?>">
	<div class="certificaciones">
		<?php if($element['#object']->type == "proyectos_y_servicios"):?>
		<h3>Certificados por:</h3>
		<?php endif; ?>
	  <ul class="listado">
	    <?php print $imagen ?>
	  </ul>
	</div>
</div>