<?php wp_nonce_field( 'eventbrite', 'eventbrite_ticket_nonce' ); ?>

<p>
    <label for="is_donation">
        <input id="is_donation" name="ticket['is_donation']" type="checkbox" <?php checked( $is_donation, 1 ); ?>/>
        <strong><?php _e( 'Donation', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="name">
        <strong><?php _e( 'Name', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="name" name="ticket[name]" class="widefat" value="<?php echo $name; ?>" />
</p>
<p>
    <label for="description">
        <strong><?php _e( 'Description', 'eventbrite' ); ?></strong>
    </label>
    <textarea id="description" name="ticket[description]" class="widefat" style="height: 100px;" ><?php 
        echo $description; 
    ?></textarea>
</p>
<p>
    <label for="price">
        <strong><?php _e( 'Price', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="price" name="ticket[price]" class="widefat" value="<?php echo $price; ?>" />
</p>
<p>
    <label for="quantity">
        <strong><?php _e( 'Quantity', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="quantity" name="ticket[quantity]" class="widefat" value="<?php echo $quantity; ?>" />
</p>
<p>
    <label for="start_sales">
        <strong><?php _e( 'Start Sales Date', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="start_sales" name="ticket[start_sales]" class="widefat" value="<?php echo $start_sales; ?>" />
</p>
<p>
    <label for="end_sales">
        <strong><?php _e( 'End Sales Date', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="end_sales" name="ticket[end_sales]" class="widefat" value="<?php echo $end_sales; ?>" />
</p>
<p>
    <label for="include_fee">
        <input id="include_fee" name="ticket['include_fee']" type="checkbox" <?php checked( $include_fee, 1 ); ?>/>
        <strong><?php _e( 'Add Eventbrite Fee', 'eventbrite' ); ?></strong>
    </label>
</p>
<p>
    <label for="min">
        <strong><?php _e( 'Minimum Number per Order', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="min" name="ticket[min]" class="widefat" value="<?php echo $min; ?>" />
</p>
<p>
    <label for="max">
        <strong><?php _e( 'Maximum Number per Order', 'eventbrite' ); ?></strong>
    </label>
    <input type="text" id="min" name="ticket[min]" class="widefat" value="<?php echo $min; ?>" />
</p>

<h2 style="text-align: center"><?php _e( 'OR', 'eventbrite' ); ?></h2>

<p>
    <label for="ticket_to_delete">
        <strong><?php _e( 'Choose a ticket to delete', 'eventbrite' ); ?></strong>
    </label>
    <select id="ticket_to_delete" name="ticket[ticket_to_delete]" class="widefat">
        <option value="">
            <?php _e( 'None', 'eventbrite' ); ?>
        </option>
        <?php if( !empty( $tickets ) ): ?>
            <?php foreach ( $tickets as $k => $v ): ?>
                <option value="<?php echo $k ?>">
                    <?php echo $v['name']; ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</p>
