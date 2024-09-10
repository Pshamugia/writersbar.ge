@extends('admin/layout')
@extends('admin/menu')

@section('menu')

<div class="container">


    @if ($count1 + $count2>0)

    <div style="padding:10px; height: 55px">
    We have {{ $count1 + $count2}}
    @if ($count1 + $count2==1)

    result @if(@$_GET['text']) for @endif <b> <u> {{ @$_GET['text']  }} </u></b>

    @else
    results @if(@$_GET['text']) for @endif <b> <u> {{ @$_GET['text']  }} </u></b>


    @endif

    </div>
@else
<div style="padding:10px; height: 55px">

{{ "Hmmmm, we could not find any matches for"}} <span style="background-color: red !important, color:white"> <b><u> {{ @$_GET['text']  }} </u></b> </span>
<br><br>

{{ "Double check your search for any typos or spelling errors -
or try a different search term." }}

</div>
@endif

    <table class="table table-hover">
        <thead>
          <tr>
             <th scope="col" style="border-top:0px !important; border-bottom:0px !important;"> </th>
            <th scope="col" style="border-top:0px !important; border-bottom:0px !important;"> </th>
           </tr>
        </thead>
        <tbody>

            @if(isset($search) && !empty($search))
            @foreach ($search as $events )


          <tr onclick="window.location='{{ route('admin.articles.edit', ['id'=>$events->id, 'title_ka'=>Str::slug($events->title_ka)]) }}'" style="cursor: pointer">
             <td><a href="{{ route('admin.articles.edit', ['id'=>$events->id, 'title_ka'=>Str::slug($events->title())]) }}">
                 {{ $events->title_ka }}
                </a>
                <br>
                {{ Carbon\Carbon::parse($events->year)->format('M d, Y ').'Year' }}

<br>
                {{ @$events->category->name() }}

                </td>

            <td align="right">
         <img src="{{ asset($events->upload) }}" id="im" class="cover">  </td>
          </tr>

    @endforeach
    @endif


    @if(isset($search_gallery) && !empty($search_gallery))
    @foreach ($search_gallery as $events )


  <tr onclick="window.location='{{ route('admin.gallery.photo.edit', ['id'=>$events->id, 'title'=>Str::slug($events->title)]) }}'" style="cursor: pointer">
     <td><a href="{{ route('admin.gallery.photo.edit', ['id'=>$events->id, 'title'=>Str::slug($events->title)]) }}">
         {{ $events->title }}
        </a>
        <br>
        {{ Carbon\Carbon::parse($events->year)->format('M d, Y ').'Year' }}
        <br>

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



        </tbody>
      </table>



</div>



@endsection
