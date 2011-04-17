<?php if( $flash ) { ?>
    <div id="message" class="updated fade">
        <p><strong><?php echo $flash; ?></strong></p>
    </div>
<?php } ?>
<div id="icon-tools" class="icon32"><br /></div>
<div class="wrap">
    <h2><?php _e( 'Eventbrite for WordPress','eventbrite' ); ?></h2>
    <div id="poststuff" class="metabox-holder">
        <div class="postbox">
            <h3 class="hndle" ><?php _e( 'About','eventbrite' )?></h3>
            <div class="inside">
                <p>
                    <?php _e( 'Eventbrite for WordPress is a complete solution to manage events directly from WordPress.','eventbrite' ); ?>
                </p>
                <p>
                    <?php _e( 'To enable the plugin, please fill the fields below.','eventbrite' ); ?>
                </p>
                <form action="" method="post">
                    <?php wp_nonce_field( 'eventbrite', 'eventbrite_options_nonce' ); ?>
                    <p>
                        <label for="eventbrite_app_key">
                            <strong><?php _e( 'Eventbrite application key','eventbrite' )?></strong>
                        </label>
                        <input type="text" id="eventbrite_app_key" name="eventbrite_app_key" class="widefat" value="<?php echo $eventbrite_app_key; ?>" />
                    </p>
                    <p>
                        <label for="eventbrite_user_key">
                            <strong><?php _e( 'Eventbrite user key','eventbrite' )?></strong>
                        </label>
                        <input type="text" id="eventbrite_user_key" name="eventbrite_user_key" class="widefat" value="<?php echo $eventbrite_user_key; ?>" />
                    </p>
                    <p>
                        <label for="eventbrite_user_email">
                            <strong><?php _e( 'Eventbrite user email','eventbrite' )?></strong>
                        </label>
                        <input type="text" id="eventbrite_user_email" name="eventbrite_user_email" class="widefat" value="<?php echo $eventbrite_user_email; ?>" />
                    </p>
                    <p>
                        <label for="eventbrite_user_pass">
                            <strong><?php _e( 'Eventbrite user password','eventbrite' )?></strong>
                        </label>
                        <input type="password" id="eventbrite_user_pass" name="eventbrite_user_pass" class="widefat" value="<?php echo $eventbrite_user_pass; ?>" />
                    </p>
                    <p>
                        <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' )?>"/>
                    </p>
                </form>
            </div>
        </div>
        
        <?php do_action( 'eventbrite_options_screen' ); ?>
        
    </div>
</div>
