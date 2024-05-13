<?php

namespace App\Http\Controllers;

use App\Models\Parties;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\YourModelResource;
use Illuminate\Support\Facades\Validator;
use App\Models\UserVotes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\UserStatus;
use App\Models\FAQ;

// This PHP class, within a Laravel application, contains controller methods for managing parties in an election, including adding a party with image upload and loading all parties with associated data, responding with appropriate resources.


class ElectionController extends Controller
{
    public function addParty(Request $request)
    {

        $validatedData = $request->all();
        $validator = validator::make($validatedData, [
            'name' => 'required',
            'image' => 'required',
            'leader' => 'required'
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

    public function castVote(Request $request)
    {
        $validatedData = $request->all();
        $validator = validator::make($validatedData, [
            'election' => ['required', Rule::in(['general', 'primary'])],
            'party_id' => 'required|exists:parties,id'
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        } else {
            $user = UserStatus::find(auth()->user()->id);
            if ($request->election == 'general') {
                $alreadyCasted = UserVotes::where('id', auth()->user()->id)->where('election', 'general')->first();
                if (isset($alreadyCasted)) {
                    $resource = YourModelResource::makeWithCodeAndData('Already Casted Vote', 201, $alreadyCasted);
                    return $resource->response();
                }
                $vote = UserVotes::create(['election' => 'general', 'user_id' => auth()->user()->id, 'party_id' => $request->party_id]);
                $user->presendentaial = true;
                $user->Save();
            } else if ($request->election == 'primary') {
                $alreadyCasted = UserVotes::where('id', auth()->user()->id)->where('election', 'primary')->first();
                if (isset($alreadyCasted)) {
                    $resource = YourModelResource::makeWithCodeAndData('Already Casted Vote', 201, $alreadyCasted);
                    return $resource->response();
                }
                $vote = UserVotes::create(['election' => 'primary', 'user_id' => auth()->user()->id, 'party_id' => $request->party_id]);
                $user->preliminary = true;
                $user->Save();
            }
            $resource = YourModelResource::makeWithCodeAndData('Vote Casted', 200, $vote);
            return $resource->response();
        }
    }

    public function votes(Request $request)
    {
        $validatedData = $request->all();
        $validator = validator::make($validatedData, [
            'election' => ['required', Rule::in(['general', 'primary'])],
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        } else {
            $parties = Parties::All();
            $voteCount = [];
            foreach ($parties as $party) {
                if ($request->election == 'general') {
                    $votes = count(UserVotes::where('party_id', $party->id)->where('election', 'general')->get());
                } else if ($request->election == 'primary') {
                    $votes = count(UserVotes::where('party_id', $party->id)->where('election', 'primary')->get());
                }
                $voteCount[] = [
                    'party' => $party->name,
                    'votes' => $votes
                ];
            }
            $resource = YourModelResource::makeWithCodeAndData('Votes Fetched', 200, $voteCount);
            return $resource->response();
        }
    }

    public function question(Request $request)
    {
        $validatedData = $request->all();
        $validator = validator::make($validatedData, [
            'question' => 'required'
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        } else {
            $faq = FAQ::create(['question' => $request->question, 'user_id' => auth()->user()->id]);
            $resource = YourModelResource::makeWithCodeAndData('Question Submitted', 200, $faq);
            return $resource->response();
        }
    }
    public function myQuestions(Request $request)
    {
        $faq = FAQ::where('user_id', auth()->user()->id)->get();
        $resource = YourModelResource::makeWithCodeAndData('Question Submitted', 200, $faq);
        return $resource->response();
    }

    public function answer(Request $request)
    {
        $validatedData = $request->all();
        $validator = validator::make($validatedData, [
            'question_id' => 'required|exists:f_a_q_s,id',
            'answer' => 'required'
        ]);
        if ($validator->fails()) {
            $resource = YourModelResource::makeWithCodeAndData('Validation Error', 422, $validator->errors());
            return $resource->response();
        } else {
            $faq = FAQ::find($request->question_id);
            $faq->answer = $request->answer;
            $faq->status = 'done';
            $faq->save();
            $resource = YourModelResource::makeWithCodeAndData('Answer Submitted', 200, $faq);
            return $resource->response();
        }
    }
}
