

<style>
    @font-face {
        font-family: 'CustomFont' !important;
        src: url('fonts/bpg_boxo-boxo.ttf');
    }
    </style>
  <li id="menu-top" class="nav-item dropdown" style="font-family: 'CustomFont' !important;
  src: url('/public/fonts/bpg_boxo-boxo.ttf'); color:white !important">

    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if(app()->isLocale('ka'))
        {{ $item['name_ka'] }}
        @else
        {{ $item['name_en'] }}

    @endif
</a>
    <ul id="menu-top">
        @foreach($item['children'] as $item)
        @if(count($item['children']) > 0)
        @include('menu/multiitem', ['item' => $item])
        @else
        @include('menu/singleitem', ['single' => $item])
        @endif
        @endforeach
    </ul>
</li>


