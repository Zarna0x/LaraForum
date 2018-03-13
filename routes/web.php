<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     
    //var_dump(env("DB_USERNAME"));
   //  $faker = Faker\Factory::create()->paragraph;
   // var_dump($faker);

/*    
factory('App\Reply',2)->create()->each(function ($item,$key) {
 echo '<pre>'.print_r($item->body,1).'</pre>';
});
*/


// var_dump(factory('App\Thread',2)->create());
// die;
// var_dump(factory('App\Thread',1)->create()->each(function ($thread) {
// 	// $thread is $thread objecct
// 	 factory('App\Reply',10)->create(['thread_id'=> $thread->id]) ;
// })); // it should return Collection of createds

    //echo "<pre>",print_r(factory('App\User')->create()->name,1),"</pre>";
   // var_dump((new \Illuminate\Database\Eloquent\Factory(new \Faker\Generator))->define("CL",function () {
   // 	  return [
   //        'WT' => "F"
   // 	  ];
   // }));

return view('home');
});


Route::get('/threads','ThreadController@index');

Route::get('/threads/create','ThreadController@create');
Route::get('/threads/{channel}','ThreadController@index');
Route::post('/threads','ThreadController@store');
Route::get('/threads/{channel}/{thread}','ThreadController@show');
Route::post('/threads/{channel}/{thread}/replies','ReplyController@store')->name('add_reply');

//Route::resource('threads','ThreadController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
