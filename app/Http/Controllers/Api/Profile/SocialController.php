<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\UserSocialIdentityDetail;
use App\Transformers\Profile\SocialTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    //
    public function __construct(UserSocialIdentityDetail $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->social;
        return fractal($bankDetails, new SocialTransformer())->respond();
    }
    public function store(Request $request)
    {

        $pr =  new UserSocialIdentityDetail;
        $pr->user_id = Auth::user()->id;

        $pr->aadhaar_number= $request->aadhaar_number;
        $pr->driving_licence_number=$request->driving_licence_number;
        $pr->pancard_number=$request->pancard_number;
        $pr->passport_number=$request->passport_number;
        $pr->voter_card_number=$request->voter_card_number;
        $pr->ration_card_number=$request->ration_card_number;
        $pr->save();
        
        return fractal($pr, new SocialTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new SocialTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'fathersname' => 'required',
            
        ]);
        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->aadhaar_number= $request->aadhaar_number;
        $pr->driving_licence_number=$request->driving_licence_number;
        $pr->pancard_number=$request->pancard_number;
        $pr->passport_number=$request->passport_number;
        $pr->voter_card_number=$request->voter_card_number;
        $pr->ration_card_number=$request->ration_card_number;
        $pr->save();

        return fractal($pr, new SocialTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
