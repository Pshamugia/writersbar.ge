@extends('layout')
@section('menu')

<div class="container">
     <table class="table table-hover">
        <thead>
          <tr>
             <th scope="col"> </th>
            <th scope="col"> </th>
           </tr>
        </thead>
        <tbody>



            @if(!empty($authors->author_ka))

<div style="margin-top: 33px;">
    <i class="fa fa-user" aria-hidden="true"></i>
     <span style="font-size: 18px"> <strong> {{ @$full->authors->author_name() }} </strong> </span>
</div>

@endif

            @foreach ($event as $events)

@if(app()->isLocale('en') && empty($events->title_en ))
<div class="alert alert-secondary" role="alert">
{{ "No articles yet"}}
</div>
@elseif(app()->isLocale('ka') && empty($events->title_ka ))
<div class="alert alert-secondary" role="alert">
{{ "ამ განყოფილებაში მასალები ჯერ არაა"}}
</div>
@else


          <tr onclick="window.location='{{ route('full', ['id'=>$events->id, 'title_ka' => Str::slug($full->title())]) }}'" style="cursor: pointer">
             <td> <a href="{{ route('full', ['id'=>$events->id, 'title_ka'=>Str::slug($full->title())]) }}">
                 {{ @$events->title() }}
                </a>
                <br>
                @if (app()->isLocale('ka'))
                <?php setlocale(LC_TIME, 'ka_GE.utf8'); ?>
                {{ Carbon\Carbon::parse($events->year)->formatLocalized('%A, %d %B, %Y') }}

                @else

                <?php setlocale(LC_ALL, 'US'); ?>

                {{ Carbon\Carbon::parse($events->year)->formatLocalized('%A, %d %B, %Y') }}
                @endif                </td>

            <td align="right">
         <img src="{{ asset($full->upload) }}" id="im" class="cover">  </td>
          </tr>
@endif

    @endforeach


        </tbody>
      </table>



</div>



@endsection
