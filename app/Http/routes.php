<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('app');
});


Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function() {

    Route::resource('client', 'ClientController', ['except' => ['create','edit'] ] );

    Route::resource('project', 'ProjectController', ['except' => ['create','edit'] ] );


    Route::group(['prefix' => 'project'], function () {

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note/', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');

        Route::get('{id}/task', 'ProjectTaskController@index');
        Route::post('{id}/task', 'ProjectTaskController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTaskController@show');
        Route::delete('{id}/task/{taskId}', 'ProjectTaskController@destroy');
        Route::put('{id}/task/{taskId}', 'ProjectTaskController@update');

        Route::get('{id}/member', 'ProjectMemberController@index');
        Route::post('{id}/member', 'ProjectMemberController@store');
        Route::get('{id}/member/{memberId}', 'ProjectMemberController@show');
        Route::delete('{id}/member/{memberId}', 'ProjectMemberController@destroy');
        Route::put('{id}/member/{memberId}', 'ProjectMemberController@update');

        /**
         * File projects
         */
        Route::get('{id}/file', 'ProjectFileController@index');
        Route::get('/file/{idFile}', 'ProjectFileController@show');
        Route::get('/file/{idFile}/download', 'ProjectFileController@showFile');
        Route::post('{id}/file', 'ProjectFileController@store');
        Route::put('/file/{idFile}', 'ProjectFileController@update');
        Route::delete('/file/{idFile}', 'ProjectFileController@destroy');
    });

    Route::get('user/authenticated', 'UserController@authenticated');



});