// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
    
    
    
   
    
}());

// Place any jQuery/helper plugins in here.

$.getScript( "js/vendor/bootstrap/js/bootstrap.min.js", function( data, textStatus, jqxhr ) {
 // console.log( data ); // Data returned
//  console.log( textStatus ); // Success
//  console.log( jqxhr.status ); // 200
 // console.log( "Boostrap load was performed." );
}); 