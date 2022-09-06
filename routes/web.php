<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('subscribe_website', ['uses' => 'WebsiteSubscriptionController@subscribeWebsite']);


    $router->post('add_webbsite_post', ['uses' => 'WebsitePostController@addWebsitePost']);
    $router->get('show_all_posts', ['uses' => 'WebsitePostController@showAllPosts']);
    $router->get('show_post_by_website/{website_id}', ['uses' => 'WebsitePostController@showPostByWebsite']);


    $router->post('add_new_user', ['uses' => 'UserController@store']);
    $router->get('get_users', ['uses' => 'UserController@showAllUsers']);

});