@extends('layout')

@section('tags')
@if($quizz_result)
<meta property="og:title" content="{{ $quizz_result->description }}" />
    <meta property="og:image" content="{{ asset($quizz_result->upload) }}" />
    <meta property='og:url' content="{{ request()->url() }}?s={{ app()->getLocale() }}&result={{$quizz_result->result_id}}" />
@else
    <meta property="og:title" content="{{ $quizz_full->mainTitle_ka }}" />
     <meta property="og:image" content="{{ asset($quizz_full->upload) }}" />
    <meta property='og:url' content="{{ request()->url() }}?fb_lang={{ app()->getLocale() }}" />
@endif
    @endsection

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
    <section>
        <div class="container">

            <div id="main_content">
            <img src="{{ asset($quizz_full->upload) }}" onclick="onClick(this)" class="cover007" id="im007" align="left"
                style="margin-top: -23px">
            <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                <div class="w3-modal-content w3-animate-zoom" style="background-color: transparent">
                    <img id="img01">
                </div>

            </div>
            <script>
                function onClick(element) {
                    document.getElementById("img01").src = element.src;
                    document.getElementById("modal01").style.display = "block";
                }
            </script>
            <div class="col-md-6" style="margin: 0 auto;">


                @foreach ($quizz_time as $quizz_times)

                @if (app()->isLocale('ka'))
                <?php setlocale(LC_TIME, 'ka_GE.utf8'); ?>
                {{ Carbon\Carbon::parse($quizz_times->created_at)->formatLocalized('%A, %d %B, %Y') }}

                @else

                <?php setlocale(LC_ALL, 'US'); ?>

                {{ Carbon\Carbon::parse($quizz_times->created_at)->formatLocalized('%A, %d %B, %Y') }}
                @endif
                @endforeach
            </div>

            <div class="col-md-6" style="margin: 0 auto;">
                <h3> {{ $quizz_full->mainTitle() }} </h3>

                <br>

                <!-- ShareThis BEGIN -->
                <div class="sharethis-inline-share-buttons"
                    data-url="{{ request()->url() }}?fb_lang={{ Illuminate\Support\Facades\Session::get('locale') }}">
                </div><!-- ShareThis END --> <br>
            </div>
            <div class="col-md-6" style="margin: 0 auto;">
                {{ $quizz_full->main_description() }} <br>

                <div class="alert alert-danger col-md-4" role="alert" style="cursor:pointer; margin-top: 20px" onclick="$('#main_content').hide();$('#quizz_content').show()">

                    დაიწყე ქვიზი

                </div>
            </div>









            </div>


            <div style="display:none; margin: 0 auto;" id="quizz_content" class="col-md-6">
                @foreach ($quizz_full->questions as $question)

<div id="question_{{$loop->index}}" {!! $loop->index===0 ? '' : ' style="display: none"' !!}>
                <img src="{{ asset($question->upload) }}" onclick="onClick(this)" class="cover007" id="im007" align="left" style="margin-top: -23px">
            <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                <div class="w3-modal-content w3-animate-zoom" style="background-color: transparent">
                    <img id="img01">
                </div>

            </div>
            <script>
                function onClick(element) {
                    document.getElementById("img01").src = element.src;
                    document.getElementById("modal01").style.display = "block";
                }
            </script>


               <div> <h3> <b> {{ @$question->question_ka }} </b> </h3> </div>

               <style>


                #myDiv {
                  border-left: 5px solid black;
                 }

                 .correct
                 {
                    border-left: 5px solid green !important;
                 }

                .hoverit
                {
                    background-color: rgb(243, 243, 243);

                }
                .hoverit:hover
                {
                    background-color: rgb(233, 233, 233);
                }


                </style>
<br>
               <div class="hoverit" style="padding:15px; cursor: pointer; margin-bottom: 15px; border-left:5px solid #ff0000" onclick="selectAnsver({{$loop->index}}, 1, {{ (int)@$question->correct === 1 ? 1 : 0 }}, {{ (int)@$question->correct }})"> {{ @$question->answerOne_ka }}

                <div id="feedback_one_{{$loop->index}}_ka" style="display:none; margin-top: 10px; font-style: italic"> {!! @$question->feedbackOne_ka !!}
            <?php if((int)@$question->correct === 1) {  ?>

                <i class="fas fa-check" style="font-size: 22px; float: right; color:green"></i>
                <?php } else { ?>

                    <i class="fas fa-times" style="font-size: 22px; float: right; color:red"></i>

                    <?php } ?>
            </div></div>

