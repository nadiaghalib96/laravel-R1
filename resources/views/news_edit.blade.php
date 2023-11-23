
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Car</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Create News</h2>
  @if(session('success'))
    <div>
        {{  session('success') }}
    </div> 
  @endif
  <form action="{{  route('updateNews',$news->id) }}" method="POST">
  @csrf
  @method('put')

    <div class="form-group">
      <labphp el for="title">Title:</label>
      <input type="text" class="form-control"  id="title" placeholder="Enter title" name="title" value="{{ $news->title }}">
    </div>
    
    <div class="form-group">
      <labphp el for="author">author:</label>
      <input type="text" class="form-control"  id="author" placeholder="Enter author" name="author" value="{{ $news->author }}">
    </div>
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control" rows="5" id="content" name="content">{{ $news->content }}</textarea>
      </div> 
    <div class="radiobox">
      <label><input type="radio" value="1" name="published" @checked($news->published)> Published</label>
    </div>
     
    <div class="radiobox">
      <label><input type="radio" value="0" name="published" @checked(!$news->published)>Un Published</label>
    </div>
    <button type="submit" class="btn btn-default">Update</button>
    
          <a href ='../news' > Back</a>

  </form>
</div>

</body>
</html>
