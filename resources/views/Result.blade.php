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
         margin-bottom: 120px;
     }


     .column-one {
         width: 50%;
         position: relative;
         top: 35px;
     }

     .column-two {
         width: 30%;
         position: relative;
         left: 270px;
         bottom: 80px;
     }

     .column-three {
         position: relative;
         left: 420px;
         bottom: 112px;
     }
 </style>

 <body>

     <div class='div-center'>
         <img src="{{ public_path('img/logo.png') }}">
     </div>
     <div class='div-center'>
         <b>{{ __('СЕРТИФИКАТ') }}</b>
     </div>

     <div class='div-center'>
         №{{ $result_id }}
     </div>

     <div class='div-right'>
         {{ $date }}
     </div>

     <div class='div-main-text'>
         &nbsp;&nbsp;&nbsp;&nbsp; {!! __(
             'дан <i>full_name</i> в том, что он(а) в составе абитуриентов КазНПУ им.Абая прошёл(ла) собеседование и получил(а)',
             ['full_name' => $full_name],
         ) !!}
         @if ($score > 9)
             <b>{{ __('«допуск»') }}</b>
         @else
             <b>{{ __('«недопуск»') }}</b>
         @endif

         {{ __('для поступления на платной основе.') }}
     </div>

     <div class='qr-with-text'>
         <div class='column-one'>
             <b>
                 {{ __('Ответственный секретарь приемной комиссии') }}
             </b>
         </div>

         @php
             //QrCode generation
             $string = 'Name：Даража Исабаева
Work：Ответственный секретарь приемной комиссии
Company：КазНПУ имени Абая
Phone：8 727 291 57 68
Email：
Address：';
             
             $qr = QrCode::size(120)
                 ->encoding('UTF-8')
                 ->generate($string);
             
             //To image (for PDF file)
             $qr_image = base64_encode($qr);
         @endphp
         <div class="column-two">
             <img src="data:image/png;base64, {{ $qr_image }} ">
         </div>
         <div class="column-three">
             <b>Д. Исабаева</b>
         </div>
     </div>
 </body>

 </html>
