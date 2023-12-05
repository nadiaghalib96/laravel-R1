<!DOCTYPE html>
<html lang="en">
<head>
  <title>News table</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
<div class="container">
  <h2>News List</h2>
  @if(session('success'))
    <div>
        {{  session('success') }}
    </div> 
  @endif
  <a href="/news">News</a>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Content</th>
        <th>Image</th>
        <th>Published</th>
        <th>Edit</th>
        <th>Show</th>
         <th>Restore</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    @foreach($news as $new)
      <tr>
        <td>{{ $new->title }}</td>
        <td>{{ $new->author }}</td>
        <td>{{ $new->content }}</td>
        <td><img src="{{ asset($new->image) }}" width="100  "></td>
        <td>{{ $new->published ? 'YES✅' : 'NO❌' }}</td>
         <td><a href="/editNews/{{ $new->id }}">Edit</a></td>
             <td><a href="/newsDetail/{{ $new->id }}">Show</a></td>
             <td><a href="/restoreNews/{{ $new->id }}">Restore</a></td>
             <td><a href="/deleteNews/{{ $new->id }}">Delete</a></td>


      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
