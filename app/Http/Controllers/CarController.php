<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Car;
use Symfony\Contracts\Service\Attribute\Required;
use App\Traits\Common; 


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
        return view('addCar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages=[
            'carTitle.required'=>'Title is required',
            'description.required'=> 'should be text',
        ];

        $data = $request->validate([
            'carTitle'=>'required|string',
            'description'=>'required|string',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ], $messages);

        $fileName = $this->uploadFile($request->image, 'uploads');
        $data['image']= $fileName;
        $data['published'] = isset($request['published']);
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
        return view('updateCar',compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cars  = Car::findOrFail($id);

        $messages=[
            'carTitle.required'=>'Title is required',
            'description.required'=> 'should be text',
        ];

        $data = $request->validate([
            'carTitle'=>'required|string',
            'description'=>'required|string',
            'image' => 'sometimes|nullable|file|mimes:png,jpg,jpeg|max:2048',
        ], $messages);

        $data['published'] = isset($request['published']);
        if($request->hasFile('image')){
            $data['image']= $this->uploadFile($request->image, 'uploads');
            @unlink(public_path($cars->image));    
        }        
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
