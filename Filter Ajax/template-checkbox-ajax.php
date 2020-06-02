<?php
/**
 * Template Name: Template Shop Filter
 */

get_header();
?>
<section class="bt-main-row password-protected-section" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
    <div class="container">
        <div class="bt-content-shop-filter">
            <div class="row">
                <div class="col-md-3 col-sm-12 bt-sidebar-shop-news">
                    <h2 style="font-size: 22px; font-weight: 700; color: #000;"> Filter By Category:</h2>
                    <?php
                    $args = array(
                       'taxonomy' => 'product_cat',
                       'orderby' => 'name',
                       'order'   => 'ASC'
                   );
                   $categories = get_categories($args);
                    ?>
                    <form>
                    <ul class="bt-nav-filter-category">
                        <li class="bt-item-filter-all">
                            <!-- checked="checked" -->
                            <label><input class="bt-btn-filter" name="cate-product"  type="checkbox"  value="all" />
                            All</label> </br>
                        </li>
                    <?php
                   foreach($categories as $category) { ?>
                        <li>
                            <label>
                                <input name="cate-product" class="bt-btn-filter" type="checkbox" value="<?php echo $category ->slug ?>" data-id ="<?php echo $category ->term_id ?>" />
                            <?php echo $category ->name ?></label> </br>
                        </li>
                   <?php } ?>
                    <!-- </ul> -->
                </form>
                </div>
                <div class="col-md-9 col-sm-12 bt-main-shop-news">
                    <div class="bt-content-product woocommerce">
                        <div id="bt-id-product" class="product">
                            <div class="bt-row-product">
                                <?php
                                $args2 = array(
                        		    'post_type' => 'product',
                        		    'post_status' => 'publish',
                        		    'posts_per_page' => -1
                        		);
                                $query = new WP_Query( $args2 );
                                while ( $query->have_posts() ) : $query->the_post(); ?>
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
                                wp_reset_postdata();
                                 ?>
                            </div>
                        </div>
                     </div>
                </div>
             </div>
        </div>
    </div>
</section
<?php
get_footer();
?>
