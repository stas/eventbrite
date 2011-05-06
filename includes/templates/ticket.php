<input type="hidden" name="tickets[<?php echo $tid; ?>][ticket_id]" value="<?php echo $ticket_id; ?>" />
<p>
    <label for="is_donation_<?php echo $tid; ?>">
        <input id="is_donation_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][is_donation]" type="checkbox" <?php checked( $is_donation, 1 ); ?>/>
        <strong><?php _e( 'Donation', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="name_<?php echo $tid; ?>">
        <strong><?php _e( 'Name', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="name_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][name]" class="widefat" value="<?php echo $name; ?>" />
</p>
<p>
    <label for="description_<?php echo $tid; ?>">
        <strong><?php _e( 'Description', 'eventbrite' ); ?></strong>
    </label>
    <textarea id="description_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][description]" class="widefat" style="height: 100px;" ><?php 
        echo $description;
    ?></textarea>
</p>
<p>
    <label for="price_<?php echo $tid; ?>">
        <strong><?php _e( 'Price', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="price_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][price]" class="widefat" value="<?php echo $price; ?>" />
</p>
<p>
    <label for="quantity_<?php echo $tid; ?>">
        <strong><?php _e( 'Quantity', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="quantity_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][quantity]" class="widefat" value="<?php echo $quantity; ?>" />
</p>
<p>
    <label for="start_sales_<?php echo $tid; ?>">
        <strong><?php _e( 'Start Sales Date', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="start_sales_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][start_sales]" class="widefat" value="<?php echo $start_sales; ?>" />
</p>
<p>
    <label for="end_sales_<?php echo $tid; ?>">
        <strong><?php _e( 'End Sales Date', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="end_sales_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][end_sales]" class="widefat" value="<?php echo $end_sales; ?>" />
</p>
<p>
    <label for="include_fee_<?php echo $tid; ?>">
        <input id="include_fee_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][include_fee]" type="checkbox" <?php checked( $include_fee, 1 ); ?>/>
        <strong><?php _e( 'Add Eventbrite Fee', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="min_<?php echo $tid; ?>">
        <strong><?php _e( 'Minimum Number per Order', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="min_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][min]" class="widefat" value="<?php echo $min; ?>" />
</p>
<p>
    <label for="max_<?php echo $tid; ?>">
        <strong><?php _e( 'Maximum Number per Order', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="max_<?php echo $tid; ?>" name="tickets[<?php echo $tid; ?>][max]" class="widefat" value="<?php echo $max; ?>" />
</p>

