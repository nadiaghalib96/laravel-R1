<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>

<div class="container">
  <h2>Upload file image</h2>
  <form class="form-horizontal" action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label class="control-label col-sm-2" for="image">Image:</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="image" name="image">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
