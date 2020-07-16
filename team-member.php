<?php
/**
 * Plugin Name
 *
 * @package           Team Member
 * @author            Your Name
 * @copyright         2019 Your Name or Company Name
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Team Member
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Your Name
 * Author URI:        https://example.com
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */


// echo plugins_url('',__FILE__);

function codexin_scripts () {


	wp_enqueue_style( 'izi-modal-style', plugins_url('',__FILE__) . '/iziModal.min.css',false,'1.1','all');


	// wp_enqueue_script( 'modernizr-custom',plugins_url('',__FILE__) . '/modernizr-custom.js', array ( 'jquery' ), 1.1, true);

	wp_enqueue_script( 'iziModal-popups',plugins_url('',__FILE__) . '/iziModal.min.js', array ( 'jquery' ), 1.1, true);


	wp_enqueue_script( 'codexin-js',plugins_url('',__FILE__) . '/codexin.js', array ( 'jquery' ), 1.1, true);

	wp_localize_script( 'codexin-js', 'codexin_script', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ) , // WordPress AJAX
		'ajax_nonce' => wp_create_nonce('nonce_code'),
		'button_text' => __('Load More...','codexin') // everything about your loop 
	) );
 

} // codexin_styles ()
add_action( 'wp_enqueue_scripts', 'codexin_scripts');
// add_action( 'admin_enqueue_scripts', 'codexin_admin_scripts');
// Management Team 
// Register Custom Person
function hm_management_team_post_type() {
	$labels = array(
		'name'                  => __( 'New Member', 'codexin' ),
		'singular_name'         => __( 'Team', 'codexin' ),
		'menu_name'             => __( 'Management Team', 'codexin' ),
		'name_admin_bar'        => __( 'Team', 'codexin' ),
		'archives'              => __( 'Team Archives', 'codexin' ),
		'attributes'            => __( 'Team Attributes', 'codexin' ),
		'parent_item_colon'     => __( 'Parent Team:', 'codexin' ),
		'all_items'             => __( 'All Members', 'codexin' ),
		'add_new_item'          => __( 'Add New Team', 'codexin' ),
		'add_new'               => __( 'Add New', 'codexin' ),
		'new_item'              => __( 'New Team', 'codexin' ),
		'edit_item'             => __( 'Edit Team', 'codexin' ),
		'update_item'           => __( 'Update Team', 'codexin' ),
		'view_item'             => __( 'View Team', 'codexin' ),
		'view_items'            => __( 'View Teams', 'codexin' ),
		'search_items'          => __( 'Search Team', 'codexin' ),
		'not_found'             => __( 'Not found', 'codexin' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'codexin' ),
		'featured_image'        => __( 'Featured Image', 'codexin' ),
		'set_featured_image'    => __( 'Set featured image', 'codexin' ),
		'remove_featured_image' => __( 'Remove featured image', 'codexin' ),
		'use_featured_image'    => __( 'Use as featured image', 'codexin' ),
		'insert_into_item'      => __( 'Insert into Team', 'codexin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Team', 'codexin' ),
		'items_list'            => __( 'Teams list', 'codexin' ),
		'items_list_navigation' => __( 'Teams list navigation', 'codexin' ),
		'filter_items_list'     => __( 'Filter Teams list', 'codexin' ),
	);
	$args = array(
		'label'                 => __( 'Management Team', 'codexin' ),
		'description'           => __( 'Team Description', 'codexin' ),
		'labels'                => $labels,
		'supports'              => array('title','thumbnail','editor'),
		'menu_icon'    			=> 'dashicons-businessman',
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'publicly_queryable'  	=> false,
		'query_var'           	=> false
	);
	register_post_type( 'management-team', $args );

}
add_action( 'init', 'hm_management_team_post_type', 0 );

/*
* Syntax:
* [management_team team_type=""]
*
*/
// management-team

add_shortcode( 'management_team','management_team_shortcode' );

function management_team_shortcode( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'team_type' => ''
	   ), $atts));

	   $result = '';
	   ob_start();
	   ?>

	   <div class="management-team">
			<style>
				#member_bio_data{height: 400px; overflow: hidden; }
			</style>

	   		<div class="container-">

	   			<div class="row d-flex flex-wrap">
 						<?php
							// Get 10 most recent product IDs in date descending order.
							$args = array(
								'post_type' 		=> 'management-team',
								'posts_per_page'	=> -1
							);

							$script = '' ;
							$memberbio = '' ;
							$query = new WP_Query( $args );

							// echo count($query_2);
							if( $query->have_posts() ) :
								// run the loop
								while( $query->have_posts() ): $query->the_post(); ?>

								
									<div class="col-sm-3 team-column">

										<div class="team-member">
											<div class="image member-id-<?php the_ID();?>" >
												
												<a class="open_modal" data-id="<?php the_ID();?>" href="#">
													
													<?php the_post_thumbnail(); ?>

												</a>
												
											</div>

											

										</div>

									</div>
									
									<?php
								 endwhile;

							endif;

							wp_reset_postdata();

						 ?>

	   			</div>
	   			<div class="script-area">
	   			
	   			</div>

	   		</div>

	   </div>

		
		<div id="member_bio_data"> 
			<div class="iziModal-content"> 
			</div>
		</div>


	   <?php $result .= ob_get_clean();

	   return $result;

}





// blended learning 
function member_data_by_id_processor(){

	$member_id = intval($_POST['member_id']);
	$nonce_code = sanitize_text_field($_POST['nonce_code']);

	if ( ! $member_id ) {
	  $member_id = '';
	}
	if ( ! wp_verify_nonce( $nonce_code, 'nonce_code' ) ) {
	    die( __( 'Security check', 'textdomain' ) ); 
	}

	// Get 10 most recent product IDs in date descending order.
	$args = array(
		'post_type' 		=> 'management-team',
		'posts_per_page'	=> -1,
		'post__in'          => array($member_id)
	);
	// $products = $query->get_products();
	$query = new WP_Query( $args );
	if( $query->have_posts() ) :
 
		// run the loop
		while( $query->have_posts() ): $query->the_post();

			the_post_thumbnail();

		endwhile;
 	else:
 		echo "<h3 class='col-sm-12 text-center'>".__('Not found','codexin')."</h3>";
	endif;
	wp_reset_postdata();

	die(); // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_member_data_by_id', 'member_data_by_id_processor'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_member_data_by_id', 'member_data_by_id_processor'); // wp_ajax_nopriv_{action}
