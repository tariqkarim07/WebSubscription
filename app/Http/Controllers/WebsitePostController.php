<?php

namespace App\Http\Controllers;


use App\WebsitePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class WebsitePostController extends BaseController
{
    public function addWebsitePost(Request $request)
    {
        try {
            $rules = [
                'website_id' => 'required|exists:websites,id',
                'post_text' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $validator->errors();
            }

            $insert_data = array(
                "website_id" => $request->website_id,
                "post_text" => $request->post_text
            );
            $insert = WebsitePost::create($insert_data);

            if ($insert)
                return response()->json($insert, 201);
            else
                return  response()->json( ["code">504,"message"=>"Somthing went wrong"], 504);

        }catch (\Exception $exception){
            return  response()->json( ["code">504,"message"=>"Somthing went wrong".$exception], 504);

        }
    }

    public function showAllPosts()
    {
        try {
            return response()->json(WebsitePost::all());
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