<div class="hoverit" style="padding:15px; cursor: pointer; margin-bottom: 15px; border-left:5px solid red"  onclick="selectAnsver({{$loop->index}}, 2, {{ (int)@$question->correct === 2 ? 1 : 0 }}, {{ (int)@$question->correct }})"> {{ @$question->answerTwo_ka }}
    <div id="feedback_two_{{$loop->index}}_ka" style="display:none; margin-top: 10px; font-style: italic"> {!! @$question->feedbackTwo_ka !!}
        <?php if((int)@$question->correct === 2) {  ?>

            <i class="fas fa-check" style="font-size: 22px; float: right; color:green"></i>
                <?php } else { ?>

                    <i class="fas fa-times" style="font-size: 22px; float: right; color:red"></i>

                    <?php } ?>
        </div></div>

<div class="hoverit" style="padding:15px; cursor: pointer; border-left:5px solid red" onclick="selectAnsver({{$loop->index}}, 3, {{ (int)@$question->correct === 3 ? 1 : 0 }}, {{ (int)@$question->correct }})"> {{ @$question->answerThree_ka }}
    <div id="feedback_three_{{$loop->index}}_ka" style="display:none; margin-top: 10px; font-style: italic"> {!! @$question->feedbackThree_ka !!}
        <?php if((int)@$question->correct === 3) {  ?>

             <i class="fas fa-check" style="font-size: 22px; float: right; color:green"></i>
            <?php } else { ?>

                <i class="fas fa-times" style="font-size: 22px; float: right; color:red"></i>

                <?php } ?>
        </div></div>

               <div onclick="showNext({{$loop->index}})"  id="next_{{$loop->index}}" class="alert alert-danger col-md-4" role="alert" style="cursor:pointer; display:none; margin-top: 20px; border-radius:0px;" onclick="$('#main_content').hide();$('#quizz_content').show()">

               შემდეგი კითხვა</div>


</div>
                @endforeach


            </div>

<div id="final_feedback_1" style="display: none; margin: 0 auto;" class="col-md-6">

    <img src="{{ asset($quizz_full->upload) }}" onclick="onClick(this)" class="cover007" id="im007" align="left">
    <span id="final_feedback_score_1"></span>/ {{ $count }}
    <br>


    {{ $quizz_full->feedbackOne_ka }}
    <style>
 svg
{
    width: 50px;
}

    </style>

