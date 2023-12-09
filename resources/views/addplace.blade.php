<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Place</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>

<div class="container">
    <h2>Add Place</h2>

  @if(session('success'))
  <div>
      {{  session('success') }}
  </div>
@endif
    <form action="{{route('storeplace')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ old('title') }}">
            @error('title')
            <div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price From:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price_from" value="{{ old('price_from') }}">
         @error('price_from')
            <div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>

         <div class="form-group">
            <label for="price">Price To:</label>
            <input type="number" class="form-control" id="price_to" placeholder="Enter Price" name="price_to" value="{{ old('price_to') }}">
         @error('price_to')
            <div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
            <div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">

            @error('image')
            <div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-default">Add</button>
    </form>
</div>

</body>
</html>

