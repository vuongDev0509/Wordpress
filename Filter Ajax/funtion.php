<?php 
// filter radio
add_action( 'wp_ajax_loadproduct', 'load_product_ajax' );
add_action( 'wp_ajax_nopriv_loadproduct', 'load_product_ajax' );
function load_product_ajax() {
	ob_start(); //bắt đầu bộ nhớ đệm
	$id = $_POST['id_cate'];

	if($id){
		$term = array();
		array_push($term, $id);
		$args3 = array(
		    'post_type' => 'product',
		    'post_status' => 'publish',
		    'posts_per_page' => -1,
		    'tax_query' => array(
		        array(
		            'taxonomy'  => 'product_cat',
		            'field'    => 'id',
		            'terms'    => $term,
		        ),
		    ),
		);
	}else{
		$args3 = array(
		    'post_type' => 'product',
		    'post_status' => 'publish',
		    'posts_per_page' => -1
		);
	}
	$post_new = new WP_Query( $args2 ); ?>
	<div class="bt-row-product">
	<?php
    if($post_new->have_posts()):
		while($post_new->have_posts()):$post_new->the_post(); ?>
		<div class="bt-col-3 product-item">
			<div class="bt-content-product-item">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="woocommerce-imagewrapper">
						<div class="woocommerce_before_thumbnail_loop"> </div>
						<a href="<?php the_permalink() ?>" class="woocommerce-product-link"> <?php the_post_thumbnail('medium'); ?>
							<h2 class="woocommerce-loop-product__title"> <?php the_title(); ?> </h2>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
        endwhile;
    endif;
	wp_reset_query(); ?>
	</div>
	<?php
    $result = ob_get_clean();
    wp_send_json_success($result);
    die();
}

// filter checkbox
add_action( 'wp_ajax_loadproductck', 'load_productck_ajax' );
add_action( 'wp_ajax_nopriv_loadproductck', 'load_productck_ajax' );
function load_productck_ajax() {
	ob_start(); //bắt đầu bộ nhớ đệm
	$term = $_POST['term_id'];
	echo "<pre>";
	echo print_r($term);
	echo "</pre>";
	if($term){
		$args2 = array(
		    'post_type' => 'product',
		    'post_status' => 'publish',
		    'posts_per_page' => -1,
		    'tax_query' => array(
		        array(
		            'taxonomy'  => 'product_cat',
		            'field'    => 'id',
		            'terms'    => $term,
					'operator' => 'and',
		        ),
		    ),
		);
	}else{
		$args2 = array(
		    'post_type' => 'product',
		    'post_status' => 'publish',
		    'posts_per_page' => -1
		);
	}
	$post_new = new WP_Query( $args2 ); ?>
	<div class="bt-row-product">
	<?php
    if($post_new->have_posts()):
		while($post_new->have_posts()):$post_new->the_post(); ?>
		<div class="bt-col-3 product-item">
			<div class="bt-content-product-item">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="woocommerce-imagewrapper">
						<div class="woocommerce_before_thumbnail_loop"> </div>
						<a href="<?php the_permalink() ?>" class="woocommerce-product-link"> <?php the_post_thumbnail('medium'); ?>
							<h2 class="woocommerce-loop-product__title"> <?php the_title(); ?> </h2>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
        endwhile;
    endif;
	wp_reset_query(); ?>
	</div>
	<?php
    $result = ob_get_clean();
    wp_send_json_success($result);
    die();
}

?>