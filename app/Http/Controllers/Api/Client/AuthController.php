<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\client;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponseTrait;
use App\Models\NotificationToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients',
            'password'=> 'required|string|min:5|max:25|confirmed',
            'region_id'=> 'required|exists:regions,id',
            'phone'=> 'required|string',

        ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }


        $client = Client::create($request->all());
        $client->update([
            'password' =>Hash::make($request->password),
        ]);

        $token = $client->createToken('api_token');

        return $this->apiResponse('200','Client Added Successfully',[
            'api_token' => $token->plainTextToken,
            'client' => $client,
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

        $client = client::where('email', $request->email)->first();
        if ($client){
            $correctPassword = Hash::check($request->password , $client->password);
            if($correctPassword){
                $token = $client->createToken('api_token');

                return $this->apiResponse('200','client logged Successfully',[
                    'api_token' => $token->plainTextToken,
                    'client' => $client,
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
        return $this->apiResponse('200','client logged out successfully');



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
        $client = Client::where('email', $request->email)->first();

        if($client){
            $pinCode = rand(1111,9999);

            $updatedClient = $client->update([
                'pin_code' => $pinCode,
            ]);

            if($updatedClient !== null) {
                //send sms with pincode
                //send email with pincode
                Mail::to($client->email)
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
        $client = Client::where('pin_code', $request->pin_code)->where('pin_code','!=',0)->first();


        if($client){
            $updatedClient = $client->update([
                'password' => Hash::make($request->password),
                'pin_code' => null,
            ]);

            if($updatedClient !== null) {
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
        $validator = Validator::make($request->all(), [
            'name'=> 'nullable|string',
            'email' => [Rule::unique('clients')->ignore($request->user()->id)],
            'phone'=> 'nullable|string', [Rule::unique('clients')->ignore($request->user()->id)],
            'city_id' => 'nullable|exists:cities,id',
            'region_id' => 'nullable|exists:clients,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ],422);
        };

        $loggedClient = $request->user();
        $loggedClient->update($request->all());

        if($request->has('password')){
            $newPassword = Hash::make($request->password);
            $loggedClient->update(['password'=>$newPassword]);
        };
        return $this->apiResponse('200','Profile updated successfully',['client' => $request->user()]);
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
