<script src="https://cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script src="{{ asset('src/fuzzysort.js') }}"></script>
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
    $(document).on('click', '.js-item', function() {
        var url = "{{ route('vendor_catalog_search') }}" + "?keyword=" + $(this).text()
        window.location.href = url;
    })
</script>

<script>
    $('.js-input-name').on('click', function() {
        console.log('done');
        $('.main-header').slideUp('fast');
        $('.empty').slideUp('fast');
        $('.js-close-search').css("display", "flex")
        $('.js-close-search').fadeIn('fast')
        $('.js-search-popup').slideDown('fast');
    })
    $('.js-close-search').on('click', function() {
        $('.main-header').slideDown('fast');
        $('.empty').css("display", "block")
        $('.js-close-search').css("display", "none")
        $('.js-close-search').fadeOut('fast')
        $('.js-search-popup').slideUp('fast');

    })
</script>
