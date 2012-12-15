M.block_papercut = {
    init: function(Y, serverurl, username) {
        
        script = document.createElement('script');
        script.setAttribute('src', serverurl+'/content/widgets/widgets.js');
        script.setAttribute('type', 'text/javascript'); 

        document.body.appendChild(script);

        count = 0
        setInterval(function() {
            if (typeof pcGetUserDetails === 'function') {
                clearInterval();
                var pcUsername = username;
                var pcServerURL = serverurl; 
                pcGetUserDetails();
                pcInitUserEnvironmentalImpactWidget('widgetEnvironment');
                pcInitUserBalanceWidget('widgetBalance');
            } else {
                count++;
                if (count === 10) {
                    console.log('Papercut server could not be reached.');
                }
            }
        }, 1000);
    }
}
