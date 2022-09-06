<?php

namespace App\Http\Controllers;


use App\UserWebsiteSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Laravel\Lumen\Routing\Controller as BaseController;

class WebsiteSubscriptionController extends BaseController
{
    public function subscribeWebsite(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'website_id' => 'required|exists:websites,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $is_subscription_exist = UserWebsiteSubscription::whereUserId($request->user_id)->whereWebsiteId($request->website_id)->count();

        if($is_subscription_exist>0)
            return  response()->json( ["code"=>409, "message"=>"Already subscribed"], 409);


        $insert_data = array(
            "user_id"=>$request->user_id,
            "website_id"=>$request->website_id,

        );

        $insert = UserWebsiteSubscription::create($insert_data);

        if ($insert)
            return response()->json($insert, 201);
        else
            return  response()->json( ["status">false,"message"=>"Somthing went wrong"], 504);


    }
}
