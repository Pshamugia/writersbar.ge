
@php
    $activeCategoryId = request()->route('id');
@endphp
<style>
@font-face {
    font-family: 'CustomFont';
    src: url('fonts/bpg_boxo-boxo.ttf');
}
</style>
<li class="@if($activeCategoryId == $item['id']) active @endif">
    <a class="category-link"
        @if ($item['name_ka'] =='ფოტო') href="{{ route('gallery', [$item['id']]) }}"
        @elseif($item['name_en'] =='Quizz') href="{{ route('events_quizz', [$item['id']]) }}"
        @elseif($item['name_en'] =='Video') href="{{ route('video', [$item['id']]) }}"
        @else href="{{ route('events', [$item['id']]) }}"  @endif() role="button" aria-haspopup="true" aria-expanded="false"
        style="font-family: 'CustomFont', sans-serif;"> <!-- Apply the custom font -->
        @if(app()->isLocale('ka'))
        {{ $item['name_ka'] }}
        @else
        {{ $item['name_en'] }}
        @endif
    </a>
</li>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            // Add click event listener to category links
                            $('.category-link').click(function (event) {
                                event.preventDefault();

                                // Remove 'active-category' class from all category links
                                $('.category-link').removeClass('active-category');

                                // Add 'active-category' class to the clicked category link
                                $(this).addClass('active-category');

                                // Navigate to the specified route
                                window.location.href = $(this).attr('href');
                            });
                        });
                    </script>
