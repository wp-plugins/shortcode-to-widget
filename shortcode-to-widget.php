<?php
/*
Plugin Name: Shortcode To Widget
Plugin URI: http://wp-time.com/shortcode-to-widget/
Description: Display any shortcode to your sidebar easily.
Version: 1.2
Author: Qassim Hassan
Author URI: http://qass.im
License: GPLv2 or later
*/

/*  Copyright 2015 Qassim Hassan (email: qassim.pay@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Shortcode to widget
class WPTimeShortcodeToWidget extends WP_Widget {
	function WPTimeShortcodeToWidget() {
		parent::__construct( false, 'Shortcode To Widget', array('description' => 'Display any shortcode to sidebar.') );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		$shortcode = $instance['shortcode'];

		?>
            
			<?php echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
            
			<?php 
				if( empty($shortcode) ){
					echo "<ul><li>Please enter your shortcode.</li></ul>";
				}else{
					echo do_shortcode($shortcode);
				}
			 ?>
            
            <?php echo  $args['after_widget']; ?>
            
        <?php
	}//widget
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['shortcode'] = $new_instance['shortcode'];
		return $instance;
	}//update
	
	function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance
		);
		
		$defaults = array(
			'title' 	=> 'Shortcode To Widget',
			'shortcode' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$shortcode = $instance['shortcode'];
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
            
			<p>
				<label for="<?php echo $this->get_field_id('shortcode'); ?>">Shortcode:</label> 
				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>"><?php echo $shortcode; ?></textarea>
			</p>
        <?php
		
	}//form
	
}
add_action('widgets_init', create_function('', 'return register_widget("WPTimeShortcodeToWidget");') );

?>