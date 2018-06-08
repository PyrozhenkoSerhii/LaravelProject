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


//auth package
Auth::routes();

//home
Route::get('/', ['as' => 'posts', 'uses' => 'PostController@published']);

//admin page
Route::get('adminPage', ['as' => 'adminPage', 'uses' => 'UserController@admin']);
Route::get('adminPage/unpublished', ['as' => 'unpublished', 'uses' => 'PostController@unpublished']);
Route::get('adminPage/infoPage', ['as' => 'infoPage', 'uses' => 'UserController@infoPage']);
Route::get('adminPage/infoPage/changeAccess/{id}', ['as' => 'changeAccess', 'uses' => 'UserController@changeAccess']);

//posts
Route::get('post/category/{name}', ['as' => 'postsByCategory', 'uses' => 'PostController@publishedByCategory']);
Route::get('post/create', ['as' => 'postCreate', 'uses' => 'PostController@create']);
Route::post('post/store', ['as' => 'postStore', 'uses' => 'PostController@store']);
Route::get('post/edit/{id}', ['as' => 'postEdit', 'uses' => 'PostController@edit']);
Route::get('post/show/{id}', ['as' => 'showPost', 'uses' => 'PostController@showAlonePost']);
Route::post('post/edit/save', ['as' => 'postSave', 'uses' => 'PostController@save']);
Route::get('post/delete/{id}', ['as' => 'postDelete', 'uses' => 'PostController@delete']);
Route::post('post/addToFavorite',['as'=>'addToFavorite', 'uses'=>'FavoriteController@addToFavorite']);
Route::post('post/deleteFromFavorite',['as'=>'deleteFromFavorite', 'uses'=>'FavoriteController@deleteFromFavorite']);
Route::post('post/getFavorite',['as'=>'getFavorite', 'uses'=>'FavoriteController@getFavorite']);



//comments
Route::post('comment/store', ['as' => 'commentStore', 'uses' => 'CommentController@store']);
Route::get('post/show/comment/delete/{id}', ['as' => 'commentDelete', 'uses' => 'CommentController@delete']);

//dictionary
Route::get('showDictionary/{id}', ['as' => 'showDictionary', 'uses' => 'DictionaryController@show']);
Route::post('dictionary/store', ['as' => 'dictionaryStore', 'uses' => 'DictionaryController@store']);
Route::post('dictionary/update/{id}', ['as' => 'dictionaryUpdate', 'uses' => 'DictionaryController@update']);
Route::get('dictionary/delete/{id}', ['as' => 'deleteWord', 'uses' => 'DictionaryController@delete']);

//profile
Route::get('showProfile', ['as' => 'showProfile', 'uses' => 'UserController@showProfile']);
Route::get('editProfile', ['as' => 'editProfile', 'uses' => 'UserController@editProfile']);
Route::get('showFavoriteNews', ['as' => 'showFavoriteNews', 'uses' => 'UserController@showFavoriteNews']);
Route::get('showSuggestedArticles', ['as' => 'showSuggestedArticles', 'uses' => 'UserController@showSuggestedArticles']);
Route::get('showMyComments', ['as' => 'showMyComments', 'uses' => 'UserController@showMyComments']);
Route::get('showSubscribes', ['as' => 'showSubscribes', 'uses' => 'UserController@showSubscribes']);

//ajax
Route::post('post/getTranslationBing',['as'=>'getTranslationBing','uses'=>'PostController@getTranslationBing']);
Route::post('showProfile/edit', ['as' => 'changeProfile', 'uses' => 'UserController@changeProfile']);
Route::post('showSubscribes/edit', ['as' => 'changeSubscribe', 'uses' => 'UserController@changeSubscribe']);
Route::post('dictionary/storeFromArticle', ['as' => 'dictionaryStoreFromArticle', 'uses' => 'DictionaryController@storeFromArticle']);
Route::get('getMessage',['as'=>'getMessage','uses'=>'MessageController@getMessage']);
Route::post('deleteMessage',['as'=>'deleteMessage','uses'=>'MessageController@deleteMessage']);

//translator (doesnt work)
Route::post('post/translate', ['as' => 'postTranslate', 'uses' => 'PostController@translateText']);

//trainings
Route::get('training/{id}',['as'=>'goToTraining','uses'=>'TrainingController@main']);
Route::get('trainingWordTranslation/{id}',['as'=>'goToTrainingWordTranslation','uses'=>'TrainingWordTranslationController@main']);
Route::get('trainingCard/{id}',['as'=>'goToTrainingCard','uses'=>'TrainingCardController@main']);