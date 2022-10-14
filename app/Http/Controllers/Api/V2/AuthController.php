<?php

/** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\OTPVerificationController;
use App\Models\BusinessSetting;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Notifications\AppEmailVerificationNotification;
use Hash;
use Validator;
use App\Models\PropertyInquiry;
use App\Models\Review;
use App\Models\Wishlist;

class AuthController extends Controller
{
    public function user_register(Request $request)
    {

    }

    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'remember_me' => 'boolean',
            'type' => 'required|string',
            'terms' => 'required|string',
            'notification' => 'required|string',
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Validation Failed',
             'errors' => $validator->messages(),
            ],401);
         } 

         $code = rand(100000, 999999);

         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'user_type' => 'customer',
            'terms' => $request->terms,
            'notification' => $request->notification,
            'verification_code' => $code,
        ]);

        $user->notify(new AppEmailVerificationNotification());
        $customer = new Shop;
        $customer->user_id = $user->id;
        $customer->save();

        return response()->json([
            'result' => true,
            'message' => translate('Registration Successful. Please verify and log in to your account.'),
        ], 201);


  
        // if ($request->register_by == 'email') {
        //     $user = new User([
        //         'name' => $request->name,
        //         'email' => $request->email_or_phone,
        //         'password' => bcrypt($request->password),
        //         'verification_code' => rand(100000, 999999)
        //     ]);
        // } else {
        //     $user = new User([
        //         'name' => $request->name,
        //         'phone' => $request->email_or_phone,
        //         'password' => bcrypt($request->password),
        //         'verification_code' => rand(100000, 999999)
        //     ]);
        // }

        // if ($request->register_by == 'email') {
        //     if(BusinessSetting::where('type', 'email_verification')->first()->value != 1) {
        //         $user->email_verified_at = date('Y-m-d H:m:s');
        //     } else{
        //         try {
        //             $user->notify(new AppEmailVerificationNotification());
        //         } catch (\Exception $e) {
                    
        //         }
        //     }
        // } else {
        //     $otpController = new OTPVerificationController();
        //     $otpController->send_code($user);
        // }
        // $user->save();


    }


    public function resendCode(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->verification_code = rand(100000, 999999);

        if ($request->verify_by == 'email') {
            $user->notify(new AppEmailVerificationNotification());
        } else {
            $otpController = new OTPVerificationController();
            $otpController->send_code($user);
        }

        $user->save();

        return response()->json([
            'result' => true,
            'message' => translate('Verification code is sent again'),
        ], 200);
    }

    public function confirmCode(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'verification_code' => 'required',
         ]);

         if($validator->fails()){
            return response()->json([
             'message' => 'Verification Failed',
             'errors' => $validator->messages(),
            ],401);
         } 

        $user = User::where('id', $request->user_id)->first();

        if ($user->verification_code == $request->verification_code) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->verification_code = null;
            $user->save();
            return response()->json([
                'result' => true,
                'message' => translate('Your account is now verified.Please login'),
            ], 200);
        } else {
            return response()->json([
                'result' => false,
                'message' => translate('Code does not match, you can request for resending the code'),
            ], 200);
        }
        
    }


    public function login(Request $request)
    {

       
                
        $validator = Validator::make($request->all(),[
           'email' => 'required|string|email',
           'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
           return response()->json([
            'message' => 'Validation Failed',
            'errors' => $validator->messages(),
           ],401);
        } 

        $user = User::where('email',$request->email)->first();
        if($user == null){
            return response()->json([ 
                'message' => translate('Wrong Email Or Password'), 
            ], 401);
        }

        if(Hash::check($request->password, $user->password) == false){
            return response()->json([ 
                'message' => translate('Wrong Email Or Password'), 
            ], 401);
        }

        // if($user->email_verified_at == null) {
        //     return response()->json([
        //         'message' => translate('Please verify your account'), 
        //         'user' => $user->id
        //     ], 401);
        // }

        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json([
            'message' => translate('Successfully logged in'),
            'data' =>$token,
        ]);


        // $delivery_boy_condition = $request->has('user_type') && $request->user_type == 'delivery_boy';
        // if ($delivery_boy_condition) {
        //     $user = User::whereIn('user_type', ['delivery_boy'])->where('email', $request->email)->orWhere('phone', $request->email)->first();
        // } else {
        //     $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->orWhere('phone', $request->email)->first();
        // }
        // if (!$delivery_boy_condition) {
        //     if (\App\Utility\PayhereUtility::create_wallet_reference($request->identity_matrix) == false) {
        //         return response()->json(['result' => false, 'message' => 'Identity matrix error', 'user' => null], 401);
        //     }
        // }

    }


    public function user(Request $request)
    {
        
        $user = $request->user();
        $profile = [];
        $profile['id'] = $user->id;
        $profile['type'] = $user->user_type;
        $profile['name'] = $user->name;
        $profile['email'] = $user->email;
        $profile['avatar'] = $user->avatar;
        $profile['avatar_original'] = api_asset($user->avatar_original);
        $profile['phone'] = $user->phone;

        $wishlist = Wishlist::where('user_id', $user->id)->count();
        $profile['wishlist'] = $wishlist;
        $reviews = Review::where('user_id',$user->id)->count();
        $profile['myreviews'] = $reviews;

        $profile['notifications'] = 0;
        $profile['chats'] = 0;


        if($user->user_type == 'customer'){
            $inq = PropertyInquiry::where('agent_id',$user->id)->count();
            $profile['inquiries'] = $inq;

        }

        if($user->user_type == 'seller'){

            $properties = Product::where('user_id',$user->id)->pluck('id')->toArray();
            $profile['properties'] = count($properties);

            $inq = PropertyInquiry::whereIn('property_id',$properties)->count();
            $profile['inquiries'] = $inq;
            
            $reviews = Review::whereIn('property_id',$properties)->count();
            $profile['reviews'] = $reviews;
        }


        return response()->json([
            'message' => translate('Successfully logged in'),
            'data' => $profile,
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'result' => true,
            'message' => translate('Successfully logged out')
        ]);
    }

    
    public function socialLogin(Request $request)
    {
        if (User::where('email', $request->email)->first() != null) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'provider_id' => $request->provider,
                'email_verified_at' => Carbon::now()
            ]);
            $user->save();
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();
        }
        return $this->loginSuccess($user);
    }


    protected function loginSuccess($user)
    {
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json([
            'result' => true,
            'message' => translate('Successfully logged in'),
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => null,
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'avatar_original' => api_asset($user->avatar_original),
                'phone' => $user->phone
            ]
        ]);
    }
}
