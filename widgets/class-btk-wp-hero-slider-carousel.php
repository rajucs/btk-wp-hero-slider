<?php
// The widget class
class BTK_wp_hero_slider_widget extends WP_Widget
{

    // Main constructor
    public function __construct()
    {
        parent::__construct(
            'btk_wp_hero_slider_widget',
            __('BTK Hero slider', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend )
    public function form($instance)
    {

        // Set widget defaults
        $defaults = array(
            'btk_hero_shortcode'    => '',
        );

        // Parse current settings with defaults
        extract(wp_parse_args((array) $instance, $defaults)); ?>

        <?php // Widget Title 
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btk_hero_shortcode')); ?>"><?php _e('Add Shortcode', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('btk_hero_shortcode')); ?>" name="<?php echo esc_attr($this->get_field_name('btk_hero_shortcode')); ?>" type="text" value="<?php echo esc_attr($btk_hero_shortcode); ?>" />
        </p>

<?php }

    // Update widget settings
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['btk_hero_shortcode']     = isset($new_instance['btk_hero_shortcode']) ? wp_strip_all_tags($new_instance['btk_hero_shortcode']) : '';
        return $instance;
    }

    // Display the widget
    public function widget($args, $instance)
    {

        extract($args);

        // Check the widget options
        $btk_hero_shortcode     = isset($instance['btk_hero_shortcode']) ? $instance['btk_hero_shortcode'] : '';

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';

        // Display text field
        if ($btk_hero_shortcode) {
            echo '<p>' . $btk_hero_shortcode . '</p>';
        }

        echo '</div>';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
    }
}
