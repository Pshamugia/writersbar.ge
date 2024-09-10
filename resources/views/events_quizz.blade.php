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
    ქვიზოგადოება </strong>





<div class="row">
    @foreach ($quizz_view as $quizz )

    <div class="col-md-4" style="padding-top: 40px; margin-bottom: 30px;">

 <div onclick="window.location='{{ route('quizz_full', ['id'=>$quizz->id, 'mainTitle_ka' => Str::slug($quizz->mainTitle_ka)]) }}'" style="cursor: pointer; margin-right: 20px;">

    <img src="{{ asset($quizz->upload) }}" id="imquizz" class="coverquizz">
    <br>
     <a href="{{ route('quizz_full', ['id'=>$quizz->id, 'mainTitle_ka' => Str::slug($quizz->mainTitle_ka)]) }}" style="font-size: 19px !important">
        {{ $quizz->mainTitle_ka }}
       </a>
       <br>



   </div>
</div>
@endforeach



</div>

         </tbody>
      </table>



</div>



@endsection
