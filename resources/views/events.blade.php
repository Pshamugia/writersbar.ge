@extends('layout')
@section('menu')
<style>
    #header.header-transparent {
        background: rgba(42, 44, 57, 0.9);
    }

    .cta {
        margin-top: -60px !important;
        padding: 0px !important;
        height: 1px !important;
    }
</style>
<div class="container">
    <br><br>
    <i class="fa fa-list-alt" aria-hidden="true"></i>
 <strong>
    @if(!empty($full->category)) {{ @$full->category->name() }}@endif </strong>



    @if(empty($full->category))


<div class="row">
    @foreach ($quizz_view as $quizz )

    <div class="col-md-4" style="padding-top: 40px;">

 <div onclick="window.location='{{ route('quizz_full', ['id'=>$quizz->id, 'mainTitle_ka' => Str::slug($quizz->mainTitle_ka)]) }}'" style="cursor: pointer; margin-right: 20px;">

    <img src="{{ asset($quizz->upload) }}" id="imquizz" class="coverquizz">
    <br>

    <a href="{{ route('full', ['id'=>$quizz->id, 'title_ka'=>Str::slug($quizz->mainTitle_ka)]) }}">
        {{ $quizz->mainTitle_ka }}
       </a>
       <br>



   </div>
</div>
@endforeach


@endif

</div>

<div class="container">
    <table class="table table-hover">
        <thead>
          <tr>
             <th scope="col"> </th>
            <th scope="col"> </th>
           </tr>
        </thead>
        <tbody>


            @foreach ($event as $events )

            @if(!empty($events->title()))
          <tr onclick="window.location='{{ route('full', ['id'=>$events->id, 'title_ka' => Str::slug($events->title())]) }}'" style="cursor: pointer">
             <td> <a href="{{ route('full', ['id'=>$events->id, 'title_ka'=>Str::slug($events->title())]) }}">
                 {{ $events->title() }}
                </a>
                <br>
                @if (app()->isLocale('ka'))
                <?php setlocale(LC_TIME, 'ka_GE.utf8'); ?>
                {{ Carbon\Carbon::parse($events->year)->formatLocalized('%A, %d %B, %Y') }}

                @else

                <?php setlocale(LC_ALL, 'US'); ?>

                {{ Carbon\Carbon::parse($events->year)->formatLocalized('%A, %d %B, %Y') }}
                @endif               </td>

            <td align="right">
         <img src="{{ asset($events->upload) }}" id="im2" class="cover2">  </td>
          </tr>
          @endif

    @endforeach



        </tbody>
      </table>



</div>



@endsection
