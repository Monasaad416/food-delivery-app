<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Restaurant;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponseTrait;
use App\Models\NotificationToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:restaurants',
            'password'=> 'required|string|min:5|max:25|confirmed',
            'region_id'=> 'required|exists:regions,id',
            'min_order_charge'=> 'required|numeric',
            'delivery_fees'=> 'required|numeric',
            'whats_app_url'=> 'required|url',
            'phone'=> 'required|string',
            'image'=> 'required|image',
            'categories_id' => 'array',
            'categories_id.*' => 'required|exists:categories,id'

        ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }

        $path = Storage::putFile('restaurants', $request->file('image'));

        $restaurant = Restaurant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(($request->password)),
            'region_id' => $request->region_id,
            'min_order_charge' => $request->min_order_charge,
            'delivery_fees' => $request->delivery_fees,
            'whats_app_url' => $request->whats_app_url,
            'phone' => $request->phone,
            'image' => $path,
        ]);

        $restaurant->categories()->attach($request->categories_id);


        $token = $restaurant->createToken('api_token');

        return $this->apiResponse('200','Restaurant Added Successfully',[
            'api_token' => $token->plainTextToken,
            'restaurant' => $restaurant,
        ]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required|string|min:5|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ],500);
        }

        $restaurant = restaurant::where('email', $request->email)->first();
        if ($restaurant){
            $correctPassword = Hash::check($request->password , $restaurant->password);
            if($correctPassword){
                $token = $restaurant->createToken('api_token');

                return $this->apiResponse('200','restaurant logged Successfully',[
                    'api_token' => $token->plainTextToken,
                    'restaurant' => $restaurant,
                ]);

            } else {
                return $this->apiResponse('422','Incorrect Password');
            }
        } else {
            return $this->apiResponse('422','email dose not exist');
        }
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->apiResponse('200','restaurant logged out successfully');



    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors(),409
            ]);
        }
        $restaurant = Restaurant::where('email', $request->email)->first();

        if($restaurant){
            $pinCode = rand(1111,9999);

            $updatedRestaurant = $restaurant->update([
                'pin_code' => $pinCode,
            ]);

            if($updatedRestaurant !== null) {
                //send email with pincode
                Mail::to($restaurant->email)
                    ->send(new ResetPassword($pinCode));


            } else {
                return $this->apiResponse('0','Try again');
            }
        } else {
            return $this->apiResponse('0','There is no account related to this email');
        }
    }

    public function sendNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code'=> 'required',
            'password'=>'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ],422);
        }
        $restaurant = Restaurant::where('pin_code', $request->pin_code)->where('pin_code','!=',0)->first();


        if($restaurant){
            $updatedrestaurant = $restaurant->update([
                'password' => Hash::make($request->password),
                'pin_code' => null,
            ]);

            if($updatedrestaurant !== null) {
                return $this->apiResponse('200','Password updated successfully');
            } else {
                return $this->apiResponse('0','Try again');
            }
        } else {
            return $this->apiResponse('0','Invalid pin code');
        }
    }

    public function profile(Request $request)
    {
        $loggedRestaurant = $request->user();
        return $this->apiResponse('200','Display profile successfully',['profile' => [
            [
                'name' => $loggedRestaurant->name,
                'email' => $loggedRestaurant->email,
                'phone' => $loggedRestaurant->phone,
                'region_id' => $loggedRestaurant->region_id,
                'min_order_charge' => $loggedRestaurant->min_order_charge,
                'delivery_fees' => $loggedRestaurant->delivery_fees,
                'whats_app_url' => $loggedRestaurant->whats_app_url,
                'phone' => $loggedRestaurant->region_id,
                'image' => $loggedRestaurant->image,
            ]
        ]]);
    }


    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'nullable|string',
            'email' => [Rule::unique('restaurants')->ignore($request->user()->id)],
            'phone'=> 'nullable|string', [Rule::unique('restaurants')->ignore($request->user()->id)],
            'password' => 'nullable|string|min:5|max:25|confirmed',
            'region_id' => 'nullable|exists:regions,id',
            'min_order_charge' => 'nullable|numeric',
            'delivery_fees' => 'nullable|numeric',
            'whats_app_url' => 'nullable|url',
            'image' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ],422);
        };

        $loggedRestaurant = $request->user();
        $loggedRestaurant->update($request->all());
        $path = $loggedRestaurant->image;

        if($request->has('password')){
            $newPassword = Hash::make($request->password);
            $loggedRestaurant->update(['password'=>$newPassword]);
        };
        if ($request->hasFile('image')) {
            Storage::delete($path);
            $path = Storage::putFile('restaurants', $request->file('image'));
            $loggedRestaurant->update(['image'=>$path]);
        }
        return $this->apiResponse('200','Profile updated successfully',['restaurant' => $request->user()]);
    }



    public function registerDeviceToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token'=> 'required|string',// device token
            'type'=> 'required|string|min:5|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors(),409
            ]);
        }
        //remove old token
        NotificationToken::where('token' , $request->token)->delete();
        $request->user()->notification_tokens()->create(
            $request->all(),
        );
        return $this->apiResponse('200','Notification token created successfully');


    }
    public function removeDeviceToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token'=> 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors(),409
            ]);
        }
        NotificationToken::where('token',$request->token)->delete();

    }
}
