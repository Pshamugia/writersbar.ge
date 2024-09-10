@extends('layout')
@section('menu')

<div class="container">

    @if ($count1 + $count2 + $count3>0)

    <div style="padding:10px; height: 55px">
    We have {{ $count1 + $count2+$count3}}
    @if ($count1 + $count2 + $count3==1)

    result for <b> <u> {{ $_GET['text']  }} </u></b>

    @else
    results for <b> <u> {{ $_GET['text']  }} </u></b>


    @endif

    </div>
@else
<div style="padding:10px; height: 55px">

{{ "Hmmmm, we could not find any matches for"}} <span style="background-color: red !important, color:white"> <b><u> {{ $_GET['text']  }} </u></b> </span>
<br><br>

{{ "Double check your search for any typos or spelling errors -
or try a different search term." }}

</div>
@endif
    <table class="table table-hover">
        <thead>
          <tr>
             <th scope="col"> </th>
            <th scope="col"> </th>
           </tr>
        </thead>
        <tbody>

            @if(isset($search) && !empty($search))
            @foreach ($search as $events )

@if(!empty($events->title()))
          <tr onclick="window.location='{{ route('full', ['id'=>$events->id, 'title_ka'=>Str::slug($events->title_ka)]) }}'" style="cursor: pointer">
             <td> <a href="{{ route('full', ['id'=>$events->id, 'title_ka'=>Str::slug($events->title_ka)]) }}">
                 {{ @$events->title() }}
                </a>
                <br>
                @if(app()->isLocale('ka'))

                {{ Carbon\Carbon::parse($events->year)->formatLocalized('%d %B %Y') }}
                 @else
                {{ Carbon\Carbon::parse($events->year)->format('d M Y') }}

                @endif
<br>


{{ $events->category->name() }}
                </td>

            <td align="right">
         <img src="{{ asset($events->upload) }}" id="im" class="cover">  </td>
          </tr>
@endif
    @endforeach
    @endif


    @if(isset($search_gallery) && !empty($search_gallery))
    @foreach ($search_gallery as $events )


  <tr onclick="window.location='{{ route('full_gallery', ['id'=>$events->id, 'title'=>Str::slug($events->title)]) }}'" style="cursor: pointer">
     <td> <a href="{{ route('full_gallery', ['id'=>$events->id, 'title'=>Str::slug($events->title)]) }}">
         {{ @$events->title }}
        </a>
        <br>
        @if(app()->isLocale('ka'))

        {{ Carbon\Carbon::parse($events->year)->formatLocalized('%d %B %Y') }}
         @else
        {{ Carbon\Carbon::parse($events->year)->format('d M Y') }}

        @endif        <br>

        {{ "Gallery"  }}
    </td>

    <td align="right">

        @if(isset($events->upload) && !empty($events->upload))
 <img src="{{ asset($events->upload) }}" id="im" class="cover">
@else

<img src="{{ asset('img/No_Image_Available.jpg') }}" id="im" class="cover">


 @endif
</td>
  </tr>

@endforeach
@endif



@if(isset($search_video) && !empty($search_video))
    @foreach ($search_video as $events )


  <tr onclick="window.location='{{ route('full_video', ['id'=>$events->id, 'title_ka'=>Str::slug($events->title_ka)]) }}'" style="cursor: pointer">
     <td> <a href="{{ route('full_video', ['id'=>$events->id, 'title_ka'=>Str::slug($events->title_ka)]) }}">
         {{ @$events->title_ka }}
        </a>
        <br>
        @if(app()->isLocale('ka'))

        {{ Carbon\Carbon::parse($events->year)->formatLocalized('%d %B %Y') }}
         @else
        {{ Carbon\Carbon::parse($events->year)->format('d M Y') }}

        @endif        <br>

        {{ "Video Gallery"  }}
    </td>

    <td align="right">

        @if(isset($events->upload) && !empty($events->upload))
 <img src="{{ asset($events->upload) }}" id="im" class="cover">
@else

<img src="{{ asset('img/No_Image_Available.jpg') }}" id="im" class="cover">


 @endif
</td>
  </tr>

@endforeach
@endif



        </tbody>
      </table>



</div>



@endsection
