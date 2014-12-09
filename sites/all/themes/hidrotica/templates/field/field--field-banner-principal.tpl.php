<?php
	$imagen =""; 
	$url = "";
	$caption = "";
?>
	<!-- Place somewhere in the <body> of your page -->
<?php for ($i=0; $i < count($items); $i++) { 

	if (isset($items[$i]['field_enlace_banner']['#items'][0]['url'])){
		$url = $items[$i]['field_enlace_banner']['#items'][0]['url'];
	}

	if (isset($items[$i]['field_descripcion']['#items'][0]['value'])){
		if (strlen($items[$i]['field_descripcion']['#items'][0]['value']) > 87){
			$caption = substr($items[$i]['field_descripcion']['#items'][0]['value'], 0, 125)."...";
		}else{
			$caption = $items[$i]['field_descripcion']['#items'][0]['value'];
		}
	}

	$imagen .= "<li>
	     		 <a href=\"".$url."\"><img src=\"/sites/default/files/imagenes_banner/".$items[$i]['field_banner']['#items'][0]['filename']."\" /><div class=\"flex-caption-absoluto\"><div class=\"flex-caption\">".$caption."</div></div></a>
	 		   </li>";
} ?>
<div class="<?php print $classes; ?>">
	<div class="flexslider-homepage" id="banner-principal">
	  <ul class="slides">
	    <?php print $imagen ?>
	  </ul>
	</div>
</div>