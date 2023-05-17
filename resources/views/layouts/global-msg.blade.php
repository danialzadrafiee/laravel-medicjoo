@if (\Session::has('msg'))
    <div class="js-autohide bg-green-300 rounded w-full py-3  top-10 px-4 mx-auto block right-0 left-0  shadow-lg">
        <div>
            <span class="flex items-center block justify-between ">
                <div class="right">
                    <ul>
                        {!! \Session::get('msg') !!}
                    </ul>
                </div>

                <div class="js-autohide-close left flex self-center items-center h-full">
                    <ion-icon class="js-autohide-close" name="close-circle-outline" size="large"
                        style=" --ionicon-stroke-width: 12px;"></ion-icon>
                </div>

            </span>
        </div>
    </div>
@endif
