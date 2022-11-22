<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    use ApiResponseTrait;

    public function createItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|',
            'price'=> 'required|numeric',
            'discount_price'=> 'nullable|numeric',
            'preparation_time'=> 'required|numeric',
            'image'=> 'required|image',
            'restaurant_id'=> 'required|exists:restaurants,id',

        ]);
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ],422);
            }

        $path = Storage::putFile('items', $request->file('image'));
        $item = Item::create($request->all());
        $item->update([
            'image' => $path,
        ]);


        return $this->apiResponse('200','Item added successfully',[
            'item' => $item,
        ]);
    }

    public function editItem(Request $request,$restaurantId,$offerId)
    {
        $item = Item::find($offerId);
        if($item->restaurant_id == $restaurantId)
        {
            $path = $item->image;

            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|',
                'price'=> 'nullable|numeric',
                'discount_price'=> 'nullable|numeric',
                'preparation_time'=> 'nullable|numeric',
                'image'=> 'nullable|image',
                'restaurant_id'=> 'nullable|exists:restaurants,id',
    
            ]);
                if ($validator->fails()) {
                    return response()->json([
                        $validator->errors()
                    ],422);
                }
    
            $item->update($request->all());
            if ($request->hasFile('image')) {
                Storage::delete($path);
                $path = Storage::putFile('items', $request->file('image'));
            }
    
            $item->update([
                'image' => $path,
            ]);
    
    
            return $this->apiResponse('200','Item updated successfully',[
                'item' => $item,
            ]);
        } else {
            return $this->apiResponse('422','Incorrect Item_id ');
        }

   


    }


    public function deleteItem($restaurantId,$itemId)
    {
        $item = Item::find($itemId);
        if($item->restaurant_id == $restaurantId){
            $path = $item->image;
            $item->delete();
            Storage::delete($path);
            return $this->apiResponse('200','item deleted successfully');
    
        } else {
            return $this->apiResponse('422','Incorrect restaurant_id');
        };
    }
}
