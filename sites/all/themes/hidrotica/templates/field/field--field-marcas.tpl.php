<?php
	$imagen =""; 
	
?>

	<!-- Place somewhere in the <body> of your page -->
<?php for ($i=0; $i < count($items); $i++) { 
$url = "";
	if (isset($items[$i]['field_enlace_banner']['#items'][0]['url'])){
		$url = $items[$i]['field_enlace_banner']['#items'][0]['url'];
	}

	$imagen .= "<li>
	     		 <a href=\"".$url."\"><img src=\"/sites/default/files/imagen_marca/".$items[$i]['field_image']['#items'][0]['filename']."\" /></a>
	 		   </li>";
} ?>
	<div class="marcas">
		<p>NUESTRAS MARCAS</p>
	  <ul class="listado-marcas">
	    <?php print $imagen ?>
	  </ul>
	</div>