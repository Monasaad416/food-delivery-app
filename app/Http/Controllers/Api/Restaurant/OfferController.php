<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    use ApiResponseTrait;

    public function createOffer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|',
            'image'=> 'required|image',
            'from_date'=> 'required|date',
            'to_date'=> 'required|date',
            'restaurant_id'=> 'required|exists:restaurants,id',
        ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }
            if($request->restaurant_id == $request->user()->id){
                $path = Storage::putFile('offers', $request->file('image'));
                $offer = Offer::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $path,
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'restaurant_id' => $request->restaurant_id,
                ]);
                $offer->update([
                    'image' => $path,
                ]);


                return $this->apiResponse('200','Offer added successfully',[
                    'offer' => $offer,
                ]);
            } else {
                return $this->apiResponse('0','الرقم التعريفي للمطعم غير صحيح');
            }
    }

    public function editOffer(Request $request,$offerId)
    {
        $offer = Offer::find($offerId);
        if($offer->resrtaurant_id == $request->user()->id){
            
        $path = $offer->image;

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|',
            'image'=> 'nullable|image',
            'from_date'=> 'nullable|date',
            'to_date'=> 'nullable|date',
        ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }

        $offer->update($request->all());
        if ($request->hasFile('image')) {
            Storage::delete($path);
            $path = Storage::putFile('offers', $request->file('image'));
        }

        $offer->update([
            'image' => $path,
        ]);


        return $this->apiResponse('200','Offer updated successfully',[
            'offer' => $offer,
        ]);

        } else {
            return $this->apiResponse('422','Incorrect restayrant_id');
        }

    }


    public function deleteOffer($offerId)
    {
        $offer = Offer::find($offerId);
        if($offer->restaurant_id == $request->user()->id){
            $path = $offer->image;
            $offer->delete();
            Storage::delete($path);
            return $this->apiResponse('200','Offer deleted successfully');
    
        } else {
            return $this->apiResponse('422','Incorrect restaurant_id');
        };
    }
}
