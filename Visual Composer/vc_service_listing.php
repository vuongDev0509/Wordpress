<?php
/**
 * Created by Vo Van Vuong.
 * User: VVV
 * Date: 28/04/2020
 * Project Name: Fightclub
 * Element Description: VC Service Listing
 */
// Element Class
class vcServiceListing extends WPBakeryShortCode {
    // Element Init
    function __construct() {
        $this->vc_service_listing_mapping();
        add_shortcode( 'vc_service_listing', array( $this, 'vc_service_listing_html' ) );
    }

    // Element Mapping
    public function vc_service_listing_mapping() {
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name' => __('Vc Services Listing', 'text-domain'),
                'base' => 'vc_service_listing',
                'description' => __('Another simple VC box', 'text-domain'),
                'category' => __('My Custom Elements', 'text-domain'),
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',
                'params' => array(
                 /* source */
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Total Items', 'fightclub' ),
                        'param_name' => 'service_total_items',
                        'description' => __( 'Set max limit for items in event or enter -1 to display all (limited to 1000).', 'fightclub' ),
                        'value' => 3,
                        'group' => 'Source',
                        'admin_label'   => true,
                    ),
                    array(
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'fightclub' ),
                        'param_name' => 'el_id',
                        'description' => __( 'Enter element ID .', 'fightclub' ),
                        'group' => 'Source',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Extra class name', 'fightclub' ),
                        'param_name' => 'el_class',
                        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fightclub' ),
                        'group' => 'Source',
                    ),
                    /* css editor */
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'Css', 'fightclub' ),
                        'param_name' => 'css_item',
                        'group' => __( 'Design Options items', 'fightclub' ),
                    ),
                ),
            )
        );
    }


    // Element HTML
    public function vc_service_listing_html( $atts ) {
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'self'              => '',
                    'content'           => '',
                    /* Source */
                    'service_total_items'      => __('3', 'fightclub'),
                    'el_class'                 => '',
                    'el_id'                    => '',

                ),
                $atts
            )
        );

        if($service_total_items > 0){
            $posts_per_page =  $service_total_items;
        }else{
            $posts_per_page = -1;
        }
        $args = array(
            'post_type'      => 'services',
            'post_status'    => 'publish',
            'posts_per_page' => $posts_per_page,
        );
        $the_query = new WP_Query( $args );
        ob_start(); ?>
        <div id ="<?php echo $el_id; ?>" class="bt-element-services-listing bt-element-composer <?php echo $el_class; ?>">

            <?php
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) :
                 $the_query->the_post();
                 $id = get_the_ID();
                 $link_service = get_permalink($id);
                 ?>
                     <div class="bt-container-service">
                     <div class="bt-thumbnail-service">
                        <div class="bt-image-service" style="background: url(<?php the_post_thumbnail_url($id); ?>) no-repeat scroll center center / cover;">
                            <div class="bt-overlay"> </div>
                        </div>
                     </div>
                     <div class="bt-content-services">
                            <h2 class="bt-title"><a href="<?php echo $link_service; ?>"><?php the_title(); ?></a></h2>
                            <div class="bt-excerpt"> <?php the_excerpt();  ?> </div>
                            <div class="bt-btn-service"> <a href="<?php echo $link_service; ?>"> Read More </a></div>
                     </div>
              </div>
                <?php endwhile;
           endif;
        ?>

    </div>
            <?php   return ob_get_clean(); ?>
        <?php
    }
} // End Element Class
// Element Class Init
new vcServiceListing();
