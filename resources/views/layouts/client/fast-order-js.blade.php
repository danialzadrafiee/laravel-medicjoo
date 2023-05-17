<script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script src="{{ asset('src/fuzzysort.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

{{-- SCRIPT - FUZZYSERACH --}}
<script>
    var list = JSON.parse($('.js-stuff-names').val());
    var keyword = $('.js-input-name').val();
    var search_result = list;
    var search_result_targets = [];
    var field = '';
    $('.js-autofill').css('display', 'none');
    $(document).on('keyup keydown change', '.js-input-name', function() {
        keyword = $('.js-input-name').val();
        search_result = fuzzysort.go(keyword, list);
        search_result_targets = [''];
        $('.js-autofill').empty();
        search_result.forEach(element => {
            $('.js-autofill').append(
                `<div class="js-item bg-white text-gray-600 py-2 hover:bg-gray-100 border-b border-gray-100 r px-4 w-full">` +
                fuzzysort.highlight(fuzzysort.single(keyword, element.target),
                    "<span class='text-purple-800 font-bold'>", "</span>") + `</div>`)
        })
        if ($('.js-item').length > 0) {
            $('.js-autofill').css('display', 'block');
        } else {
            $('.js-autofill').css('display', 'none');
        }
    });
    //select fuzzy sort result
    $(document).on('click', '.js-item', function() {
        $('.js-input-name').val($(this).text());
        $('.js-autofill').css('display', 'none');
    })
</script>
{{-- SCRIPT - POPUPMANAGER --}}
<script>
    $('.js-order-hide').on('click', function() {
        $('.js-popup').slideUp('fast'); //close popup
        $('.js-blur').fadeOut('fast'); //close background
        $('html, body').css({
            overflow: 'auto',
            height: 'auto'
        }); // scroll enable

    });
    $('.js-mice-show').on('click', function() {
        $('.js-miceup').slideDown('fast') //open miceup
        WebSocketOn()
    });
    $('.js-miceup-close').on('click', function() {
        $('.js-miceup').slideUp('fast') //close miceup
        WebSocketClose()
    });
    $('.js-fast-show').on('click', function() {

        $('html, body').css({
            overflow: 'hidden',
            height: '100%'
        }); // scroll disable

        $('.js-popup').slideDown('fast'); //open popup
        $('.js-blur').fadeIn('fast'); //open background
    });
    $('.js-blur').on('click', function() {
        $('.js-miceup').slideUp('fast') //close miceup
        $('.js-popup').slideUp('fast'); //close popup

        $('html, body').css({
            overflow: 'auto',
            height: 'auto'
        }); // scroll enable

        $('.js-blur').fadeOut('fast'); //close background
    });
</script>
{{-- SCRIPT - MICE and WEBSOCKET --}}
<script type="text/javascript">
    var ws;
    var connectionStatus = 'disconnected';
    window.addEventListener("unload", function() {
        if (ws.readyState == 1)
            ws.close();
    });
    async function WebSocketOn() {
        ws = new WebSocket('wss://iotype.com:2700')
        connectionStatus = 'disconnected';
        const channel = new MessageChannel();
        ws.onopen = function(e) {
            var data = JSON.stringify({
                config: {
                    'authorization_type': 'flash',
                    'authorization_token': $('.token-client').val()
                }
            });
            console.log(data)
            ws.send(data)
            connectionStatus = 'connected';
            miceFlag = 'on'
            $('.mice-border-1').removeClass('hidden')
            $('.mice-border-2').removeClass('hidden')
            $('.css-mice').css('background', 'linear-gradient(180deg, #4C1D95 0%, #281349 100%)')
            $('.js-text-generated').text('درحال دریافت گفتار شما ... ');
        };
        ws.onerror = function(e) {
            console.log('wss-error');
            console.log(e);
        };
        ws.onclose = function(e) {
            if (e.wasClean) {
                console.log(`[close] Connection closed cleanly, code=${event.code} reason=${event.reason}`);
            } else {
                // e.g. server process killed or network down
                // event.code is usually 1006 in this case
                console.log('[close] Connection died');
            }
        };
        ws.onmessage = function(evt) {
            var received_msg = evt.data;
            if (received_msg === 'unauthozied') {
                return false;
            }
            received_msg = JSON.parse(received_msg);
            if (received_msg['partial'] != '' && received_msg['partial'] != undefined) {
                $('.js-text-generated').html(received_msg['partial']);
            }
            if (received_msg['text'] != '' && received_msg['text'] != undefined) {
                $('.js-input-voice-rec').val(received_msg['text']);
                $('.js-text-generated').text('درحال دریافت گفتار شما ... ');
            }
        };
        const mediaStream = await navigator.mediaDevices.getUserMedia({
            video: false,
            audio: {
                echoCancellation: true,
                noiseSuppression: true,
                channelCount: 1,
                sampleRate: 44100
            },
        });
        const audioContext = new AudioContext();
        await audioContext.audioWorklet.addModule('{{ asset('src/recognizer-processor-custom.js') }}')
        const recognizerProcessor = new AudioWorkletNode(audioContext, 'recognizer-processor-custom', {
            channelCount: 1,
            numberOfInputs: 1,
            numberOfOutputs: 1,
        });
        channel.port1.onmessage = event => {
            if (ws.readyState === WebSocket.OPEN) {
                ws.send(event.data.data)
            } else if (ws.readyState === WebSocket.CLOSED && connectionStatus === 'connected') {
                connectionStatus = 'disconnected';
                audioContext.close();
            }
        }
        recognizerProcessor.port.postMessage({
            action: 'init',
            recognizerId: 2143134,
        }, [channel.port2])
        recognizerProcessor.connect(audioContext.destination);
        const source = audioContext.createMediaStreamSource(mediaStream);
        source.connect(recognizerProcessor);
    }
    async function WebSocketClose() {
        if (connectionStatus == 'connected') {
            ws.close();
            miceFlag = 'off';
        }
        $('.mice-border-1').addClass('hidden')
        $('.mice-border-2').addClass('hidden')
        $('.css-mice').css('background', '#1a1a1a7d')
        $('.js-text-generated').text('دکمه میکروفون را لمس کنید');
    }
    $('.mice-border-1').addClass('hidden')
    $('.mice-border-2').addClass('hidden')
    $('.css-mice').css('background', '#1a1a1a7d')
    miceFlag = 'off';
    $(document).on('click', '.js-mice-btn', function() {
        switch (miceFlag) {
            case 'on':
                WebSocketClose()
                break;
            case 'off':
                WebSocketOn()
                break;
        }
    })
    $(window).on("unload", function(e) {
        WebSocketClose();
    });
</script>
