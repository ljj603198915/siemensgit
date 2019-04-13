/**
 * Created by Administrator on 14-11-16.
 */
$(document).ready(function() {
    $('#menu').tendina({
        openCallback: function(clickedEl) {
            clickedEl.addClass('opened');
        },
        closeCallback: function(clickedEl) {
            clickedEl.addClass('closed');
        }
    });

});
