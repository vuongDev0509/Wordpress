<?php
	function custom_ajax_scripts() {
	global $wp_query;

	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'custom_ajax', get_stylesheet_directory_uri() . '/assets/js/custom_ajax.js', array('jquery') );
	wp_localize_script( 'custom_ajax', 'custom_ajax_params', array(
		'ajaxurl' => site_url() .'/wp-admin/admin-ajax.php',
	) );
 	wp_enqueue_script( 'custom_ajax' );
}
add_action( 'wp_enqueue_scripts', 'custom_ajax_scripts' );



include_once get_template_directory() . '/theme-includes/init.php';
add_action( 'wp_ajax_loadpostt', 'loadpost_init' );
add_action( 'wp_ajax_nopriv_loadpostt', 'loadpost_init' );
function loadpost_init() {
	ob_start(); //bắt đầu bộ nhớ đệm
	$id = $_POST['id_cate'];
	if($id){
		$term = array();
		array_push($term, $id);
		$args2 = array(
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
    $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    wp_send_json_success($result); // trả về giá trị dạng json
    die(); //bắt buộc phải có khi kết thúc
}