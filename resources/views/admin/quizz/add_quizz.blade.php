@extends('admin/layout')
@extends('admin/menu')

@section('menu')
    <div>


        <form action="{{ route('admin.quizz.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="form-group">
                <label> სათავო სურათი </label>
                <input type="file" name="upload"> <br><br>

                <input type="text" name="mainTitle_ka" placeholder="მთავარი სათაური ქართულად" class="form-control"> <br>
                <input type="text" name="mainTitle_en" placeholder="Main title English" class="form-control"> <br>
                <input type="text" name="mainDescription_ka" placeholder="ქვიზის აღწერა" class="form-control"> <br>
                <input type="text" name="mainDescription_en" placeholder="Quizz description" class="form-control"> <br>

                <br>


            </div>

            <div>


                <div class="form-group">



                    <div>
                        <div>
                            <div id="row">


                                <input type="hidden" name="name_id[]" value="0" />
                                <div style="background-color: blanchedalmond; padding:20px">




                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger" id="DeleteRow" type="button">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </div>

                                    <input type="text" name="question_ka[]" placeholder="კითხვა" class="form-control">
                                    <br>
                                    <label> კითხვის საილუსტრაციო სურათი </label>
                                    <input type="file" name="uploadFeedback_0"> <br><br>
                                    <input type="text" name="answerOne_ka[]" placeholder="1 ვარიანტი" class="col-md-4">
                                    <input type="radio" name="correct_0" value="1"> <br> <br>

                                    <style>
                                        .cke {
                                            width: 400px;
                                         }
                                    </style>

                                    <textarea name="feedbackOne_ka[]" id="feedbackOne_ka" placeholder="ფიდბეკი" class="col-md-4"></textarea>

                                    <script type="text/javascript">
                                        CKEDITOR.replace('feedbackOne_ka');
                                        </script>

                                    <br><br>


                                    <input type="text" name="answerTwo_ka[]" placeholder="2 ვარიანტი" class="col-md-4">
                                    <input type="radio" name="correct_0" value="2"> <br> <br>
                                    <textarea name="feedbackTwo_ka[]" id="feedbackTwo_ka" placeholder="ფიდბეკი" class="col-md-4"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('feedbackTwo_ka');
                                        </script>
                                    <br><br>

                                    <input type="text" name="answerThree_ka[]" placeholder="3 ვარიანტი" class="col-md-4">
                                    <input type="radio" name="correct_0" value="3"> <br> <br>
                                    <textarea name="feedbackThree_ka[]" id="feedbackThree_ka" placeholder="ფიდბეკი" class="col-md-4"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('feedbackThree_ka');
                                        </script>
                                    <br>
                                </div>

                            </div>

                            <div id="newinput"></div>
                            <button id="rowAdder" type="button" class="btn btn-dark">
                                <span class="bi bi-plus-square-dotted">
                                </span> ADD Question
                            </button>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var RADIO_ID = 0;
                        $("#rowAdder").click(function() {
                            RADIO_ID++;
                            newRowAdd =
                                '<input type="hidden" name="name_id[]" value="' + RADIO_ID +
                                '"/><div style="background-color: blanchedalmond; padding:20px; margin-top:33px">' +
                                '<div class="input-group-prepend">' +
                                '<button class="btn btn-danger" id="DeleteRow" type="button">' +
                                '<i class="bi bi-trash"></i>' +
                                'Delete' +
                                '</button>' +
                                '</div>' +
                                '<input type="text" name="question_ka[]" placeholder="კითხვა" class="form-control"> <br>' +
                                '<label> კითხვის საილუსტრაციო სურათი </label>' +
                                '<input type="file" name="uploadFeedback_' + RADIO_ID + '"> <br><br>' +
                                '<input type="text" name="answerOne_ka[]" placeholder="1 ვარიანტი" class="col-md-4">' +
                                '<input type="radio" name="correct_' + RADIO_ID + '" value="1"> <br> <br>' +
                                '<textarea name="feedbackOne_ka[]" id="feedbackOne_ka_'+RADIO_ID+'" placeholder="ფიდბეკი" class="col-md-4"></textarea>' +

                                '<br><br>' +
                                '<input type="text" name="answerTwo_ka[]" placeholder="2 ვარიანტი" class="col-md-4">' +
                                '<input type="radio" name="correct_' + RADIO_ID + '" value="2"> <br> <br>' +
                                '<textarea name="feedbackTwo_ka[]" id="feedbackTwo_ka_'+RADIO_ID+'" placeholder="ფიდბეკი" class="col-md-4"></textarea>' +
                                '<br><br>' +
                                '<input type="text" name="answerThree_ka[]" placeholder="3 ვარიანტი" class="col-md-4">' +
                                '<input type="radio" name="correct_' + RADIO_ID + '" value="3"> <br> <br>' +
                                '<textarea name="feedbackThree_ka[]" id="feedbackThree_ka_'+RADIO_ID+'" placeholder="ფიდბეკი" class="col-md-4"></textarea>' +
                                '<br></div>';

                            $('#newinput').append(newRowAdd);

                            CKEDITOR.replace('feedbackOne_ka_'+RADIO_ID);
                            CKEDITOR.replace('feedbackTwo_ka_'+RADIO_ID);
                            CKEDITOR.replace('feedbackThree_ka_'+RADIO_ID);
                        });

                        $("body").on("click", "#DeleteRow", function() {
                            $(this).parents("#row").remove();
                        })
                    </script>


                </div>


            </div>



            <br>

            <div class="alert alert-dark" role="alert">

                <div class="alert alert-secondary" role="alert"
                    style="border:1px solid rgb(163, 157, 157); margin-top: 10px">
                    <b> შეფასება </b>
                </div>

                <div class="alert alert-secondary" role="alert" style="border:1px solid rgb(163, 157, 157)">
                    <b> 1 - 3 სწორი პასუხი </b>
                    <br><br>
                    <label> შეფასების საილუსტრაციო სურათი </label>
                    <input type="file" name="upload1"> <br><br>
                    <div>
                        <textarea name="finalFeedbackOne_ka" placeholder="1-3"></textarea>
                    </div>
                </div>

                <div class="alert alert-secondary" role="alert" style="border:1px solid rgb(163, 157, 157)">
                    <b> 4 - 6 სწორი პასუხი </b>
                    <br><br>
                    <label> შეფასების საილუსტრაციო სურათი </label>
                    <input type="file" name="upload2"> <br><br>
                    <div>
                        <textarea name="finalFeedbackTwo_ka" placeholder="4-6"></textarea>
                    </div>
                </div>


                <div class="alert alert-secondary" role="alert" style="border:1px solid rgb(163, 157, 157)">
                    <b> 7-9 სწორი პასუხი </b>
                    <br><br>
                    <label> შეფასების საილუსტრაციო სურათი </label>
                    <input type="file" name="upload3"> <br><br>
                    <div>
                        <textarea name="finalFeedbackThree_ka" placeholder="7-9"></textarea>
                    </div>
                </div>


                <div class="alert alert-secondary" role="alert" style="border:1px solid rgb(163, 157, 157)">
                    <b> 10 სწორი პასუხი </b>
                    <br><br>
                    <label> შეფასების საილუსტრაციო სურათი </label>
                    <input type="file" name="upload4"> <br><br>
                    <div>
                        <textarea name="finalFeedbackFour_ka" placeholder="10"></textarea>
                    </div>
                </div>


            </div>

            <button type="submit" class="btn btn-primary">დამახსოვრება</button>
            <br><br>
        </form>
    </div>
@endsection
