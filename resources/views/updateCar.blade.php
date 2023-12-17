<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>

<div class="container">
    <h2>Update Car</h2>
    <form action="{{ route('updateCar',$car->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="carTitle" value="{{ $car->carTitle }}">
        @error('carTitle')
            <div class="alert alert-warning">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description">{{ $car->description }}</textarea>
         @error('description')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <label for="shortDescription">Short Description:</label>
            <input type="text" class="form-control" id="shortDescription" placeholder="Enter shortDescription" name="shortDescription" value="{{ $car->shortDescription }}">
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
                    <option value="{{ $category->id }}"  {{ $category->id == $car->category_id ? 'selected' : ''  }}>{{ $category->categoryName }}</option>
                @endforeach

            </select>
            @error('category_id')<div class="alert alert-warning">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="published" @checked($car->published)>Published</label>
        </div>

        <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ $car->image }}">
            @error('image')
                {{ $message }}
            @enderror
        <button type="submit" class="btn btn-default">Update</button>
    </form>
</div>
</body>
</html>
