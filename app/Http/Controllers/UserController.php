<?php

namespace App\Http\Controllers;


use App\User;
use App\WebsitePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function store(Request $request)
    {
        try {
            $rules = [
                'name'=>'required|regex:/^[\pL\s\-]+$/u|max:15',
                'email' => 'required|email|unique:users,email',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $validator->errors();
            }

            $insert_data = array(
                "name" => $request->name,
                "email" => $request->email
            );
            $insert = User::create($insert_data);

            if ($insert)
                return response()->json($insert, 201);
            else
                return  response()->json( ["code">504,"message"=>"Something went wrong"], 504);

        }catch (\Exception $exception){
            return  response()->json( ["code">504,"message"=>"Something went wrong".$exception], 504);

        }
    }

    public function showAllUsers()
    {
        try {
            return response()->json(User::all());
        }catch (\Exception $exception){
            return  response()->json( ["status">false,"message"=>"Something went wrong"], 504);

        }
    }

    public function showPostByWebsite($website_id)
    {
        try {
            return response()->json(WebsitePost::where("website_id", $website_id)->get());
        }catch (\Exception $exception){
            return  response()->json( ["status">false,"message"=>"Something went wrong"], 504);

        }
    }
}
