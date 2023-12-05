 <html>
 <head>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 </head>

 <body>
 title :{{ $news->title }}
 <br>
author:{{ $news->author }}
<br>
Content: {{ $news->content }}

 </body>




 </html>