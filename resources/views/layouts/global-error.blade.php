@if ($errors->any())
    <div  class="js-autohide bg-red-300 rounded w-full py-3  top-10 px-4 mx-auto block right-0 left-0  shadow-lg">
        <div>
            <span class="grid grid-cols-10 block justify-between ">
                <div class="col-span-9 items-center  self-center">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-span-1 js-autohide-close">
                    <div class="js-autohide-close">
                        <ion-icon class="js-autohide-close" name="close-circle-outline" size="large"
                            style=" --ionicon-stroke-width: 12px;"></ion-icon>
                    </div>

                </div>

            </span>
        </div>
    </div>
@endif
