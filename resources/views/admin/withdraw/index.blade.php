@extends('layouts.admin.app')



@section('content')
    <div class="modal" id="withdraw_modal">
        <form action="{{ route('admin_withdraw_store') }}">
            <div class="form-control ">
                <div class="divider">فروشنده</div>
                <input type="hidden" name="user_id" class="js-user-id">
                <div class="flex items-center justify-between">
                    <div class="name">
                        <span>کاربر : </span>
                        <span class="js-user-name"></span>
                    </div>
                    <div class="name">
                        <span>موجودی : </span>
                        <input disabled class="js-user-balance bg-white ">
                    </div>
                </div>

                <div class="divider">تسویه حساب</div>


                <label class="label">
                    <span class="label-text">مبلغ تسویه</span>
                </label>
                <input type="text" name="amount" placeholder="مقدار تسویه به تومان"
                    class="js-numberic input input-bordered w-full ">

                <label class="label mt-2">
                    <span class="label-text">شرح تراکنش</span>
                </label>
                <textarea name="describe" class="textarea textarea-bordered" placeholder="متن توضیح"></textarea>
                <button class="btn btn-primary mt-4 bg-gray-800 ring-0 border-none w-full btn-sm">تسویه</button>
            </div>
        </form>
    </div>
    <table class="text-center">
        <thead>
            <th>#</th>
            <th>نام</th>
            <th>شماره</th>
            <th>فروش</th>
            <th>برداشت</th>
            <th>موجودی</th>
            <th>مبلغ آخرین برداشت </th>
            <th>تاریخ آخرین برداشت </th>
            <th>عملیات</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                    <td>
                        {{ number_format(App\Offer::where('vendor_id', $user->id)->sum('price')) }}
                    </td>
                    <td>
                        {{ number_format($user->withdraw()->sum('amount')) }}
                    </td>
                    <td>
                        {{ number_format(App\Offer::where('vendor_id', $user->id)->sum('price') - $user->withdraw()->sum('amount')) }}
                    </td>
                    <td>
                        {{ $user->withdraw()->exists()? number_format($user->withdraw()->latest()->first()->amount) ?? '-': '-' }}
                    </td>
                    <td>
                        {{ $user->withdraw()->exists()? verta($user->withdraw()->first()->updated_at)->format('H:i | Y/n/j ') ?? '-': '-' }}
                    </td>

                    <td>
                        <a user_id="{{ $user->id }}" user_name="{{ $user->name }}"
                            user_balance="{{ App\Offer::where('vendor_id', $user->id)->sum('price') - $user->withdraw()->sum('amount') }}"
                            href="#withdraw_modal" rel="modal:open" class="js-btn-withdraw btn btn-xs">تسویه جدید</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('table').DataTable({
                "info": false,
                "order": [
                    [1, "desc"]
                ],
                "dom": "ftp",

                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fa.json',
                },
            });
        });

        $('.js-btn-withdraw').on('click', function() {
            $('.js-user-id').val($(this).attr('user_id'))
            $('.js-user-name').text($(this).attr('user_name'))
            $('.js-user-balance').val(number_format($(this).attr('user_balance')))
        })



        function number_format(number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    </script>
@endsection
