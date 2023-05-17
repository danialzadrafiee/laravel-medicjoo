<script>
    Pusher.logToConsole = true;
    var pusher = new Pusher('57fc50c734e330759f5f', {
        cluster: 'mt1'
    });
    var channel = pusher.subscribe('vendor-main2');

    channel.bind('order-created', function(data) {
        showNotification(JSON.stringify(data.message));
    });


    channel.bind('offer-selected', function(data) {
        showNotification(JSON.stringify(data.message));
    });

    //bad vendor
    channel.bind('order-find-offer', function(data) {
        showNotification(JSON.stringify(data.message));
    });
</script>
