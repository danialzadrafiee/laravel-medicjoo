<script src="{{ asset('js/pusher.min.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js'></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css' />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js'></script>
<link rel="stylesheet" href="{{ asset('src/app.css') }}">
<link rel="stylesheet" href="{{ asset('src/tailwind.min.css') }}">
<script src="{{ asset('src/app.js') }}"></script>
<script>
    //load serviceworker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('{{ asset('dante_serviceworker1.js') }}').then(function(registration) {
                console.log('Service worker registration succeeded:', registration);
            },
            function(error) {
                console.log('Service worker registration failed:', error);
            });
    } else {
        console.log('Service workers are not supported.');
    }

    //show notification
    let promise = Notification.requestPermission();

    function showNotification(message) {
        try {
            new Notification(message);
        } catch (e) {
            Notification.requestPermission(function(result) {
                if (result === 'granted') {
                    navigator.serviceWorker.ready.then(function(registration) {
                        registration.showNotification('Vibration Sample', {
                            body: message,
                            icon: '../images/touch/chrome-touch-icon-192x192.png',
                            vibrate: [200, 100, 200, 100, 200, 100, 200],
                            tag: 'vibration-sample'
                        });
                    });
                }
            });
        }
    }

    //a2hs loading
    let installPromptEvent;
    window.addEventListener('beforeinstallprompt', event => {
        event.preventDefault();
        installPromptEvent = event;
        $('.js-web-app-sec').slideDown('fast');

    });

    function runa2hs() {
        installPromptEvent.prompt();
        installPromptEvent.userChoice.then(choice => {
            if (choice.outcome === 'accepted') {
                console.log('User accepted the A2HS prompt');
            } else {
                console.log('User dismissed the A2HS prompt');
            }
            installPromptEvent = null;
        });
    }
</script>
<script>
    // autonumber
    if ($('.js-numberic').length) {
        new AutoNumeric('.js-numberic', {
            decimalPlaces: 0,
            digitGroupSeparator: ',',
            unformatOnSubmit: true,
            currencySymbol: ' تومان ',
            currencySymbolPlacement: 's',
        });
    }
</script>
<script>
    $('body').on('click', '.js-autohide-close', function() {
        $(this).closest(".js-autohide").css('display', 'none');
    })
</script>
{{-- <script>
    //foce clear cache users
    console.log(caches.keys().then(function(names) {
        for (let name of names)
            caches.delete(name);
    }))
</script> --}}
