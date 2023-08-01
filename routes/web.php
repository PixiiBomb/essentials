<?php

use Illuminate\Support\Facades\Route;
use PixiiBomb\Essentials\Http\Controllers\EmbedController;
use PixiiBomb\Essentials\Http\Controllers\HomeController;
use PixiiBomb\Essentials\Http\Controllers\UserController;


Route::group(['middleware' => ['web']], function () {

    Route::get('/', [HomeController::class, INDEX])->name(HOME);

    Route::get('/chat', [EmbedController::class, 'chat'])->name('chat');
    Route::post('/chat', [EmbedController::class, 'post'])->name('chat.post');
    Route::get('/embed', [EmbedController::class, INDEX])->name(EMBED);
    Route::post('/embed', [EmbedController::class, CREATE])->name(EMBED);

    Route::prefix(USER)->name(USER.'.')->group(function () {
        Route::get(DASHBOARD, [UserController::class, DASHBOARD])->name(DASHBOARD);
            //->middleware(AUTH);
        Route::get(LOGOUT, [UserController::class, LOGOUT])->name(LOGOUT);
        Route::get(LOGIN, [UserController::class, LOGIN])->name(LOGIN);
        Route::post(LOGIN, [UserController::class, AUTHENTICATE])->name(AUTHENTICATE);
        Route::get(REGISTER, [UserController::class, REGISTER])->name(REGISTER);
        Route::post(REGISTER, [UserController::class, CREATE])->name(CREATE);
        Route::post('user/update/profile', [UserController::class, 'updateProfile'])->name('update.profile');
    });

    Route::get('test', function()
    {
        $com = 'https://www.googleapis.com/youtube/v3/';
        $snippet = '?part=snippet';
        $max = 100;
        $api_key = 'AIzaSyDw7jGS52EMozAorx6_t_nudnVPgF0PRxo';
        $video_id = 'PDVLT8qj_6k';
        $channel_id = 'UC6TEaGms62zd11sdt_z1UAg';


        $get_channel = "&channelId={$channel_id}";
        $get_max = "&maxResults={$max}";
        $get_key = "&key={$api_key}";

        $endpoint_playlist = "{$com}playlistItems{$snippet}&playlistId=PLxDIvJ8CILuEgS67ihzRbnX17SgI-8_zZ&key={$api_key}";
        $endpoint_video = "{$com}videos{$snippet},statistics&id={$video_id}{$get_key}";
        $endpoint_playlists = "{$com}playlists{$snippet}{$get_channel}{$get_max}{$get_key}";

        $contents = file_get_contents($endpoint_playlist);
        $json = json_decode($contents);
        $items = $json->items;
        dd($items);



        // record for playlists in a channel
        //$record = $json->items[5];
        //$slug = Str::slug($record->snippet->title);
        /*dd($record->id, $slug, $record->snippet->publishedAt, $record->snippet->title, $record->snippet->description, $record->snippet->thumbnails->maxres->url, $json->items);*/
    });

});
