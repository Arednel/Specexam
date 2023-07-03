 <!DOCTYPE html>

 <html>

 <head>
     <title>Результат</title>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
 </head>

 <style>
     body {
         margin-left: 60px;
     }

     .div-center {
         text-align: center;
         margin-top: 15px;
         margin-bottom: 15px;
     }

     .div-right {
         text-align: right;
         margin-bottom: 15px;
     }

     .div-main-text {
         position: relative;
         width: 105%;
         right: 25px;
         margin-bottom: 60px;
     }

     .column-one {
         width: 50%;
         position: relative;
     }

     .column-two {
         width: 30%;
         position: relative;
         left: 340px;
         bottom: 45px;
     }

     .column-three {
         position: relative;
         width: 30%;
         left: 420px;
         bottom: 100px;
         text-align: right;
     }

     body {
         font-size: 16px;
     }
 </style>

 <body>

     <div class='div-center'>
         <img src="{{ public_path('img/logo.png') }}">
     </div>
     <div class='div-center'>
         <b>{{ __('Справка') }} №{{ $result_id }}</b>
     </div>
     <div class='div-center'>
         <b> {{ __('о прохождении претендентом собеседования') }}</b>
     </div>

     <div class='div-right'>
         {{ $date }}
     </div>

     <div class='div-main-text'>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {!! __('Выдана <i>full_name</i>', ['full_name' => $full_name]) !!}
         <br><br>
         {!! $pass !!}
     </div>

     <div class='qr-with-text'>
         <div class='column-one'>
             <b>
                 {{ __('Ответственный секретарь приемной комиссии') }}
             </b>
         </div>

         <div class="column-two">
             <img src="data:image/png;base64, {{ $qr_image }} ">
         </div>

         <div class="column-three">
             <b>Исабаева Д.Н.</b>
         </div>
     </div>
 </body>

 </html>
