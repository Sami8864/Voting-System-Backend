<?php

namespace App\Http\Controllers;

use App\Models\Parties;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\YourModelResource;
use Illuminate\Support\Facades\Validator;
// This PHP class, within a Laravel application, contains controller methods for managing parties in an election, including adding a party with image upload and loading all parties with associated data, responding with appropriate resources.


class ElectionController extends Controller
{
    public function addParty(Request $request)
    {

        $validatedData = $request->all();
        // Get the uploaded file
        $data = $request->all();
        $validator = validator::make($validatedData, [
            'name'=>'required',
            'image'=>'required',
            'leader'=>'required'
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        }
        $image = $request->file('image');

        // Store the image in the storage folder
        $imagePath = $image->store('public/images');

        // Remove the 'public/' prefix from the image path
        $imagePath = str_replace('public/', '', $imagePath);

        // Manually construct the image URL with the desired IP address and port
        $imageUrl = 'http://127.0.0.1:8000/storage/' . $imagePath;
        $party = Parties::create([
            'name' => $validatedData['name'],
            'image' => $imageUrl,
            'leader' => $validatedData['leader'],
        ]);
        $resource = YourModelResource::makeWithCodeAndData('Success', 200, $party);
        return $resource->response();
    }
    public function load()
    {
        $data = Parties::All();
        $resource = YourModelResource::makeWithCodeAndData('Success', 200, $data);
        return $resource->response();
    }
}