<div style="padding-top: 10px; padding-bottom: 10px;">
<b> გაუზიარე მეგობრებს: </b> </div>

    <div class="quiz__social">
        <a id="fb_share_one_url" href="#" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
            <svg id="facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path id="Path_33" data-name="Path 33" d="M141.752,247.38q-.15.024-.3.045Q141.6,247.4,141.752,247.38Zm0,0" transform="translate(-127.817 -223.536)"></path>
                <path id="Path_34" data-name="Path 34" d="M145.721,246.954l-.143.025Zm0,0" transform="translate(-131.546 -223.151)"></path>
                <path id="Path_35" data-name="Path 35" d="M135.362,248.193q-.176.02-.353.035Q135.186,248.213,135.362,248.193Zm0,0" transform="translate(-121.996 -224.27)"></path>
                <path id="Path_36" data-name="Path 36" d="M139.476,247.9l-.169.021Zm0,0" transform="translate(-125.879 -224.006)"></path>
                <path id="Path_37" data-name="Path 37" d="M149.266,246.281l-.127.027Zm0,0" transform="translate(-134.764 -222.544)"></path>
                <path id="Path_38" data-name="Path 38" d="M157.908,244.192l-.1.028Zm0,0" transform="translate(-142.596 -220.655)"></path>
                <path id="Path_39" data-name="Path 39" d="M155.279,244.887l-.111.029Zm0,0" transform="translate(-140.211 -221.284)"></path>
                <path id="Path_40" data-name="Path 40" d="M151.885,245.719l-.118.027Zm0,0" transform="translate(-137.139 -222.035)"></path>
                <path id="Path_41" data-name="Path 41" d="M133.191,248.557l-.19.014Zm0,0" transform="translate(-120.182 -224.6)"></path>
                <path id="Path_42" data-name="Path 42" d="M24,12A12,12,0,1,0,12,24l.211,0V14.656H9.633v-3h2.578V9.44a3.609,3.609,0,0,1,3.853-3.96,21.223,21.223,0,0,1,2.311.118v2.68H16.8c-1.244,0-1.485.591-1.485,1.459v1.914h2.975l-.388,3H15.312v8.881A12.006,12.006,0,0,0,24,12Zm0,0" fill="#2d3e9f"></path>
                <path id="Path_43" data-name="Path 43" d="M129.2,248.723q-.187.012-.376.019Q129.012,248.735,129.2,248.723Zm0,0" transform="translate(-116.407 -224.749)"></path>
                <path id="Path_44" data-name="Path 44" d="M126.89,248.92l-.2,0Zm0,0" transform="translate(-114.479 -224.928)"></path>
            </svg>
        </a>
    </div>

                <div class="alert alert-danger col-md-4" role="alert" style="cursor:pointer; margin-top: 20px" onclick="$('#main_content').hide();$('#quizz_content').show()">
    <a class="btn btn-default" href="{{ request()->fullUrl() }}" role="button">თავიდან დაწყება</a>
                </div>

</div>
<div id="final_feedback_2" style="display: none; margin: 0 auto;" class="col-md-6">
    <img src="{{ asset($quizz_full->upload) }}" onclick="onClick(this)" class="cover007" id="im007" align="left">
    <span id="final_feedback_score_2"></span>/{{ $count }}
    <br>


    {{ $quizz_full->feedbackTwo_ka }}

    <div style="padding-top: 10px; padding-bottom: 10px;">
        <b> გაუზიარე მეგობრებს: </b> </div>

    <div class="quiz__social">
        <a id="fb_share_two_url" href="#" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
            <svg id="facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path id="Path_33" data-name="Path 33" d="M141.752,247.38q-.15.024-.3.045Q141.6,247.4,141.752,247.38Zm0,0" transform="translate(-127.817 -223.536)"></path>
                <path id="Path_34" data-name="Path 34" d="M145.721,246.954l-.143.025Zm0,0" transform="translate(-131.546 -223.151)"></path>
                <path id="Path_35" data-name="Path 35" d="M135.362,248.193q-.176.02-.353.035Q135.186,248.213,135.362,248.193Zm0,0" transform="translate(-121.996 -224.27)"></path>
                <path id="Path_36" data-name="Path 36" d="M139.476,247.9l-.169.021Zm0,0" transform="translate(-125.879 -224.006)"></path>
                <path id="Path_37" data-name="Path 37" d="M149.266,246.281l-.127.027Zm0,0" transform="translate(-134.764 -222.544)"></path>
                <path id="Path_38" data-name="Path 38" d="M157.908,244.192l-.1.028Zm0,0" transform="translate(-142.596 -220.655)"></path>
                <path id="Path_39" data-name="Path 39" d="M155.279,244.887l-.111.029Zm0,0" transform="translate(-140.211 -221.284)"></path>
                <path id="Path_40" data-name="Path 40" d="M151.885,245.719l-.118.027Zm0,0" transform="translate(-137.139 -222.035)"></path>
                <path id="Path_41" data-name="Path 41" d="M133.191,248.557l-.19.014Zm0,0" transform="translate(-120.182 -224.6)"></path>
                <path id="Path_42" data-name="Path 42" d="M24,12A12,12,0,1,0,12,24l.211,0V14.656H9.633v-3h2.578V9.44a3.609,3.609,0,0,1,3.853-3.96,21.223,21.223,0,0,1,2.311.118v2.68H16.8c-1.244,0-1.485.591-1.485,1.459v1.914h2.975l-.388,3H15.312v8.881A12.006,12.006,0,0,0,24,12Zm0,0" fill="#2d3e9f"></path>
                <path id="Path_43" data-name="Path 43" d="M129.2,248.723q-.187.012-.376.019Q129.012,248.735,129.2,248.723Zm0,0" transform="translate(-116.407 -224.749)"></path>
                <path id="Path_44" data-name="Path 44" d="M126.89,248.92l-.2,0Zm0,0" transform="translate(-114.479 -224.928)"></path>
            </svg>
        </a>
    </div>


    <div class="alert alert-danger col-md-4" role="alert" style="cursor:pointer; margin-top: 20px" onclick="$('#main_content').hide();$('#quizz_content').show()">
        <a class="btn btn-default" href="{{ request()->fullUrl() }}" role="button">თავიდან დაწყება</a>
                    </div>

