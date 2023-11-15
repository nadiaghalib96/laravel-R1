<?php

use Illuminate\Support\Facades\Route;

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


  