<?php
/**
 * Plugin Name: Air Horn
 * Version: 0.0.1
 * Author: Jason Stallings
 * Author URI: http://jason.stallin.gs
 * License: MIT
 */

add_action('wp_login', 'air_horn_sound_setflag', 10, 2);
add_action('admin_footer', 'air_horn_actually_playsound');
add_action('admin_bar_menu', 'air_horn_toolbar', 999);
add_action( 'admin_enqueue_scripts', 'air_horn_load_scripts' );

function air_horn_sound_setflag($user_login, $user)
{
	update_user_meta($user->ID, 'air_horn_playsound', 1);
}

function air_horn_actually_playsound()
{
	if (get_user_meta( get_current_user_id(), 'air_horn_playsound', true ) == 1)
	{	
		update_user_meta(get_current_user_id(), 'air_horn_playsound', 0);
		?>
		<audio  autoplay>
  			<source src="<?php echo plugins_url( 'airhorn.mp3', __FILE__ ); ?>" type="audio/mpeg">
		</audio>
		<?php
	}
}

function air_horn_toolbar($wp_admin_bar) 
{
        $args = array(
                'id'    => 'play_air_horn',
                'title' => 'Air Horn',
                'meta'  => array( 'class' => 'airhorn_button' )
        );
        
        if (is_admin())
        {
        	$wp_admin_bar->add_node( $args );
       	}
}

function air_horn_load_scripts() 
{
	wp_register_script('howler', plugins_url( 'howler.min.js', __FILE__ ));
	wp_register_script('airhorn', plugins_url( 'airhorn.js', __FILE__ ), array( 'jquery', 'howler'));
	wp_enqueue_script('airhorn');
	wp_localize_script('airhorn', 'airhorn_vars', array('url' => plugins_url( 'airhorn.mp3', __FILE__ )));
}
