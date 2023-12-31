<!DOCTYPE html>
<html lang="en">
<head>
  <title>Car List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>

<div class="container">
  <h2>List</h2>
  <p>The .table-hover class enables a hover state on table rows:</p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Published</th>
        <th>Edit</th>
        <th>Show</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
@foreach($cars as $car)        
      <tr>
        <td>{{ $car->carTitle }}</td>
        <td>{{ $car->description }}</td>
        <td>
            @if($car->published)
                Yes
            @else
                No
            @endif
        </td>
        <td><a href="editCar/{{ $car->id }}">Edit</a></td>
        <td><a href="carDetails/{{ $car->id }}">Show</a></td>
        <td><a href="deleteCar/{{ $car->id }}">Delete</a></td>
      </tr>
@endforeach     
    </tbody>
  </table>
</div>

</body>
</html>
