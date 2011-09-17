/** Eventbrite admin editor screen **/

jQuery(function($) {
    var opts = {
        dateFormat: 'yy-mm-dd',
        showSecond: true,
        timeFormat: 'hh:mm:ss'
    };
    $('#start_date').datetimepicker( opts );
    $('#end_date').datetimepicker( opts );
    $('[id^=start_sales_]').datetimepicker( opts );
    $('[id^=end_sales_]').datetimepicker( opts );
});