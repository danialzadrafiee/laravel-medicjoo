<style>
    .js-item:last-child {
        border-bottom: none;
    }

    .object-mice {
        width: 10rem;
        height: 10rem;
    }

    .mice-border-1 {
        border-radius: 100%;
        height: 9rem;
        width: 9rem;
        background: linear-gradient(180deg, #4C1D95 0%, #381A67 100%);
        opacity: 0.62;
        right: 0;
        left: 0;
        top: 1rem;
        bottom: 0;
        position: absolute;
        margin: auto;
        z-index: 48;
        margin-top: -0.5rem;
    }

    .mice-border-2 {
        border-radius: 100%;
        height: 10.5rem;
        width: 10.5rem;
        background: linear-gradient(180deg, #4C1D95 0%, #381A67 100%);
        opacity: 0.48;
        right: -0.25rem;
        left: 0;
        top: 0.75rem;
        bottom: 0;
        position: absolute;
        margin: auto;
        z-index: 48;
        margin-top: -1rem;
    }

    .css-mice {
        height: 8rem;
        width: 8rem;
        background: linear-gradient(180deg, #4C1D95 0%, #281349 100%);
        right: 0;
        left: 0;
        top: 0;
        down: 0;
        margin: auto;
        z-index: 50;
    }

</style>
{{-- stuffs --}}
<input type="hidden" class='js-stuff-names' value="{{ json_encode($stuffs_names, JSON_UNESCAPED_UNICODE) }}">
{{-- background-blur --}}
<div class="js-blur hidden fixed h-screen filter opacity-50 bg-black w-screen top-0 right-0 z-10"></div>
{{-- BEGIN normal-popup --}}
<section class="js-popup popup fixed z-20  px-8 bg-white shadow-md w-full bottom-0 right-0 rounded-t-3xl"
    style="display: none">
    <div class="header">
        <div class="flex justify-between pt-5">
            <div class="title font-bold">ثبت سریع سفارش</div>
            <button class="btn-xs js-order-hide btn-outline btn btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="text text-gray-500 pt-2 text-sm">
            سفارش خود را ثبت کنید تا مناسب ترین پیشنهاد فروشندگان را
            برای شما جستجو کنیم . همچنین می توانید سفارش مورد نظر
            خود را از
            <a class="font-bold" href="{{ route('client_catalog', 'همه') }}">
                کاتالوگ
            </a>
            انتخاب کنید
        </div>
    </div>
    <div class="form">
        <form action="{{ route('client_order_store') }}" class="js-fast-order" method="post">
            @csrf
            <div class="inputs">
                <div class=" relative mt-3">
                    <div
                        class="js-autofill  bg-white rounded absolute z-50  h-max w-full  top-16 border p-2 px-4 border-gray-200">
                    </div>
                    <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> نام کالا</label>
                    <input autocomplete="nope" name="name" id="myInput" type="text"
                        class="js-input-name  z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                        placeholder="مثلا : کامپوزیت ">
                </div>
            </div>
            <div class="inputs">
                <div class=" relative mt-3">
                    <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> برند (غیر
                        ضروری)</label>
                    <input name="brand" type="text" class=" z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                        placeholder="مثلا : اولترادنت">
                </div>
            </div>
            <div class="grid gap-3 grid-cols-2">
                <div class="col-span-1">
                    <div class="inputs">
                        <div class=" relative mt-3">
                            <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">تعداد
                            </label>
                            <input data-rule="required|integer" name="count" type="number"
                                class=" text-center z-10 border h-12 border-gray-300 rounded py-3 my-2 w-full"
                                placeholder="مثلا : ۱۵">
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="inputs">
                        <div class=" relative mt-3">
                            <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">
                                واحد
                            </label>
                            <select name="unit" id=""
                                class="bg-white text-center h-12 z-10 border border-gray-300 rounded py-3 my-2 w-full">
                                <option value="عدد">عدد</option>
                                <option value="جعبه">جعبه</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons mt-2 pb-2">
                <div class="grid grid-cols-6 justify-between">
                    <div style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);"
                        class="col-span-1 w-12 h-12  voice bg-purple-900 text-white rounded-3xl mx-1 js-mice-show py-2 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mt-0.5 cursor-pointer  " width="19.456"
                            height="28.299" viewBox="0 0 19.456 28.299">
                            <path id="Icon_awesome-microphone" data-name="Icon awesome-microphone"
                                d="M9.728,19.456a5.306,5.306,0,0,0,5.306-5.306V5.306a5.306,5.306,0,0,0-10.612,0v8.843A5.306,5.306,0,0,0,9.728,19.456Zm8.843-8.843h-.884a.884.884,0,0,0-.884.884v2.653a7.083,7.083,0,0,1-7.782,7.04,7.29,7.29,0,0,1-6.368-7.356V11.5a.884.884,0,0,0-.884-.884H.884A.884.884,0,0,0,0,11.5v2.22A10.032,10.032,0,0,0,8.4,23.758v1.888h-3.1a.884.884,0,0,0-.884.884v.884a.884.884,0,0,0,.884.884h8.843a.884.884,0,0,0,.884-.884V26.53a.884.884,0,0,0-.884-.884h-3.1V23.779a9.737,9.737,0,0,0,8.4-9.63V11.5A.884.884,0,0,0,18.571,10.612Z"
                                fill="#fff" />
                        </svg>
                    </div>
                    <button style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);" type="submit"
                        class=" js-fast-order-submit  col-span-5 mr-1 submit bg-purple-900 text-white rounded-lg py-2 text-center">ثبت
                        سفارش</button>
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" class='js-stuff-names' value="{{ json_encode($stuffs_names, JSON_UNESCAPED_UNICODE) }}">
</section>
{{-- END normal-popup --}}
{{-- BEGIN MICE-popup --}}
<section class="js-miceup fixed  z-20 px-8 bg-white shadow-md w-full bottom-0 right-0 rounded-t-3xl"
    style="display:none">
    <div class="header">
        <div class="flex justify-between pt-5">
            <div class="title font-bold"> سفارش هوشمند</div>
            <button class="btn-xs js-miceup-close btn-outline btn btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="text text-gray-500 pt-2 text-sm">
            دکمه میکروفون را لمس کرده و سفارش خود را بیان کنید.
            درصورت صحت سفارش آن را ثبت کنید.
        </div>
    </div>
    <div class="object-mice mt-10 mx-auto pt-4 flex justify-start items-center block relative">
        <div class="mice-border-2 animate__animated  animate__slow  animate__pulse  animate__infinite   ">
        </div>
        <div class="mice-border-1 animate__animated  animate__pulse   animate__infinite ">
        </div>
        <div
            class="js-mice-btn absolute rounded-full bg-green-500 text-center text-4xl mx-auto text-white cursor-pointer mt-4 flex justify-center items-center css-mice ">
            <svg width="41" height="59" viewBox="0 0 41 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.2465 45.3357V56.7398Z" fill="url(#paint0_linear_104_3)" />
                <path
                    d="M11.1232 56.7398H29.3697M38.493 22.5276V27.0893C38.493 37.1248 30.282 45.3357 20.2465 45.3357M20.2465 45.3357C10.2109 45.3357 2 37.1248 2 27.0893V22.5276M20.2465 45.3357V56.7398"
                    stroke="white" stroke-width="3.98816" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M16.7481 2.68227C17.8577 2.22592 19.0468 1.99407 20.2466 2.00012C25.3784 2.00012 29.3698 5.99153 29.3698 11.1234V26.9465C29.3698 32.0783 25.2359 36.2123 20.2466 36.2123C15.2573 36.2123 11.1233 31.9642 11.1233 26.9465V11.1234C11.1173 9.92358 11.3492 8.73451 11.8055 7.6249C12.2618 6.51529 12.9336 5.50715 13.782 4.65877C14.6304 3.8104 15.6385 3.13861 16.7481 2.68227Z"
                    stroke="white" stroke-width="3.98816" stroke-linecap="round" stroke-linejoin="round" />
                <defs>
                    <linearGradient id="paint0_linear_104_3" x1="20.2465" y1="22.5276" x2="20.2465" y2="56.7398"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4C1D95" />
                        <stop offset="1" stop-color="#381A67" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
    <div class="js-text-generated text-center text-gray-600 my-2 ">دکمه میکروفون را لمس کنید </div>
    <form action="{{ route('client_order_store') }}" class="js-mice-form" method="post">
        @csrf
        <div class="inputs">
            <div class=" relative mt-3">
                <div name="name"
                    class="js-autofill  bg-white rounded absolute z-30  h-max w-full  top-16 border p-2 px-4 border-gray-200">
                </div>
                <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute"> دستور سفارش </label>
                <input autocomplete="nope" name="name" id="myInput" type="text"
                    class="js-input-voice-rec  z-10 border border-gray-300 rounded py-3 my-2 w-full pr-6"
                    placeholder="مثلا :  قلم دایکال دناپویا ">
            </div>
        </div>


        <div class="grid gap-3 grid-cols-2">
            <div class="col-span-1">
                <div class="inputs">
                    <div class=" relative mt-3">
                        <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">تعداد
                        </label>
                        <input data-rule="required|integer" name="count" type="number"
                            class=" text-center z-10 border h-12 border-gray-300 rounded py-3 my-2 w-full"
                            placeholder="مثلا : ۱۵">
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="inputs">
                    <div class=" relative mt-3">
                        <label class="-top-1 bg-white font-bold px-2 text-sm right-4 absolute text-center">
                            واحد
                        </label>
                        <select name="unit" id=""
                            class="bg-white text-center h-12 z-10 border border-gray-300 rounded py-3 my-2 w-full">
                            <option value="عدد">عدد</option>
                            <option value="جعبه">جعبه</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="buttons mt-2 pb-2">
            <div class="grid grid-cols-6 justify-between">
                <div style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);"
                    class="js-miceup-close col-span-1 flex justify-center items-center w-12 h-12 voice bg-purple-900 text-white rounded-3xl mx-1 py-2 text-center">
                    <svg width="22" height="28" viewBox="0 0 22 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21.0411 11.9955V23.6549C21.0411 24.417 20.7384 25.1479 20.1994 25.6868C19.6605 26.2258 18.9296 26.5285 18.1675 26.5285H4.75697C3.99483 26.5285 3.2639 26.2258 2.72498 25.6868C2.18606 25.1479 1.8833 24.417 1.8833 23.6549V4.49703C1.8833 3.73488 2.18606 3.00395 2.72498 2.46503C3.2639 1.92611 3.99483 1.62335 4.75697 1.62335H10.669C11.1769 1.62343 11.664 1.8252 12.0232 2.18432L20.4802 10.6413C20.8393 11.0005 21.041 11.4876 21.0411 11.9955Z"
                            stroke="white" stroke-width="1.91578" stroke-linejoin="round" />
                        <path
                            d="M6.67276 20.7812H16.2517M11.4622 2.10229V9.28648C11.4622 9.79458 11.6641 10.2819 12.0233 10.6411C12.3826 11.0004 12.8699 11.2023 13.378 11.2023H20.5622L11.4622 2.10229ZM6.67276 15.9917H16.2517H6.67276Z"
                            stroke="white" stroke-width="1.91578" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <button type="submit" style="background: linear-gradient(180deg, #4419B9 0%, #340D9D 100%);"
                    type="submit"
                    class="col-span-5 mr-1 submit bg-purple-900 text-white rounded-lg py-2 text-center">ثبت
                    سفارش</button>
            </div>
        </div>
    </form>
