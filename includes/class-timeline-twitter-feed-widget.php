<?php

class Timeline_Twitter_Feed_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'twitter_feed_widget',
			__( 'Timeline Twitter Feed', Timeline_Twitter_Feed::TEXTDOMAIN ),
			array( 'description' => __( 'Widget for the Timeline Twitter Feed', Timeline_Twitter_Feed::TEXTDOMAIN ), )
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( $instance['title'] ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		echo '<div class="twitter-feed-widget">';
		if ( $instance['terms'] ) {
			echo do_shortcode( '[timeline-twitter-feed terms="' . $instance['terms'] . '"]' );
		} else {
			echo do_shortcode( '[timeline-twitter-feed]' );
		}
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$terms = isset( $instance['terms'] ) ? $instance['terms'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); // will be translated by WordPress ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'terms' ); ?>"><?php _e( 'Hashtags:', Timeline_Twitter_Feed::TEXTDOMAIN ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'terms' ); ?>" name="<?php echo $this->get_field_name( 'terms' ); ?>" type="text" value="<?php echo esc_attr( $terms ); ?>">
		</p>
		<p class="description">
			<?php _e( 'Here are some examples for the hashtags', Timeline_TWitter_Feed::TEXTDOMAIN ) ?>:<br />
			<em>#WP<br />
			#WP OR #WordPress<br />
			#WP OR #WordPress OR #Blog OR #CMS<br />
			<br />
			<?php _e( 'You can use just about any term you want and decide how many terms you want to use. Make sure every term starts with "#" and seperate the terms with "OR".', Timeline_TWitter_Feed::TEXTDOMAIN ); ?>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['terms'] = ! empty( $new_instance['terms'] ) ? strip_tags( $new_instance['terms'] ) : '';
		return $instance;
	}

}