<?php
    extract( $args, EXTR_SKIP );
    echo $before_widget;
    if ( $title )
        echo $before_title . $title . $after_title;
?>
<iframe src="http://www.eventbrite.com/countdown-widget?eid=<?php echo $event; ?>" height="316" width="220" ></iframe>
<?php echo $after_widget; ?>
