<?php wp_nonce_field( 'eventbrite', 'eventbrite_nonce' ); ?>

<p>
    <label for="start_date">
        <strong><?php _e( 'Start Date', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="start_date" name="event[start_date]" class="widefat" value="<?php echo $start_date; ?>" />
</p>
<p>
    <label for="end_date">
        <strong><?php _e( 'End Date', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="end_date" name="event[end_date]" class="widefat" value="<?php echo $end_date; ?>" />
</p>
<p>
    <label for="timezone">
        <strong><?php _e( 'Timezone', 'eventbrite' ); ?></strong>
    </label>
    <select id="timezone" name="event[timezone]" class="widefat">
        <?php echo wp_timezone_choice( $timezone ? $timezone : $gmt_offset ); ?>
    </select>
</p>
<p>
    <label for="privacy">
        <strong><?php _e( 'Privacy', 'eventbrite' ); ?></strong>
    </label>
    <select id="privacy" name="event[privacy]" class="widefat">
        <option value="0" <?php selected( $privacy, 0 ); ?>>
            <?php _e( 'Private', 'eventbrite' ); ?>
        </option>
        <option value="1" <?php selected( $privacy, 1 ); ?>>
            <?php _e( 'Public', 'eventbrite' ); ?>
        </option>
    </select>
</p>
<p>
    <label for="capacity">
        <strong><?php _e( 'Capacity', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="capacity" name="event[capacity]" class="widefat" value="<?php echo $capacity; ?>" />
</p>
<p>
    <label for="currency">
        <strong><?php _e( 'Currency', 'eventbrite' ); ?></strong>
    </label>
    <select id="currency" name="event[currency]" class="widefat">
        <?php foreach ( $currency_list as $c ): ?>
            <option value="<?php echo $c ?>" <?php selected( $currency, $c ); ?>>
                <?php echo $c; ?>
            </option>
        <?php endforeach; ?>
    </select>
</p>


