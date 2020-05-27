(function( $ ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.taylor-color').each(function() {
            switch ( $(this).attr('name') ) {
                case 'taylor_header_primary_color': {
                    $(this).wpColorPicker({
                        defaultColor: '#222',
                    });
                    break;
                }
                case 'taylor_header_secondary_color': {
                    $(this).wpColorPicker({
                        defaultColor: '#eee',
                    });
                    break;
                }
                default: {
                    $(this).wpColorPicker();
                }
            }
        });

        if ( $('#taylor-use-transparent-header').prop('checked') === false ) {
            $('#taylor-header-colors').hide();
        }

        $('#taylor-use-transparent-header').on('change', function () {
            $('#taylor-header-colors').toggle();
        });
    });
     
})( jQuery );