</div>

<div id="final_feedback_3" style="display: none; margin: 0 auto;" class="col-md-6">
    <img src="{{ asset($quizz_full->upload) }}" onclick="onClick(this)" class="cover007" id="im007" align="left">
    <span id="final_feedback_score_3"></span>/{{ $count }}
    <br>
    {{ $quizz_full->feedbackThree_ka }}

    <div style="padding-top: 10px; padding-bottom: 10px;">
        <b> გაუზიარე მეგობრებს: </b> </div>

    <div class="quiz__social">
        <a id="fb_share_three_url" href="#" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
            <svg id="facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path id="Path_33" data-name="Path 33" d="M141.752,247.38q-.15.024-.3.045Q141.6,247.4,141.752,247.38Zm0,0" transform="translate(-127.817 -223.536)"></path>
                <path id="Path_34" data-name="Path 34" d="M145.721,246.954l-.143.025Zm0,0" transform="translate(-131.546 -223.151)"></path>
                <path id="Path_35" data-name="Path 35" d="M135.362,248.193q-.176.02-.353.035Q135.186,248.213,135.362,248.193Zm0,0" transform="translate(-121.996 -224.27)"></path>
                <path id="Path_36" data-name="Path 36" d="M139.476,247.9l-.169.021Zm0,0" transform="translate(-125.879 -224.006)"></path>
                <path id="Path_37" data-name="Path 37" d="M149.266,246.281l-.127.027Zm0,0" transform="translate(-134.764 -222.544)"></path>
                <path id="Path_38" data-name="Path 38" d="M157.908,244.192l-.1.028Zm0,0" transform="translate(-142.596 -220.655)"></path>
                <path id="Path_39" data-name="Path 39" d="M155.279,244.887l-.111.029Zm0,0" transform="translate(-140.211 -221.284)"></path>
                <path id="Path_40" data-name="Path 40" d="M151.885,245.719l-.118.027Zm0,0" transform="translate(-137.139 -222.035)"></path>
                <path id="Path_41" data-name="Path 41" d="M133.191,248.557l-.19.014Zm0,0" transform="translate(-120.182 -224.6)"></path>
                <path id="Path_42" data-name="Path 42" d="M24,12A12,12,0,1,0,12,24l.211,0V14.656H9.633v-3h2.578V9.44a3.609,3.609,0,0,1,3.853-3.96,21.223,21.223,0,0,1,2.311.118v2.68H16.8c-1.244,0-1.485.591-1.485,1.459v1.914h2.975l-.388,3H15.312v8.881A12.006,12.006,0,0,0,24,12Zm0,0" fill="#2d3e9f"></path>
                <path id="Path_43" data-name="Path 43" d="M129.2,248.723q-.187.012-.376.019Q129.012,248.735,129.2,248.723Zm0,0" transform="translate(-116.407 -224.749)"></path>
                <path id="Path_44" data-name="Path 44" d="M126.89,248.92l-.2,0Zm0,0" transform="translate(-114.479 -224.928)"></path>
            </svg>
        </a>
    </div>

    <div class="alert alert-danger col-md-4" role="alert" style="cursor:pointer; margin-top: 20px" onclick="$('#main_content').hide();$('#quizz_content').show()">
        <a class="btn btn-default" href="{{ request()->fullUrl() }}" role="button">თავიდან დაწყება</a>
                    </div>

