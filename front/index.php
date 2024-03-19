<?php
/** Front Side Global Content Print Strat */
add_action( 'init', 'wsppc_global_content_print_function' );
function wsppc_global_content_print_function() {
	$wsppc_hooks	=	wsppc_get_hook();
	if(!empty($wsppc_hooks)){
		foreach($wsppc_hooks as $key => $wsppc_hook){

			if($key == 'woocommerce_after_single_product_summary'){
				add_action( $key, 'wsppc_single_product_product_summary_hook',8);

			}elseif($key == 'woocommerce_single_product_summary'){
				add_action( $key, 'wsppc_single_product_page_hook',4);

			}elseif($key == 'woocommerce_after_product_title'){
				add_action( 'woocommerce_single_product_summary','wsppc_woocommerce_after_product_title',5);

			}elseif($key == 'woocommerce_after_product_price'){
				add_action( 'woocommerce_single_product_summary' , 'wsppc_woocommerce_after_product_price' ,10);

			}elseif($key == 'woocommerce_product_thumbnails'){
				add_action( 'woocommerce_product_thumbnails','wsppc_woocommerce_product_thumbnails',5);

			}elseif($key == 'woocommerce_after_product_thumbnails'){
				add_action( 'wp_footer','wsppc_woocommerce_after_product_thumbnails',10);

			}else{
				add_action( $key, 'wsppc_single_product_page_hook',5);
			}
	
		}
	}
}
function wsppc_single_product_page_hook($arg) {
	$hook = current_filter();
	$wsppc_hooks=wsppc_get_hook();

	if(isset($wsppc_hooks[$hook]) && !empty($wsppc_hooks[$hook])) {
		echo "<div class='wsppc_div_block ".$hook." '>";
		echo wsppc_output($wsppc_hooks[$hook]);
		echo "</div>";
	}
	
}

function wsppc_single_product_product_summary_hook($arg) {
	$hook = current_filter();
	$wsppc_hooks=wsppc_get_hook(); 

	if(isset($wsppc_hooks[$hook]) && !empty($wsppc_hooks[$hook])) {
		echo "<div class='wsppc_div_block wsppc_product_summary_text'>";
		echo wsppc_output($wsppc_hooks[$hook]);
		echo "</div>";
	}
}

function wsppc_woocommerce_after_product_title(){
	$wsppc_hooks=wsppc_get_hook();
	if(isset($wsppc_hooks['woocommerce_after_product_title']) && !empty($wsppc_hooks['woocommerce_after_product_title'])) {
		echo "<div class='wsppc_div_block woocommerce_after_product_title'>";
		echo wsppc_output($wsppc_hooks['woocommerce_after_product_title']);
		echo "</div>";
	}
}

function wsppc_woocommerce_after_product_price(){
	$wsppc_hooks=wsppc_get_hook(); 
	if(isset($wsppc_hooks['woocommerce_after_product_price']) && !empty($wsppc_hooks['woocommerce_after_product_price'])) {
		echo "<div class='wsppc_div_block woocommerce_after_product_price'>";
		echo wsppc_output($wsppc_hooks['woocommerce_after_product_price']);
		echo "</div>";
	}
}

function wsppc_woocommerce_product_thumbnails($arg) {
	$wsppc_hooks=wsppc_get_hook(); 
	if(isset($wsppc_hooks['woocommerce_product_thumbnails']) && !empty($wsppc_hooks['woocommerce_product_thumbnails'])) {
		echo "<div class='woocommerce_product_thumbnails'>";
		echo wsppc_output($wsppc_hooks['woocommerce_product_thumbnails']);
		echo "</div>";
	}
}

function wsppc_woocommerce_after_product_thumbnails() {
	$wsppc_hooks=wsppc_get_hook(); 
	if(isset($wsppc_hooks['woocommerce_after_product_thumbnails']) && !empty($wsppc_hooks['woocommerce_after_product_thumbnails'])) {
		echo '<div class="woocommerce-after-product-thumbnails-script"><script type="text/javascript">';
        echo 'window.addEventListener("load",function(){if(document.querySelectorAll(".woocommerce-product-gallery").length>0&&document.querySelectorAll(".woocommerce-product-gallery").length>0){var e=document.querySelector(".woocommerce-product-gallery"),r=document.createElement("div");r.className="woocommerce_after_product_thumbnails",r.innerHTML=';
        echo "'".wsppc_output($wsppc_hooks['woocommerce_after_product_thumbnails'])."'";
        echo ',e.appendChild(r)}});';
        echo '</script></div>';
	}
}
/** Front Side Global Content Print End */

/** front side Css */
function wsppc_front_site_css_add() { ?>
	<style>
			.wsppc_div_block {
			display: inline-block;
			width: 100%;
			margin-top: 10px;
		}
		.wsppc_div_block.wsppc_product_summary_text {
			display: inline-block;
			width: 100%;
		}
		.woocommerce_product_thumbnails {
			display: inline-block;
		}
		
	</style>
    <?php
}
add_action('wp_head', 'wsppc_front_site_css_add');