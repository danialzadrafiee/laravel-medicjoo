<script>
    // Pusher.logToConsole = true;
    var pusher = new Pusher('57fc50c734e330759f5f', {
        cluster: 'mt1'
    });
    var channel = pusher.subscribe('client-main');
    channel.bind('order-find-offer', function(data) {
        showNotification(JSON.stringify(data.message));
    });

    //bad-client
    channel.bind('order-created', function(data) {
        showNotification(JSON.stringify(data.message));
    });

    channel.bind('offer-selected', function(data) {
        showNotification(JSON.stringify(data.message));
    });
</script>