</section>
{{-- END MICE-popup --}}
{{-- BEGIN Buttons-Section --}}
<section class="buttons pb-4 fixed bottom-0 z-10 w-full px-4 ">
    <div class="shadow-md bg-white    pt-4 pb-3 rounded-xl flex justify-between gap-4 px-4">
        <div
            class=" js-fast-show btn btn-primary text-center bg-purple-800 w-full  text-lg block flex items-center justify-center">
            <div class="icon">
                <ion-icon name="speedometer"></ion-icon>
            </div>
            <div class="text mr-2">سفارش سریع</div>
        </div>
    </div>
    <div class="shadow-md bg-white hidden   pt-4 pb-3 rounded-xl flex justify-between gap-4 px-4">
        <div class="item js-fast-show">
            <div class="icon flex justify-center ">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="51"
                    height="50" viewBox="0 0 51 50">
                    <defs>
                        <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#ed0089" />
                            <stop offset="1" stop-color="#770045" />
                        </linearGradient>
                    </defs>
                    <g id="Group_63" data-name="Group 63" transform="translate(-313 -787)">
                        <rect id="Rectangle_23" data-name="Rectangle 23" width="51" height="50" rx="12"
                            transform="translate(313 787)" fill="url(#linear-gradient)" />
                        <path id="Icon_open-pencil" data-name="Icon open-pencil"
                            d="M19.39,0,16.158,3.232l6.463,6.463,3.232-3.232ZM12.927,6.463,0,19.39v6.463H6.463L19.39,12.927Z"
                            transform="translate(327.073 799.073)" fill="#fff" />
                    </g>
                </svg>
            </div>
            <div class="text mt-1 text-center text-xs">سفارش سریع</div>
        </div>
        <div class="item">
            <div class="icon flex justify-center ">
                <svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M39 0H12C5.37258 0 0 5.37258 0 12V38C0 44.6274 5.37258 50 12 50H39C45.6274 50 51 44.6274 51 38V12C51 5.37258 45.6274 0 39 0Z"
                        fill="url(#paint0_linear_134_36)" />
                    <path
                        d="M13 14.168V35.832C13.0003 36.4069 13.2288 36.9582 13.6353 37.3647C14.0418 37.7712 14.5931 37.9997 15.168 38H36.832C37.4069 37.9997 37.9582 37.7712 38.3647 37.3647C38.7712 36.9582 38.9997 36.4069 39 35.832V14.168C38.9997 13.5931 38.7712 13.0418 38.3647 12.6353C37.9582 12.2288 37.4069 12.0003 36.832 12H15.168C14.8832 11.9996 14.6011 12.0554 14.3379 12.1642C14.0747 12.273 13.8355 12.4327 13.6341 12.6341C13.4327 12.8355 13.273 13.0747 13.1642 13.3379C13.0554 13.6011 12.9996 13.8832 13 14.168ZM18.58 32.732C18.3215 32.7659 18.0589 32.718 17.829 32.5951C17.5991 32.4721 17.4135 32.2802 17.2982 32.0464C17.1829 31.8125 17.1438 31.5484 17.1863 31.2912C17.2288 31.034 17.3508 30.7965 17.5351 30.6121C17.7195 30.4278 17.957 30.3058 18.2142 30.2633C18.4714 30.2208 18.7355 30.2599 18.9694 30.3752C19.2032 30.4905 19.3951 30.6761 19.5181 30.906C19.641 31.1359 19.6889 31.3985 19.655 31.657C19.6201 31.93 19.4956 32.1837 19.3011 32.3784C19.1066 32.5731 18.853 32.6978 18.58 32.733V32.732ZM18.58 26.232C18.3215 26.2659 18.0589 26.218 17.829 26.0951C17.5991 25.9721 17.4135 25.7802 17.2982 25.5464C17.1829 25.3125 17.1438 25.0484 17.1863 24.7912C17.2288 24.534 17.3508 24.2965 17.5351 24.1121C17.7195 23.9278 17.957 23.8058 18.2142 23.7633C18.4714 23.7208 18.7355 23.7599 18.9694 23.8752C19.2032 23.9905 19.3951 24.1761 19.5181 24.406C19.641 24.6359 19.6889 24.8985 19.655 25.157C19.6203 25.4302 19.4959 25.6841 19.3014 25.879C19.1068 26.0739 18.8531 26.1988 18.58 26.234V26.232ZM18.58 19.732C18.3215 19.7659 18.0589 19.718 17.829 19.5951C17.5991 19.4721 17.4135 19.2802 17.2982 19.0464C17.1829 18.8125 17.1438 18.5484 17.1863 18.2912C17.2288 18.034 17.3508 17.7965 17.5351 17.6121C17.7195 17.4278 17.957 17.3058 18.2142 17.2633C18.4714 17.2208 18.7355 17.2599 18.9694 17.3752C19.2032 17.4905 19.3951 17.6761 19.5181 17.906C19.641 18.1359 19.6889 18.3985 19.655 18.657C19.6207 18.9305 19.4965 19.185 19.3019 19.3803C19.1074 19.5756 18.8534 19.7007 18.58 19.736V19.732ZM34.039 32.37H22.791C22.5591 32.3695 22.3368 32.2771 22.1729 32.1131C22.0089 31.9492 21.9165 31.7269 21.916 31.495V31.495C21.9178 31.264 22.0108 31.043 22.1746 30.8801C22.3385 30.7172 22.56 30.6255 22.791 30.625H34.039C34.2709 30.6255 34.4932 30.7179 34.6571 30.8819C34.8211 31.0458 34.9135 31.2681 34.914 31.5V31.5C34.9122 31.731 34.8192 31.952 34.6554 32.1149C34.4915 32.2778 34.27 32.3695 34.039 32.37V32.37ZM34.039 25.87H22.791C22.5591 25.8695 22.3368 25.7771 22.1729 25.6131C22.0089 25.4492 21.9165 25.2269 21.916 24.995V24.995C21.9165 24.7631 22.0089 24.5408 22.1729 24.3769C22.3368 24.2129 22.5591 24.1205 22.791 24.12H34.039C34.2709 24.1205 34.4932 24.2129 34.6571 24.3769C34.8211 24.5408 34.9135 24.7631 34.914 24.995V24.995C34.914 25.2273 34.8219 25.45 34.6578 25.6144C34.4938 25.7788 34.2712 25.8715 34.039 25.872V25.87ZM34.039 19.37H22.791C22.5591 19.3695 22.3368 19.2771 22.1729 19.1131C22.0089 18.9492 21.9165 18.7269 21.916 18.495V18.495C21.9178 18.264 22.0108 18.043 22.1746 17.8801C22.3385 17.7172 22.56 17.6255 22.791 17.625H34.039C34.2709 17.6255 34.4932 17.7179 34.6571 17.8819C34.8211 18.0458 34.9135 18.2681 34.914 18.5V18.5C34.9129 18.7316 34.8204 18.9533 34.6564 19.1168C34.4925 19.2804 34.2706 19.3725 34.039 19.373V19.37Z"
                        fill="white" />
                    <defs>
                        <linearGradient id="paint0_linear_134_36" x1="25.5" y1="0" x2="25.5" y2="50"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#11BC57" />
                            <stop offset="1" stop-color="#095E2C" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div class="text mt-1 text-center text-xs">سفارش ها</div>
        </div>
        <div class="item">
            <div class="icon flex justify-center ">
                <svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M39 0H12C5.37258 0 0 5.37258 0 12V38C0 44.6274 5.37258 50 12 50H39C45.6274 50 51 44.6274 51 38V12C51 5.37258 45.6274 0 39 0Z"
                        fill="url(#paint0_linear_134_35)" />
                    <path
                        d="M31.1583 11.1817C29.8485 9.77477 28.0192 9 26 9C23.9701 9 22.1346 9.77008 20.8309 11.1683C19.5131 12.5819 18.871 14.5031 19.0217 16.5776C19.3206 20.6705 22.451 23.9999 26 23.9999C29.549 23.9999 32.674 20.6711 32.9776 16.579C33.1304 14.5232 32.4842 12.606 31.1583 11.1817V11.1817ZM37.8458 38.9998H14.1542C13.8441 39.0038 13.537 38.939 13.2552 38.8101C12.9735 38.6812 12.7241 38.4914 12.5254 38.2545C12.0879 37.7342 11.9115 37.0237 12.0421 36.3052C12.6102 33.1699 14.383 30.5363 17.1695 28.6874C19.645 27.0461 22.7808 26.1428 26 26.1428C29.2192 26.1428 32.355 27.0468 34.8305 28.6874C37.617 30.5356 39.3898 33.1693 39.9579 36.3045C40.0885 37.0231 39.9121 37.7335 39.4746 38.2538C39.2759 38.4908 39.0266 38.6807 38.7449 38.8098C38.4631 38.9388 38.156 39.0038 37.8458 38.9998V38.9998Z"
                        fill="white" />
                    <defs>
                        <linearGradient id="paint0_linear_134_35" x1="25.5" y1="0" x2="25.5" y2="50"
                            gradientUnits="userSpaceOnUse">
                            <stop stop-color="#3371FF" />
                            <stop offset="1" stop-color="#0033FF" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div class="text mt-1 text-center text-xs">پروفایل کاربری</div>
        </div>
    </div>
</section>
{{-- END Buttons-Section --}}
