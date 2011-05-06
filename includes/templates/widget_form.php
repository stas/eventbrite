<p>
    <label for="<?php echo $title_id; ?>">
        <?php _e( 'Title', 'eventbrite' ); ?>:
    </label> 
    <input class="widefat" id="<?php echo $title_id; ?>" name="<?php echo $title_name; ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $list_id; ?>">
        <?php _e( 'Eventbrite event ID', 'eventbrite' ); ?>:
    </label> 
    <?php if( $events && count( $events ) > 0 ): ?>
        <select class="widefat" id="<?php echo $event_id; ?>" name="<?php echo $event_name; ?>">
            <?php foreach( $events as $e ): ?>
                <option value="<?php echo $e['id']; ?>" <?php selected( $e['id'], $event ); ?> ><?php echo $e['title']; ?></option>
            <?php endforeach; ?>
        </select>
    <?php else: ?>
        <br/>
        <em>
            <?php _e( 'No events available yet.','eventbrite' )?>
        </em>
    <?php endif; ?>
</p>
