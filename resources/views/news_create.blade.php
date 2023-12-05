
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Car</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>

<div class="container">
  <h2>Create News</h2>
  @if(session('success'))
    <div>
        {{  session('success') }}
    </div> 
  @endif
  <a href="/news">News</a>
  <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
  @csrf

    <div class="form-group">
      <labphp el for="title">Title:</label>
      <input type="text" class="form-control" value="{{  old('title') }}"  id="title" placeholder="Enter title" name="title">
      @error('title')
        <span style="color:red"> {{ $message }}</span>  
      @enderror
    </div>
    
    <div class="form-group">
      <labphp el for="author">author:</label>
      <input type="text" class="form-control" value="{{  old('author') }}"  id="author" placeholder="Enter author" name="author">
    @error('author')
        <span style="color:red"> {{ $message }}</span>  
      @enderror
    </div>
    
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control" rows="5" id="content" name="content">{{  old('content') }}</textarea>
        @error('content')
          <span style="color:red"> {{ $message }}</span>  
        @enderror
      </div> 
    <div class="radiobox">
      <label><input type="radio" value="1" name="published"> Published</label>
    </div>
     
    <div class="radiobox">
      <label><input type="radio" checked value="0" name="published">Un Published</label>
    </div>
    
    @error('published')
      <span style="color:red"> {{ $message }}</span>  
    @enderror
    
    <div class="form-group">
      <labphp el for="image">image:</label>
      <input type="file" class="form-control" value="{{  old('image') }}"  id="image" placeholder="Enter image" name="image">
    @error('image')
        <span style="color:red"> {{ $message }}</span>  
      @enderror
    </div>
    <button type="submit" class="btn btn-default">Create</button>
  </form>
</div>

</body>
</html>
