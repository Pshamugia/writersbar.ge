@extends('admin/layout')
@extends('admin/menu')

@section('menu')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="georgian-tab" data-toggle="tab" data-target="#georgian" type="button" role="tab" aria-controls="georgian" aria-selected="true">ქართულად</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="english-tab" data-toggle="tab" data-target="#english" type="button" role="tab" aria-controls="english" aria-selected="false">English</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="russian-tab" data-toggle="tab" data-target="#russian" type="button" role="tab" aria-controls="russian" aria-selected="false">Russian</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="georgian" role="tabpanel" aria-labelledby="georgian-tab">

        <form action="{{ route('admin.articles.update', ['id' => $newArticles->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>სათაური</label>
                <input type="text" name="title_ka" value="{{ $newArticles->title_ka }}" class="form-control"
                    aria-describedby="emailHelp" placeholder="სათაური">
            </div>

            <div class="form-group">
                <label>კატეგორია</label> <br>

                <select name="category_id" class="js-example-basic-multiple" multiple="multiple">
                    @foreach ($categories as $category)
                    @if($category->root_id == 0)
                        <!-- This is a top-level category -->
                        <option value="{{ $category->id }}" @if ($category->id === $newArticles->category_id) selected @endif()>{{ $category->name_ka }}</option>
                        <!-- Recursively display its subcategories -->
                        @foreach($categories as $subcategory)
                            @if($subcategory->root_id == $category->id)
                                <option value="{{ $subcategory->id }}" @if ($subcategory->id === $newArticles->category_id) selected @endif() style="padding-left: 40px;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ $subcategory->name_ka }}
                                </option>
                                <!-- Recursively display its sub-subcategories (if any) -->
                                @foreach($categories as $sub_subcategory)
                                    @if($sub_subcategory->root_id == $subcategory->id)
                                        <option value="{{ $sub_subcategory->id }}" @if ($sub_subcategory->id === $newArticles->category_id) selected @endif() style="padding-left: 40px;">
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
                <label>ქვეკატეგორია</label>
                <select name="subkat" class="form-control">

                    <option value="yes" @if ($newArticles->subkat === 'yes') selected @endif()> YES </option>
                    <option value="NO" @if ($newArticles->subkat === 'NO') selected @endif()> NO </option>

                </select>
            </div>


            <div class="form-group" style="border: 1px solid rgb(196, 194, 194); padding-top: 6px; padding-bottom: 8px; padding-left: 10px; border-radius: 5px;">

                გავუშვათ ერთიან მასალად?
                <input type="checkbox" name="expand" {{ $newArticles->expand == '1' ? 'checked' : '' }} value="1">

            </div>

            <div class="form-group">
                <label>გამოქვეყნების თარიღი</label>
                <input type="text" id="year" value="{{ Carbon\Carbon::parse($newArticles->year)->format('Y-m-d') }}" name="year"
                    class="form-control" aria-describedby="emailHelp" placeholder="გამოშვების წელი">

                    <script>
                        $( function() {
                          $("#year").datepicker({
                            changeMonth: true,
                            changeYear: true,
                            altFormat: "yyyy-mm-dd",
                            dateFormat: "yy-mm-dd",
                            maxDate: "+0Y",
                              onSelect: function(selected) {
                                 $("#year").datepicker("option","maxDate", selected)
                              }
                          });
                        } );
                        </script>
            </div>



            <div class="form-group">
                 <img src="{{ asset($newArticles->upload) }}" width="180px"><br>
                <input type="file" name="upload" class="form-control" aria-describedby="emailHelp" placeholder="ყდა">
            </div>

            <div class="form-group">

                <!--START TAGS - თეგების დასაწყისი -->

 <span style="position:relative; ">



    <script type="text/javascript"> function existingTagKa(text)

   {

       var existing = false,

           text = text.toLowerCase();



       $("#tags_ka").each(function(){

           if ($(this).text().toLowerCase() == text)

           {

               existing = true;

               return "";

           }

       });



       return existing;

   }



   $(function(){

     $("#tags-new_ka input").focus();



     $("#tags-new_ka input").keyup(function(){



           var tag = $(this).val().trim(),

           length = tag.length;



           if((tag.charAt(length - 1) == ',') && (tag != ","))

           {

               tag = tag.substring(0, length - 1);



               if(!existingTagKa(tag))

               {

                   $('<li class="tags tag-item" id="tags_ka"><span>' + tag + '</span><i class="fa fa-times"></i></li>').insertBefore($("#tags-new_ka"));

                   $('#save_tags_ka').val($('#save_tags_ka').val() + "," + tag)

                   $(this).val("");

               }

               else

               {

                   $(this).val(tag);

               }

           }

       });



     $(document).on("click", "#tags_ka svg", function(){

         var text = $(this).parent().text();

         var tags_str = $('#save_tags_ka').val();

         tags_str = tags_str.replace(','+text, '');

         $('#save_tags_ka').val(tags_str);

       $(this).parent("li").remove();



     });



   });

                                    </script>

                                    <style> @charset "utf-8";

   /* CSS Document */







   #wrapper

   {

       position:relative;



       width:720px;

       height:50px;

       color:#FF6063;

     }







   .tags-input

   {

         list-style : none;

         border:1px solid #ccc;

         display:inline-block;

         padding:5px;

         height: 26px;

       font-size:14px;

       background:#f3f3f3;

       width:720px;

       border-radius:2px;

       overflow:hidden;

   }



   .tags-input li

   {

         float:left;

   }



   .tags

   {

         background:#28343d;

         padding:5px 20px 5px 8px;

         border-radius:2px;

         margin-right: 5px;

         position: relative;

       color: #FFFFFF

   }



   .tags i

   {

       position: absolute;

       right:6px;

       top:3px;

       width: 8px;

       height: 8px;

       content:'';

       cursor:pointer;

       opacity: .7;

     font-size:12px;

   }



   .tags i:hover

   {

       opacity: 1;

   }



   .tags-new input[type="text"]

   {

     border:0;

       margin: 0;

       padding: 0 0 0 3px;

       font-size: 14px;

       margin-top: 5px;

     background:transparent;

   }



   .tags-new input[type="text"]:focus

   {

         outline:none;

   } </style>



    <span id="wrapper">

     <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

      <ul class="tags-input" id="tags-input_ka" style="height:auto; width: 100%">

       <li class="tags" id="tags_ka" style="background-color:#B9B8B8; color:#000000;">TAGS <i class="fa fa-times"></i></li>


       @foreach(explode(',', $newArticles->tags_ka) as $tag)


           @if(!empty($tag))


    <li class="tags tag-item" id="tags_ka"><span>{{ $tag }}</span><i class="fa fa-times"></i></li>

       @endif
       @endforeach

       <li class="tags-new" id="tags-new_ka"  style="color:#D70003;">
         <input type="text" id="tags_ka">
         <input type="hidden" name="tags_ka" id="save_tags_ka" value="{{ $newArticles->tags_ka }}"/>
       </li>


     </ul>

   </span> </soan>

    <!-- ქართული თეგების დასასრული -->

            </div>



            <div class="form-group">


                <select name="author_id" class="form-control" id="author_ka">
                    <option selected="true" disabled="disabled">ავტორი KA</option>

                    @foreach ($full_author as $authors)
                        <option value="{{ $authors->id }} " @if ($authors->id === $newArticles->author_id) selected @endif()>
                            {{ $authors->author_ka }} </option>
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
                <label>აღწერა KA</label> <br>
                <textarea name="description_ka" id="description_ka" style="width: 600px; height: 300px;">{{ $newArticles->description_ka }}</textarea>

                <script>
                    ClassicEditor
                        .create(document.querySelector('#description_ka'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </div>

<br>
            <div>
                <label>Full KA </label> <br>

                <textarea name="full_ka" id="full_ka"> {{ $newArticles->full_ka }} </textarea>

                <script>
                    CKEDITOR.replace( 'full_ka' );
            </script>
            </div>

    </div>
{{-- ქართულის დასასრული --}}


    <div class="tab-pane fade" id="english" role="tabpanel" aria-labelledby="english-tab">

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title_en" value="{{ $newArticles->title_en }}" class="form-control"
                aria-describedby="emailHelp" placeholder="TITLE">
        </div>








<br><br>
        <div class="form-group">

            <select name="author_id" class="form-control" id="author_en">
                <option selected="true" disabled="disabled">ავტორი EN</option>

                @foreach ($full_author as $authors)
                    <option value="{{ $authors->id }} " @if ($authors->id === $newArticles->author_id) selected @endif()>
                        {{ $authors->author_en }} </option>
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


        <div class="form-group">

            <!--START TAGS English  -->

<span style="position:relative; ">



<script type="text/javascript"> function existingTagEn(text)

{

   var existing = false,

       text = text.toLowerCase();



   $("#tags_en").each(function(){

       if ($(this).text().toLowerCase() == text)

       {

           existing = true;

           return "";

       }

   });



   return existing;

}

$(document).on("click", ".fa.fa-times", function(){
  var tagItem = $(this).parent('.tag-item');
  var text = tagItem.find('span').text().trim();
  var tags_str = $('#save_tags_ka').val();
  tags_str = tags_str.replace(','+text, '');
  $('#save_tags_ka').val(tags_str);
  tagItem.remove();
});

$(function(){

 $("#tags-new_en input").focus();



 $("#tags-new_en input").keyup(function(){



       var tag = $(this).val().trim(),

       length = tag.length;



       if((tag.charAt(length - 1) == ',') && (tag != ","))

       {

           tag = tag.substring(0, length - 1);



           if(!existingTagEn(tag))

           {

               $('<li class="tags tag-item" id="tags_en"><span>' + tag + '</span><i class="fa fa-times"></i></li>').insertBefore($("#tags-new_en"));

               $('#save_tags_en').val($('#save_tags_en').val() + "," + tag)

               $(this).val("");

           }

           else

           {

               $(this).val(tag);

           }

       }

   });



 $(document).on("click", "#tags_en svg", function(){

     var text = $(this).parent().text();

     var tags_str = $('#save_tags_en').val();

     tags_str = tags_str.replace(','+text, '');

     $('#save_tags_en').val(tags_str);

   $(this).parent("li").remove();



 });



});

                                </script>



<span id="wrapper">

 <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <ul class="tags-input" id="tags-input_en" style="height:auto; width: 100%">

   <li class="tags" id="tags_en" style="background-color:#B9B8B8; color:#000000;">TAGS <i class="fa fa-times"></i></li>


   @foreach(explode(',', $newArticles->tags_en) as $tag)


       @if(!empty($tag))


   <li class="tags tag-item" id="tags_en"> {{ $tag }}  <i class="fa fa-times"></i></li>

   @endif
   @endforeach

   <li class="tags-new" id="tags-new_en"  style="color:#D70003;">
     <input type="text" id="tags_en">
     <input type="hidden" name="tags_en" id="save_tags_en" value="{{ $newArticles->tags_en }}"/>
   </li>


 </ul>

</span> </soan>

<!--END OF TAGS -->

        </div>

            <div>
                <label>აღწერა EN </label> <br>
                <textarea name="description_en" id="description_en" placeholder="Description English" style="width: 200px; height: 300px;">{{ $newArticles->description_en }}</textarea>

                <script>
                    ClassicEditor
                        .create(document.querySelector('#description_en'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </div>




            <div>
                <br>
                <label> Full EN </label>
                <textarea name="full_en" id="full_en">{{ $newArticles->full_en }}</textarea>

                <script>
                    CKEDITOR.replace( 'full_en' );
            </script>
            </div>

    </div>

    {{-- ინგლისურის დასასრული --}}
    <div class="tab-pane fade" id="russian" role="tabpanel" aria-labelledby="russian-tab">Russky karabl</div>
  </div>











            <br>
            <button type="submit" class="btn btn-primary">დამახსოვრება</button>
    </form>
@endsection