</div>

<div id="final_feedback_4" style="display: none; margin: 0 auto;" class="col-md-6">
    <img src="{{ asset($quizz_full->upload) }}" onclick="onClick(this)" class="cover007" id="im007" align="left">
    <span id="final_feedback_score_4"></span>/{{ $count }}
    <br>
        {{ $quizz_full->feedbackFour_ka }}

        <div style="padding-top: 10px; padding-bottom: 10px;">
            <b> გაუზიარე მეგობრებს: </b> </div>

        <div class="quiz__social">
            <a id="fb_share_four_url" href="#" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <svg id="facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path id="Path_33" data-name="Path 33" d="M141.752,247.38q-.15.024-.3.045Q141.6,247.4,141.752,247.38Zm0,0" transform="translate(-127.817 -223.536)"></path>
                    <path id="Path_34" data-name="Path 34" d="M145.721,246.954l-.143.025Zm0,0" transform="translate(-131.546 -223.151)"></path>
                    <path id="Path_35" data-name="Path 35" d="M135.362,248.193q-.176.02-.353.035Q135.186,248.213,135.362,248.193Zm0,0" transform="translate(-121.996 -224.27)"></path>
                    <path id="Path_36" data-name="Path 36" d="M139.476,247.9l-.169.021Zm0,0" transform="translate(-125.879 -224.006)"></path>
                    <path id="Path_37" data-name="Path 37" d="M149.266,246.281l-.127.027Zm0,0" transform="translate(-134.764 -222.544)"></path>
                    <path id="Path_38" data-name="Path 38" d="M157.908,244.192l-.1.028Zm0,0" transform="translate(-142.596 -220.655)"></path>
                    <path id="Path_39" data-name="Path 39" d="M155.279,244.887l-.111.029Zm0,0" transform="translate(-140.211 -221.284)"></path>
                    <path id="Path_40" data-name="Path 40" d="M151.885,245.719l-.118.027Zm0,0" transform="translate(-137.139 -222.035)"></path>
                    <path id="Path_41" data-name="Path 41" d="M133.191,248.557l-.19.014Zm0,0" transform="translate(-120.182 -224.6)"></path>
                    <path id="Path_42" data-name="Path 42" d="M24,12A12,12,0,1,0,12,24l.211,0V14.656H9.633v-3h2.578V9.44a3.609,3.609,0,0,1,3.853-3.96,21.223,21.223,0,0,1,2.311.118v2.68H16.8c-1.244,0-1.485.591-1.485,1.459v1.914h2.975l-.388,3H15.312v8.881A12.006,12.006,0,0,0,24,12Zm0,0" fill="#2d3e9f"></path>
                    <path id="Path_43" data-name="Path 43" d="M129.2,248.723q-.187.012-.376.019Q129.012,248.735,129.2,248.723Zm0,0" transform="translate(-116.407 -224.749)"></path>
                    <path id="Path_44" data-name="Path 44" d="M126.89,248.92l-.2,0Zm0,0" transform="translate(-114.479 -224.928)"></path>
                </svg>
            </a>
        </div>

        <div class="alert alert-danger col-md-4" role="alert" style="cursor:pointer; margin-top: 20px" onclick="$('#main_content').hide();$('#quizz_content').show()">
            <a class="btn btn-default" href="{{ request()->fullUrl() }}" role="button">თავიდან დაწყება</a>
                        </div>
    </div>


    @section('related')

    <div class="col-md-6" style="margin: 0 auto; padding-top:30px">
        <div style="padding:10px; background-color:#eee; color:rgb(14, 13, 13); border-radius: 3px">
            <i class="fa-regular fa-compass"></i>

            <strong style="margin-left: 22px;"> {{ Lang::get('lang.related') }} </strong>
        </div>
        <div style="position: relative; margin-top: 20px">
                        <style>
                            a {
                                color: #000000;
                                text-decoration: none;
                            }

                            a:hover {
                                color: #000000;
                                text-decoration: none;
                            }

                            .hoverDiv {
                                background: #fff;
                                padding: 10px;
                                border-bottom: 1px solid #eee
                            }

                            .hoverDiv:hover {
                                background: #eee;
                                padding: 10px;
                            }
                        </style>
                        @foreach ($related as $rel)
                            <div class="hoverDiv"
                                onclick="window.location='{{ route('quizz_full', ['mainTitle_ka' => Str::slug($rel->mainTitle_ka), 'id' => $rel->id]) }}'"
                                style="cursor: pointer;">

                                <span style="padding:4px; margin-right: 22px; "> {{ $loop->index + 1 }} </span>


                                <a href="{{ route('quizz_full', ['mainTitle_ka' => Str::slug($rel->mainTitle_ka), 'id' => $rel->id]) }}">
                                    {{ $rel->mainTitle_ka }} </a>
                            </div>
                        @endforeach

                    </div>

                </div>

            @show


        </div>
    </div>
