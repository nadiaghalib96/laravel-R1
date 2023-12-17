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
    <h2>Add Car</h2>
    <form action="{{route('storeCar')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="carTitle" value="{{ old('carTitle') }}">
            @error('carTitle')
            <div class="alert alert-warning"><div class="alert alert-warning">
                {{ $message }}
            </div>
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')<div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="shortDescription">Short Description:</label>
            <input type="text" class="form-control" id="shortDescription" placeholder="Enter shortDescription" name="shortDescription" value="{{ old('shortDescription') }}">
            @error('description')<div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Select Category:</label>
            <select name="category_id" id="category_id">
                <option value="">Select Category</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : ''  }}>{{ $category->categoryName }}</option>
                @endforeach

            </select>
            @error('category_id')<div class="alert alert-warning">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
            @error('image')<div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="published"> Published</label>
        </div>
        <button type="submit" class="btn btn-default">Add</button>
    </form>
</div>

</body>
</html>

