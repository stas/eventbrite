<?php
    wp_nonce_field( 'eventbrite', 'eventbrite_ticket_nonce' );
    $ticket_id = 0;
?>
<ul class="tickets">
    <li style="width: 30%; float: left;">
        <?php include 'ticket.php'; ?>
    </li>
    <?php if( !empty( $tickets ) ) : ?>
        <?php foreach ( $tickets as $t ): ?>
            <li style="width: 30%; float: left;">
                <?php
                    // Reset all variables
                    foreach( $ticket_fields as $k => $v )
                        unset( $$k );
                    
                    $ticket_id++;
                    ob_start();
                    extract( $t );
                    include 'ticket.php';
                    echo ob_get_clean();
                ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
<div style="clear: both;"></div>
