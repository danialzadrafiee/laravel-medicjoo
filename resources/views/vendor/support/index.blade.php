<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <style>
        #raychatFrame {
            border: 0px !important;
            display: block !important;
            height: 100vh !important;
            width: 100vw !important;
            /* height: 844px !important;
            width: 390px !important; */
            padding: 0 !important;
            margin: auto !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            max-height: 100vh !important;
            border-radius: 0px !important;
        }

    </style>


    <!--BEGIN RAYCHAT CODE-->
    <script type="text/javascript">
        ! function() {
            function t() {
                var t = document.createElement("script");
                t.type = "text/javascript", t.async = !0, localStorage.getItem("rayToken") ? t.src =
                    "https://app.raychat.io/scripts/js/" + o + "?rid=" + localStorage.getItem("rayToken") + "&href=" +
                    window.location.href : t.src = "https://app.raychat.io/scripts/js/" + o + "?href=" + window.location
                    .href;
                var e = document.getElementsByTagName("script")[0];
                e.parentNode.insertBefore(t, e)
            }
            var e = document,
                a = window,
                o = "e3c6b1ca-df38-4733-af4a-0f51ce081bde";
            "complete" == e.readyState ? t() : a.attachEvent ? a.attachEvent("onload", t) : a.addEventListener("load", t, !
                1)
        }();
    </script>
    <!--END RAYCHAT CODE-->



    <script>
        window.addEventListener('raychat_ready', function(ets) {
            window.Raychat.open();
        });
    </script>

</body>

</html>
