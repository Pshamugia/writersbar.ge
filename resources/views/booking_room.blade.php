@extends('layout')


@section('menu')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="container ">
    <div class="contact-form col-12 col-md-8 col-lg-6 col-xl-5 " style="padding-bottom: 100px">
        <div id="success">
            <br> <br>

            Hello  {{ Auth::user()->name }} <i class="fa-regular fa-heart"></i>
            <br> <br>
            Be carefull, please. All fields must be filled in order to reserve a table at Writers Bar.
            <br><br><br>
        </div>
        <form name="sentMessage" id="contactForm" role="form"  method="post" action="{{ route('booking.send') }}">

           @csrf


           <div class="control-group ">
            <input type="text" class="form-control" name="name" placeholder="Name" required="required" data-validation-required-message="Please enter your name" />
            <p class="help-block text-danger"></p>

        </div>


            <div class="control-group">
                <input type="email" class="form-control" name="email"  placeholder="Email" required="required" data-validation-required-message="Please enter your email" />
                <p class="help-block text-danger"></p>
            </div>


             <div class="control-group">
                <input type="number" class="form-control" name="phone"  placeholder="Phone" required="required" data-validation-required-message="Please enter your phone" />
                <p class="help-block text-danger"></p>
            </div>




            <div class="control-group">
<input type="text" readonly name="news_date" id="news_date" class="form-control" placeholder="Choose date" required="required" data-validation-required-message="Please enter a day" / >
<script>
$( function() {
$("#news_date").datepicker({
changeMonth: true,
changeYear: true,
altFormat: "yyyy-mm-dd",
dateFormat: "yy-mm-dd",
minDate: "+0Y",
onSelect: function(selected) {
$("#news_date").datepicker("option","maxDate", selected)
}
});
} );
</script>
<p class="help-block text-danger"></p>
            </div>


            <div class="control-group">
                <select name="hour" class="form-control" name="hour" placeholder="hour" required="required" data-validation-required-message="Please enter hour">
                    <option value="" disabled selected hidden>Choose time </option>
                    <option value="13:00" name="13:00">13:00</option>
                    <option value="14:00" name="14:00">14:00</option>
                    <option value="15:00" name="15:00">15:00</option>
                    <option value="16:00" name="16:00">16:00</option>
                    <option value="17:00" name="17:00">17:00</option>
                    <option value="18:00" name="18:00" >18:00</option>
                    <option value="19:00" name="19:00">19:00</option>
                    <option value="20:00" name="20:00">20:00</option>
                    <option value="21:00" name="21:00">21:00</option>
                    <option value="22:00" name="22:00">22:00</option>
                    <option value="23:00" name="23:00">23:00</option>

                </select>
                <p class="help-block text-danger"></p>
            </div>





            <div class="control-group">

                <textarea class="form-control" placeholder="Message" name="message" required="required" data-validation-required-message="Please enter your message"></textarea>
                <p class="help-block text-danger"></p>
            </div>
            @if(isset($_GET['result']) && (int)$_GET['result'] === 2)
            <div class="alert alert-success alert-dismissible" role="alert">
                     <i class="fa fa-times"></i>
                </button>
                <strong> Something went wrong !</strong> {{ session('success') }}
            </div>            @endif


            @if(isset($_GET['result']) && (int)$_GET['result'] === 1)
            <div class="alert alert-success alert-dismissible" role="alert">
                     <i class="fa fa-times"></i>
                </button>
                <strong> Your booking has been submitted!</strong> {{ session('success') }}
            </div>                        @endif
            <div>
                <button class="btn" name="submit" style="background-color: #ef6603" type="submit" id="sendMessageButton">Book now</button>
            </div>
        </form>
    </div>
</div>


@endsection
