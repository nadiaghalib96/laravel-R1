<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Traits\Common;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class CarController extends Controller
{
    use Common;
    private $columns = ['carTitle', 'description','published'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::get();
        return view('cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'categoryName')->get();
        return view('addCar', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);

        Car::create($data);

        return 'done';





        // $cars = new Car;
        // $cars->carTitle = $request->title;
        // $cars->description = $request->description;




        // if(isset($request->published)){
        //     $cars->published = true;
        // }else{
        //     $cars->published = false;
        // }
        // $cars->save();


        // Car::create($data);
        // return redirect('cars');

        // return "Car data added successfully";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        return view('carDetails',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        $categories = Category::select('id', 'categoryName')->get();
        return view('updateCar',compact('car','categories'  ));
    }

    public function validated(Request $request,$old_image = null) {

        $messages=[
            'carTitle.required'=>'Title is required',
            'description.required'=> 'should be text',
        ];

        $data = $request->validate([
            'carTitle'=>'required|string',
            'description'=>'required|string',
            'shortDescription'=>'required|string',
            'category_id'=>'required|numeric|exists:categories,id',
            'image' => 'sometimes|nullable|file|mimes:png,jpg,jpeg|max:2048',
        ], $messages);

        $data['published'] = isset($request['published']);
        if($request->hasFile('image')){
            $data['image']= $this->uploadFile($request->image, 'uploads');
            if($old_image){
                @unlink(public_path($old_image));
            }
        }
        return $data;
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cars  = Car::findOrFail($id);
        $data = $this->validated($request,$cars->image);
        $cars->update($data);

        return 'done ';


        // $data = $request->only($this->columns);
        // $data['published'] = isset($data['published'])? true:false;

        // Car::where('id', $id)->update($data);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Car::where('id', $id)->delete();
        return redirect('cars');
    }


    public function trashed(){
        $cars = Car::onlyTrashed()->get();
        return view('trashed' , compact('cars'));
    }

    public function restore(string $id) : RedirectResponse{
        Car::where('id', $id)->restore();
        return redirect('cars');
    }
    public function delete(string $id) : RedirectResponse{
        Car::where('id', $id)->forceDelete();
        return redirect('cars');
    }
}
