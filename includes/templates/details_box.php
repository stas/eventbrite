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
<p>
    <label for="accept_paypal">
        <input id="accept_paypal" name="event[accept_paypal]" type="checkbox" <?php checked( $accept_paypal, 1 ); ?>/>
        <strong><?php _e( 'Accept PayPal', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="paypal_email">
        <?php _e( 'PayPal Email', 'eventbrite' ); ?>
    </label>
    <input type="text" id="paypal_email" name="event[paypal_email]" class="widefat" value="<?php echo $paypal_email; ?>" />
</p>
<p>
    <label for="accept_google">
        <input id="accept_google" name="event[accept_google]" type="checkbox" <?php checked( $accept_google, 1 ); ?>/>
        <strong><?php _e( 'Accept Google', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="google_merchant_id">
        <?php _e( 'Google Merchant ID', 'eventbrite' ); ?>
    </label>
    <input type="text" id="google_merchant_id" name="event[google_merchant_id]" class="widefat" value="<?php echo $google_merchant_id; ?>" />
    <label for="google_merchant_key">
        <?php _e( 'Google Merchant Key', 'eventbrite' ); ?>
    </label>
    <input type="text" id="google_merchant_key" name="event[google_merchant_key]" class="widefat" value="<?php echo $google_merchant_key; ?>" />
</p>
<p>
    <label for="accept_check">
        <input id="accept_check" name="event[accept_check]" type="checkbox" <?php checked( $accept_check, 1 ); ?>/>
        <strong><?php _e( 'Accept Check', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="instructions_check">
        <?php _e( 'Instructions For Check', 'eventbrite' ); ?>
    </label>
    <textarea id="instructions_check" name="event[instructions_check]" class="widefat"><?php
        echo $instructions_check;
    ?></textarea>
</p>
<p>
    <label for="accept_cash">
        <input id="accept_cash" name="event[accept_cash]" type="checkbox" <?php checked( $accept_cash, 1 ); ?>/>
        <strong><?php _e( 'Accept Cash', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="instructions_cash">
        <?php _e( 'Instructions For Cash', 'eventbrite' ); ?>
    </label>
    <textarea id="instructions_cash" name="event[instructions_cash]" class="widefat"><?php
        echo $instructions_cash;
    ?></textarea>
</p>
<p>
    <label for="accept_invoice">
        <input id="accept_invoice" name="event[accept_invoice]" type="checkbox" <?php checked( $accept_invoice, 1 ); ?>/>
        <strong><?php _e( 'Accept Invoice', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="instructions_invoice">
        <?php _e( 'Instructions For Invoice', 'eventbrite' ); ?>
    </label>
    <textarea id="instructions_invoice" name="event[instructions_invoice]" class="widefat"><?php
        echo $instructions_invoice;
    ?></textarea>
</p>

