<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\NewsController;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Return_;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/','welcome');

Route::get('/about', function () {
    return ' <h1> About page </h1> ' ;
});

Route::get('/contact-us', function () {
    return ' <h1> Contact page </h1> ' ;
});

Route::get('traning/{page?}',function($page='traning'){
    return ucfirst($page)." Page";
})->whereIn('page',['hr','ICT','Logistics','Marketing']);

Route::get('support/{page?}',function($page='support'){
    return ucfirst($page)." Page";
})->whereIn('page',['chat','call','ticket']);

// Route::get('test', function () {

//     return ' <h1> first message on laravel </h1> ' ;
//    });





// Route::get('/user/{name}/{age?}', function ($name , $age=0) {

//    $message = ' <h1> The user name is: ' . $name ;
//     if($age > 0){
//         return $message.= ' ' . 'and age is '. $age;
//     }
//     return $message  . '</h1>';
//      //regularex
//    })->whereIn('name',['nada','Nadia']);

    //->where (['age' => '[0-9]+' , 'name'=>'[a-zA-Z0-9]+']);
   //->whereAlpha('name');
   //->whereNumber('age');




// Route::prefix('support') ->group(function (){
//     Route::get('/', function(){
//         return 'support home page';
//     });

//     Route::get('chat', function(){
//         return 'chat page';
//     });

//     Route::get('call', function(){
//         return 'call page';
//     });

//     Route::get('ticket', function(){
//         return 'ticket page';
//     });
// });


// Route::prefix('traning') ->group(function (){

//     Route::get('/', function(){
//         return 'traning home page';
//     });

//     Route::get('HR', function(){
//         return 'HR page';
//     });

//     Route::get('ICT', function(){
//         return 'ICT page';
//     });

//     Route::get('Logistics', function(){
//         return 'Logistics page';
//     });
// });


//   Route::fallback(function(){

//     return redirect('/') ;

//   });


// Route::get('cv', function () {

//     return view ('cv') ;
//    });


//    Route::get('login', function () {

//     return view ('login') ;
//    });

//    Route::post('receive', function () {

//     return'Your Data received';
//    })->name('receive');

//    Route::get('test1',[ExampleController::class,'test1']);



//task 3

Route::get('car', function () {

return view('car')->name('car.success');
});

Route::post('success', function (Request $request) {
    $title = request()->get('title');
    $price = request()->get('price');
    $desc = request()->get('desc');
    $publiched = request()->get('remember');
    $message = ' <p> Title is: ' . $title . '</br>'.'Price is:' . $price .'</br>'. 'Description is :' . $desc .'</br>'. 'remember :'. $publiched ;

    return   $message . '</p>' ;

})->name('success');

Route::get('news' , [NewsController::class,'index']);

Route::get('news/create' , [NewsController::class,'create'])->name('news.create');
Route::get('editNews/{id}' , [NewsController::class,'edit'])->name('editNews');
Route::get('newsDetail/{id}' , [NewsController::class,'show'])->name('newsDetail');
Route::put('updateNews/{id}' , [NewsController::class,'update'])->name('updateNews');
Route::post('news' , [NewsController::class,'store'])->name('news.store');
Route::get('trashedNews',[NewsController::class, 'trashed']);
Route::get('restoreNews/{id}',[NewsController::class, 'restore']);
Route::get('destoryNews/{id}' , [NewsController::class,'destory'])->name('destoryNews');
Route::get('deleteNews/{id}',[NewsController::class, 'delete'])->name('deleteNews');

// car modual
Route::post('storeCar',[CarController::class, 'store'])->name('storeCar');

Route::get('addCar',[CarController::class, 'create']);
Route::get('trashed',[CarController::class, 'trashed']);
Route::get('restoreCar/{id}',[CarController::class, 'restore']);
Route::get('delete/{id}',[CarController::class, 'delete']);


Route::get('cars', [CarController::class, 'index'])->middleware('verified');

Route::get('editCar/{id}', [CarController::class, 'edit']);

Route::get('deleteCar/{id}', [CarController::class, 'destroy']);

Route::get('carDetails/{id}', [CarController::class, 'show'])->name('carDetails');

Route::put('updateCar/{id}', [CarController::class, 'update'])->name('updateCar');

Route::get('showUpload',[ExampleController::class, 'showUpload']);

Route::post('upload',[ExampleController::class, 'upload'])->name('upload');
Route::get('session',[ExampleController::class, 'mySession'])->name('session');



Route::get('home',[PlaceController::class, 'index']);
Route::get('login',[ExampleController::class, 'login']);
Route::get('place',[ExampleController::class, 'place']);
Route::get('blog',[ExampleController::class, 'blog']);
Route::post('storeplace',[PlaceController::class, 'store'])->name('storeplace');
Route::get('addplace',[PlaceController::class, 'create']);
Route::get('blog1',[ExampleController::class, 'blog1']);


// Route::resource('news',NewsController::class);
/*
    news          -> index      -> get
    news/create   -> create     -> get
    news          -> store      -> post
    news/{id}     -> show       -> get
    news/{id}/edit-> edit       -> get
    news/{id}     -> update     -> PUT|PATCH
    news/{id}     -> destroy    -> DELETE
*/

Auth::routes(['verify'=>true]);

Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index'])->name('home2');



    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){
            Route::view('/contact','contact');
            Route::post('/contact',function (Request $request) {

                Mail::to('nadiaghalib96@gmail.com')
                ->send(new ContactMail(
                    $request->get('name'),
                    $request->get('email'),
                    $request->get('subject'),
                    $request->get('message'),
                ));

            });
        });
