@extends('admin/layout')
@extends('admin/menu')

@section('menu')
<h1>Device Usage Statistics</h1>
@php
    $totalUsers = 0;
    $mobileUsers = 0;
    $tabletUsers = 0;
    $desktopUsers = 0;

    if (isset($_COOKIE['device_type'])) {
        $deviceType = $_COOKIE['device_type'];
        $totalUsers = 1;

        if ($deviceType === 'Mobile') {
            $mobileUsers = 1;
        } elseif ($deviceType === 'Tablet') {
            $tabletUsers = 1;
        } else {
            $desktopUsers = 1;
        }
    }

    $mobilePercentage = ($mobileUsers / $totalUsers) * 100;
    $tabletPercentage = ($tabletUsers / $totalUsers) * 100;
    $desktopPercentage = ($desktopUsers / $totalUsers) * 100;
@endphp

<p>Mobile: {{ $mobilePercentage }}%</p>
<p>Tablet: {{ $tabletPercentage }}%</p>
<p>Desktop: {{ $desktopPercentage }}%</p>


<style>



    #indexs, #indexs ul{

     list-style-type:none;

    list-style-position:outside;

     padding:0px;

      background-color:#343a40;

      width:260px;





    }



    #indexs a{

    display:block;

     color:#FFFFFF;

     text-decoration:none;

     padding:10px;

     font-stretch:extra-expanded;

         transition: color 0.5s, background 0.5s;

        -webkit-transition: color 0.5s, background 0.5s;

        font-size:14px;



    }



    #indexs a:hover{

    background-color:#676767;

      padding:10px;

      color:#FFFFFF;



    }



    #indexs li{

    float:left;

    position:relative;



     padding:0px;

    }



    #indexs ul {

    position:absolute;

    display:none;

     }



    #indexs li ul a{



    float:left;



     }



    #indexs ul ul{





    }



    #indexs li ul ul {

    left:12em;



     }



    #indexs li:hover ul ul, #indexs li:hover ul ul ul, #indexs li:hover ul ul ul ul{

    display:none;

     }

    #indexs li:hover ul, #indexs li li:hover ul, #indexs li li li:hover ul, #indexs li li li li:hover ul{

    display:block;

     }

    </style>



      <div style="background-color:#F0F0F0; border:1px solid #DCDCDC; padding-left:13px; padding-top:11px; padding-bottom:5px;  margin-bottom:15px;">

      <div id="indexs" style="color:#FFFFFF; display:inline-block; margin-top:2px;">

       <a href="{{ route('admin.article.add') }}"> <span style="font-size:24px; position:relative; font-weight:bold; margin-right:10px;

       top:0px;"> +</span> <span style="position:relative; top:-3px;"> ახალი მასალის დამატება </span> </a>  </div>







       <div style="position:relative; display:inline-block; margin-left:50px;"> <form action="{{ route('search_admin') }}" method="get">




          <p>

            <input value="" type="text" placeholder="From" name="from_date" id="from_date" readonly size="6" />

            -დან  &nbsp;

            <input value="" type="text" placeholder="To" name="to_date" readonly id="to_date" size="6"/>

            -მდე

            &nbsp; &nbsp;



            <input type="submit" id="rame" name="type" value="თარიღით ძიება" style="width: 165px; text-align: left"><i class="fa fa-arrow-right" style="position: relative; left: -22px;"></i>

        </div>

        <script>

     $( function() {

        $("#from_date").datepicker({

          changeMonth: true,

          changeYear: true,

          altFormat: "yyyy/mm/dd",

          dateFormat: "yy/mm/dd",

          maxDate: "+0Y",

            onSelect: function(selected) {

               $("#from_date").datepicker("option","maxDate", selected)

            }

        });

        $("#to_date").datepicker({

          changeMonth: true,

          changeYear: true,

          altFormat: "yyyy/mm/dd",

          dateFormat: "yy/mm/dd",

          maxDate: "+0Y",

            onSelect: function(selected) {

               $("#to_date").datepicker("option","maxDate", selected)

            }

        });

      } );

      </script>

      </form>  </div>

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">სათაური</th>
        <th scope="col">სურათი</th>
        <th scope="col">კატეგორიები</th>
        <th scope="col">EDIT</th>
        <th scope="col">DELETE</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article )
       <tr>
        <th scope="row">
             {{ $loop->index+1 }}

         </th>
        <td> {{ $article->title_ka }}</td>
        <td> <img src="{{ asset($article->upload) }}" id="im123" class="cover123"> </td>
        <td>
            {{ @$article->category->name_ka }} </td>

            <td> <a href="{{ route('admin.articles.edit', ['id' => $article->id]) }}"> ჩასწორება </a>
            </td>
            <td> <a href="{{ Route('admin.article.delete', ['id'=>$article->id])}}" onclick="return confirm('Are you sure?')">
                <button type="button" class="btn btn-danger">წაშლა</button> </a>
            </td>
      </tr>

@endforeach
    </tbody>
  </table>
<style>

.page-item.active .page-link

{ background-color: #343a40; border-block-color: #343a40; border: 1px solid #343a40 }

.page-link
{
    color:#343a40;
 }



</style>
  {{ $articles->links() }}

@endsection