</section>
@endsection

</div>





    </section>
    <script>
var selected=false;
var correct_answers = 0;
function selectAnsver(question_index, answer_index, correct, correct_index)
{
    if(selected)
    {
        return;
    }
    if(answer_index == 1)
    {
        $('#feedback_one_'+question_index+'_ka').show();
        $('#next_'+question_index).show();
        selected=true;
        if(correct)
        {
            correct_answers++;
          }

    }

    if(answer_index == 2)
    {
        $('#feedback_two_'+question_index+'_ka').show();
        $('#next_'+question_index).show();
        selected=true;

        if(correct)
        {
            correct_answers++;

        }

    }

    if(answer_index == 3)
    {
        $('#feedback_three_'+question_index+'_ka').show();
        $('#next_'+question_index).show();
        selected=true;

        if(correct)
        {
            correct_answers++;

        }
    }
    if(correct_index === 1)
    {
        $('#feedback_one_'+question_index+'_ka').parent().addClass('correct');
    }
    if(correct_index === 2)
    {
        $('#feedback_two_'+question_index+'_ka').parent().addClass('correct');
    }
    if(correct_index === 3)
    {
        $('#feedback_three_'+question_index+'_ka').parent().addClass('correct');
    }
}
function showNext(question_index)
{
    $('#question_'+question_index).hide();
    $('#question_'+(question_index+1)).show();
    selected=false;

    if(question_index == {{ $quizz_full->questions->count()-1 }})
    {
        $.get('{{ route('quizz_results') }}', { quizz_id: "{{ $quizz_full->id }}", correct_answers: correct_answers }).done(function (data) {
            $('#fb_share_one_url').attr('href', 'https://www.facebook.com/sharer/sharer.php?u={{ route('quizz_full', ['id'=>$quizz_full->id, 'mainTitle_ka'=>$quizz_full->mainTitle_ka]) }}?result='+data);
            $('#fb_share_two_url').attr('href', 'https://www.facebook.com/sharer/sharer.php?u={{ route('quizz_full', ['id'=>$quizz_full->id, 'mainTitle_ka'=>$quizz_full->mainTitle_ka]) }}?result='+data);
            $('#fb_share_three_url').attr('href', 'https://www.facebook.com/sharer/sharer.php?u={{ route('quizz_full', ['id'=>$quizz_full->id, 'mainTitle_ka'=>$quizz_full->mainTitle_ka]) }}?result='+data);
            $('#fb_share_four_url').attr('href', 'https://www.facebook.com/sharer/sharer.php?u={{ route('quizz_full', ['id'=>$quizz_full->id, 'mainTitle_ka'=>$quizz_full->mainTitle_ka]) }}?result='+data);

        });
        $('#quizz_content').hide();
        if(correct_answers <= 3)
        {
            $('#final_feedback_1').show();
            $('#final_feedback_score_1').html(correct_answers);
        }
        if(correct_answers > 3 && correct_answers <= 6)
        {
            $('#final_feedback_2').show();
            $('#final_feedback_score_2').html(correct_answers);
        }

        if(correct_answers > 6 && correct_answers <= 9)
        {
            $('#final_feedback_3').show();
            $('#final_feedback_score_3').html(correct_answers);
        }

        if(correct_answers > 9)
        {
            $('#final_feedback_4').show();
            $('#final_feedback_score_4').html(correct_answers);
        }
    }
}
    </script>
