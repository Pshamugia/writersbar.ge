@extends('admin/layout')
@extends('admin/menu')

@section('menu')
    <div> <a href="{{ route('admin.article') }}"> HOME PAGE </a> /
        <a href="{{ route('admin.article.add') }}"> ახალი მასალის დამატება </a> /
        <a href="{{ route('admin.category.index') }}"> კატეგორიები </a> /
        <a href="{{ route('admin.gallery') }}"> გალერეა </a>
    </div>


    <form action="{{ route('admin.gallery.update', ['id'=>$gallery->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="hash" value="{{ $hash }}"/>
        <div class="form-group">
            <label>სათაური</label>
            <input type="text" name="title" value="{{ $gallery->title }}" class="form-control" aria-describedby="emailHelp" placeholder="სათაური">
        </div>



        <div class="form-group">
            <label>გამოქვეყნების თარიღი</label>
            <input type="date" name="year" value="{{ Carbon\Carbon::parse($gallery->year)->format('Y-m-d') }}" class="form-control" aria-describedby="emailHelp"
                placeholder="გამოშვების წელი">
        </div>


        <div class="form-group">
            <label>saTavo სურათი</label>
            <img src="{{ asset($gallery->upload1) }}" width="60px"><br>
            <input type="file" name="upload" class="form-control" aria-describedby="emailHelp" placeholder="ყდა">
        </div>


        <div class="form-group">
        @foreach ($images as $image)

<img src="{{ asset($image->upload)}}" width="50px">

<input type="checkbox" name="images[]" value="{{ $image->id}}">
<br><br>

        @endforeach

        </div>

        <div class="form-group">
            <label>სურათი</label>


            <!--Image Uploader Jquery-->



            <!-- Fine Uploader New/Modern CSS file

        ====================================================================== -->

            <link href="{{ asset('fine-uploader/fine-uploader-new.css') }}" rel="stylesheet">



            <!-- Fine Uploader JS file

        ====================================================================== -->

            <script src="{{ asset('fine-uploader/fine-uploader.js') }}"></script>



            <!-- Fine Uploader Thumbnails template w/ customization

        ====================================================================== -->

            <script type="text/template" id="qq-template-manual-trigger">

        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here" style="position:relative; width:500px; margin-left:20px">

            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">

                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>

            </div>

            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>

                <span class="qq-upload-drop-area-text-selector"></span>

            </div>

            <div class="buttons">

                <div class="qq-upload-button-selector qq-upload-button">

                    <div> მონიშნე&nbsp;სურათები</div>

                </div>





<?php /*?>	  <button type="button" id="trigger-upload" class="btn btn-primary" style="position:relative; clear:both; top

		  -20px;">

                    <i class="icon-upload icon-white"></i> ატვირთე

                </button>   <?php */?>

            </div>





            <span class="qq-drop-processing-selector qq-drop-processing">

                <span>Processing dropped files...</span>

                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>

            </span>

            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">

                <li>

                    <div class="qq-progress-bar-container-selector">

                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>

                    </div>

                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>

                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>

                    <span class="qq-upload-file-selector qq-upload-file"></span>

                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>

                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">

                    <span class="qq-upload-size-selector qq-upload-size"></span>

                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>

                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>

                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>

                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>

                </li>

            </ul>



            <dialog class="qq-alert-dialog-selector">

                <div class="qq-dialog-message-selector"></div>

                <div class="qq-dialog-buttons">

                    <button type="button" class="qq-cancel-button-selector">Close</button>

                </div>

            </dialog>



            <dialog class="qq-confirm-dialog-selector">

                <div class="qq-dialog-message-selector"></div>

                <div class="qq-dialog-buttons">

                    <button type="button" class="qq-cancel-button-selector">No</button>

                    <button type="button" class="qq-ok-button-selector">Yes</button>

                </div>

            </dialog>



            <dialog class="qq-prompt-dialog-selector">

                <div class="qq-dialog-message-selector"></div>

                <input type="text">

                <div class="qq-dialog-buttons">

                    <button type="button" class="qq-cancel-button-selector">Cancel</button>

                    <button type="button" class="qq-ok-button-selector">Ok</button>

                </div>

            </dialog>

        </div>

    </script>



            <style>
                #trigger-upload {

                    color: white;

                    background-color: #00ABC7;

                    font-size: 14px;

                    padding: 10px 20px;

                    background-image: none;

                    border: 0px;

                }



                #fine-uploader-manual-trigger .qq-upload-button {

                    margin-right: 15px;

                }



                #fine-uploader-manual-trigger .buttons {

                    width: 36%;

                }



                #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {

                    width: 60%;

                }
            </style>





            <!-- Fine Uploader DOM Element

        ====================================================================== -->

            <div id="fine-uploader-manual-trigger"></div>



            <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template

        ====================================================================== -->

            <script>
                var manualUploader = new qq.FineUploader({
                    element: document.getElementById('fine-uploader-manual-trigger'),

                    template: 'qq-template-manual-trigger',

                    request: {

                        endpoint: '{{ route('admin.gallery.upload') }}?hash={{ $hash }}',
                        customHeaders: {
                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }

                    },

                    thumbnails: {

                        placeholders: {

                            waitingPath: 'fine-uploader/placeholders/waiting-generic.png',

                            notAvailablePath: 'fine-uploader/placeholders/not_available-generic.png'

                        }

                    },

                    autoUpload: true,

                    validation: {

                        allowedExtensions: ['jpeg', 'JPEG', 'jpg', 'JPG', 'gif', 'GIF', 'PNG', 'png'],

                        itemLimit: 100

                    },

                    debug: true

                });



                qq(document.getElementById("trigger-upload")).attach("click", function() {

                    manualUploader.uploadStoredFiles();

                });
            </script>





            <!--END of Image Uploader Jquery-->

        </div>





        <br>
        <button type="submit" class="btn btn-primary">დამახსოვრება</button>
    </form>
@endsection
