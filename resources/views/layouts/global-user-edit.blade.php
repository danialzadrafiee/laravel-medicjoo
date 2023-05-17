<div class="px-4 my-8">
    @include('layouts.global-error')
    @include('layouts.global-msg')
    <div class="py-2 mt-3 rounded-t bg-purple-800 text-center w-full text-white">ویرایش اطلاعات کاربری</div>
    <form action="{{ route('user_update') }}">
        <div class="grid gap-y-4 pb-6 text-sm rounded rounded-t-none bg-white shadow px-4 grid-cols-4">
            {{--  --}}
            <div class="col-span-4">
                <div class="divider">اطلاعات شخصی</div>
            </div>
            {{--  --}}
            <div class="col-span-1 flex items-center">نام کاربری</div>
            <div class="col-span-3"><input type="text" placeholder="نام" name="name"
                    class="input input-sm input-bordered "></div>
            {{--  --}}
            <div class="col-span-1 flex items-center">شماره تماس</div>
            <div class="col-span-3"><input type="text" placeholder="شماره تماس" name="phone"
                    class="input input-sm input-bordered "></div>
            {{--  --}}
            <div class="col-span-4">
                <div class="divider">رمز عبور جدید</div>
            </div>
            {{--  --}}
            <div class="col-span-1 flex items-center">رمز عبور</div>
            <div class="col-span-3"><input type="password" placeholder="********" name="password"
                    class="input input-sm input-bordered "></div>
            {{--  --}}
            <div class="col-span-1 flex items-center">تکرار رمز عبور</div>
            <div class="col-span-3"><input type="password" placeholder="********" name="password_confirmation"
                    class="input input-sm input-bordered"></div>
            {{--  --}}
            <div class="col-span-4 mt-2">
                <button type="submit" class="btn btn-block btn-primary bg-purple-800">اعمال تغییرات</button>
            </div>
        </div>
    </form>
</div>
