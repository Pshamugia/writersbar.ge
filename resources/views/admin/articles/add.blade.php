@extends('admin/layout')
@extends('admin/menu')

@section('menu')
@include('inc/head')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="georgian-tab" data-toggle="tab" data-target="#georgian" type="button"
                role="tab" aria-controls="georgian" aria-selected="true">ქართულად</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="english-tab" data-toggle="tab" data-target="#english" type="button" role="tab"
                aria-controls="english" aria-selected="false">English</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="russian-tab" data-toggle="tab" data-target="#russian" type="button" role="tab"
                aria-controls="russian" aria-selected="false">Russian</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="georgian" role="tabpanel" aria-labelledby="georgian-tab">


            <form action="{{ route('admin.article.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <br><br>

                    <input type="text" name="title_ka" class="form-control" aria-describedby="emailHelp"
                        placeholder="სათაური">
                    <br>
                </div>

                <div class="form-group">
                     <select name="category_id" id="category" class="js-example-basic-multiple" multiple="multiple">

                            @foreach ($categories as $category)
                                @if($category->root_id == 0)
                                    <!-- This is a top-level category -->
                                    <option value="{{ $category->id }}">{{ $category->name_ka }}</option>
                                    <!-- Recursively display its subcategories -->
                                    @foreach($categories as $subcategory)
                                        @if($subcategory->root_id == $category->id)
                                            <option value="{{ $subcategory->id }}" style="padding-left: 40px;">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $subcategory->name_ka }}
                                            </option>
                                            <!-- Recursively display its sub-subcategories (if any) -->
                                            @foreach($categories as $sub_subcategory)
                                                @if($sub_subcategory->root_id == $subcategory->id)
                                                    <option value="{{ $sub_subcategory->id }}" style="padding-left: 40px;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        {{ $sub_subcategory->name_ka }}</option>
                                                    <!-- Add more nested loops for deeper levels if necessary -->
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>

                    <script> $(document).ready(function() {

                        $('.js-example-basic-multiple').select2({
                      placeholder: 'კატეგორია',
                      width: '100%'
                    });
                    }); </script>

                </div>

                <div class="form-group">

                    <br>
                    <select name="subkat" class="form-control">
                        <option value="" disabled selected hidden>გავუშვათ მთავარ გვერდზე </option>
                        <option value="yes"> YES </option>
                        <option value="no"> NO </option>



                    </select> <br>
                </div>


                <div class="form-group"
                    style="border: 1px solid rgb(196, 194, 194); padding-top: 6px; padding-bottom: 8px; padding-left: 10px; border-radius: 5px;">
                    გავუშვათ ერთიან მასალად?
                    <input type="checkbox" name="expand" value="1">

                </div>

                <div class="form-group">
                    <input type="text" name="year" id="year" class="form-control" aria-describedby="emailHelp"
                        placeholder="თარიღი">


                        <script>
                            $( function() {
                            $("#year").datepicker({
                            changeMonth: true,
                            changeYear: true,
                            altFormat: "yyyy-mm-dd",
                            dateFormat: "yy-mm-dd",
                            minDate: "+0Y",
                            onSelect: function(selected) {
                            $("#year").datepicker("option","maxDate", selected)
                            }
                            });
                            } );
                            </script>

                </div>



                <div class="form-group">
                    <label>სურათი</label>
                    <input type="file" name="upload" class="form-control" aria-describedby="emailHelp"
                        placeholder="ყდა">
                </div>


                <br>


                <div class="form-group">

                    <!--START TAGS - თეგების დასაწყისი -->

                    <span style="position:relative; ">



                        <script type="text/javascript">
                            function existingTagGe(text)

                            {

                                var existing = false,

                                    text = text.toLowerCase();



                                $("#tags_ka").each(function() {

                                    if ($(this).text().toLowerCase() == text)

                                    {

                                        existing = true;

                                        return "";

                                    }

                                });



                                return existing;

                            }



                            $(function() {

                                $("#tags-new_ka input").focus();



                                $("#tags-new_ka input").keyup(function() {



                                    var tag = $(this).val().trim(),

                                        length = tag.length;



                                    if ((tag.charAt(length - 1) == ',') && (tag != ","))

                                    {

                                        tag = tag.substring(0, length - 1);



                                        if (!existingTagGe(tag))

                                        {

                                            $('<li class="tags tag-item" id="tags_ka"><span>' + tag +
                                                '</span><i class="fa fa-times"></i></li>').insertBefore($("#tags-new_ka"));

                                            $('#save_tags_ka').val($('#save_tags_ka').val() + "," + tag)

                                            $(this).val("");

                                        } else

                                        {

                                            $(this).val(tag);

                                        }

                                    }

                                });


                                $(document).on("click", ".fa.fa-times", function(){
  var tagItem = $(this).parent('.tag-item');
  var text = tagItem.find('span').text().trim();
  var tags_str = $('#save_tags_ka').val();
  tags_str = tags_str.replace(','+text, '');
  $('#save_tags_ka').val(tags_str);
  tagItem.remove();
});
                                $(document).on("click", "#tags_ka svg", function() {

                                    var text = $(this).parent().text();

                                    var tags_str = $('#save_tags_ka').val();

                                    tags_str = tags_str.replace(',' + text, '');

                                    $('#save_tags_ka').val(tags_str);

                                    $(this).parent("li").remove();



                                });



                            });
                        </script>

                        <style>
                            @charset "utf-8";

                            /* CSS Document */







                            #wrapper {

                                position: relative;



                                width: 720px;

                                height: 50px;

                                color: #FF6063;

                            }







                            .tags-input {

                                list-style: none;

                                border: 1px solid #ccc;

                                display: inline-block;

                                padding: 5px;

                                height: 26px;

                                font-size: 14px;

                                background: #f3f3f3;

                                width: 720px;

                                border-radius: 2px;

                                overflow: hidden;

                            }



                            .tags-input li {

                                float: left;

                            }



                            .tags {

                                background: #28343d;

                                padding: 5px 20px 5px 8px;

                                border-radius: 2px;

                                margin-right: 5px;

                                position: relative;

                                color: #FFFFFF
                            }



                            .tags i {

                                position: absolute;

                                right: 6px;

                                top: 3px;

                                width: 8px;

                                height: 8px;

                                content: '';

                                cursor: pointer;

                                opacity: .7;

                                font-size: 12px;

                            }



                            .tags i:hover {

                                opacity: 1;

                            }



                            .tags-new input[type="text"] {

                                border: 0;

                                margin: 0;

                                padding: 0 0 0 3px;

                                font-size: 14px;

                                margin-top: 5px;

                                background: transparent;

                            }



                            .tags-new input[type="text"]:focus {

                                outline: none;

                            }
                        </style>



                        <span id="wrapper">

                            <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

                            <ul class="tags-input" id="tags-input_ka" style="height:auto; width: 100%">

                                <li class="tags tag-item" id="tags_ka" style="background-color:#B9B8B8; color:#000000;">TAGS <i
                                        class="fa fa-times"></i></li>







                                <li class="tags-new" id="tags-new_ka" style="color:#D70003;">

                                    <input type="text" id="tags_ka">

                                    <input type="hidden" name="tags_ka" id="save_tags_ka" value="" />

                                </li>


                            </ul>

                        </span> </soan>

                        <!--END OF TAGS - თეგების დასასრული -->

                </div>

                <div class="form-group">
                    <select name="author_id" class="form-control" id="author_ka">
                        <option value="" disabled selected hidden> ავტორი KA </option>
                        @foreach ($full_author as $authors)
                            <option value="{{ $authors->id }} "> {{ $authors->author_ka }} </option>
                        @endforeach
                    </select>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#author_ka').chosen({
                                width: '100%'
                            });
                        });
                    </script>

                </div>


                <div>
                    <br>

                    <textarea name="description_ka" height="300px" style="height:200px" class="form-control" placeholder="აღწერა KA"></textarea>
                </div>

                <div>
                    <br>
                    <textarea name="full_ka" id="full_ka" height="300px" style="height:200px" class="form-control"
                        placeholder="Full KA"></textarea>

                    <script>
                        ClassicEditor
                            .create(document.querySelector('#full_ka'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                </div>
        </div>
        {{-- ქართულის დასასრული --}}

        <div class="tab-pane fade" id="english" role="tabpanel" aria-labelledby="english-tab">
            <div>

                <br><br>

                <input type="text" name="title_en" class="form-control" aria-describedby="emailHelp"
                    placeholder="Title">
                <br>
            </div>

            <div class="form-group">
                <select name="author_id" class="form-control" id="author_en">
                    <option value="" disabled selected hidden> Author EN </option>
                    @foreach ($full_author as $authors)
                        <option value="{{ $authors->id }} "> {{ $authors->author_en }} </option>
                    @endforeach
                </select>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#author_en').chosen({
                            width: '100%'
                        });
                    });
                </script>

            </div>

            <div>
                <br>

                <textarea name="description_en" height="300px" style="height:200px" class="form-control"
                    placeholder="Description EN"></textarea>
            </div>

            <div>
                <br><br>
                <textarea name="full_en" id="full_en" height="300px" style="height:200px" class="form-control"
                    placeholder="Full EN"> </textarea>

                <script>
                    ClassicEditor
                        .create(document.querySelector('#full_en'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </div>

        </div>
        {{-- ინგლისურის დასასრული --}}

        <div class="tab-pane fade" id="russian" role="tabpanel" aria-labelledby="russian-tab">
            Russky karabl
        </div>
    </div>




    <br><br>
    <button type="submit" class="btn btn-primary">დამახსოვრება</button>
    </form>
    <br><br>
@endsection
