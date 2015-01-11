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
  			<source src="<?php plugins_url( 'airhorn.mp3', __FILE__ ); ?>" type="audio/mpeg">
		</audio>
		<?php
	}
}
