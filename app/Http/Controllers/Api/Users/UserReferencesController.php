<?php

namespace App\Http\Controllers\Api\Users;

use App\Exceptions\StoreResourceFailedException;
use App\Http\Controllers\Controller;
use App\Models\UserReferences;
//use App\Transformers\Profile\ReferencesTransformer;
use App\Transformers\Profile\ReferencesTransformer;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReferencesController extends Controller
{
    public function index()
    {

      $dataDetails = auth()->user()->relation;
    
        return fractal($dataDetails, new ReferencesTransformer())->respond();

    }

    public function profileLink()
    {
        
       // return fractal(ProfileLink::get(), new UserTransformer())->respond();
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];
        if ($request->method() == 'PATCH') {
            $rules = [
                'name' => 'sometimes|required',
                'email' => 'sometimes|required|email|unique:users,email,'.$user->id,
            ];
        }
        $this->validate($request, $rules);
        // Except password as we don't want to let the users change a password from this endpoint
        $user->update($request->except('_token', 'password'));

        return fractal($user->fresh(), new UserTransformer())->respond();
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        // verify the old password given is valid
        if (! app(Hasher::class)->check($request->get('current_password'), $user->password)) {
            throw new StoreResourceFailedException('Validation Issue', [
                'old_password' => 'The current password is incorrect',
            ]);
        }
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return fractal($user->fresh(), new UserTransformer())->respond();
    }

    public function createRef(Request $request)
    {

    $pr =  new UserReferences();
    $pr->user_id = Auth::user()->id;
    $pr->fullname= $request->fullname;
    $pr->relation= $request->relation;
    $pr->sex= $request->sex;
    $pr->age= $request->age;
    $pr->occupation= $request->occupation;
    $pr->location= $request->location;
    $pr->contact_number= $request->contact_number;
    $pr->address= $request->address;
    $pr->save();
    
    return fractal($pr, new ReferencesTransformer())->respond(201);
    }

    public function updateRef(Request $request, $uuid)
    {
    $pr =  new UserReferences();
    $pr = $pr->byUuid($uuid)->firstOrFail();
    $pr->user_id = Auth::user()->id;
    $pr->fullname= $request->fullname;
    $pr->relation= $request->relation;
    $pr->sex= $request->sex;
    $pr->age= $request->age;
    $pr->occupation= $request->occupation;
    $pr->location= $request->location;
    $pr->contact_number= $request->contact_number;
    $pr->address= $request->address;
    $pr->save();
    
    return fractal($pr, new ReferencesTransformer())->respond(201);
    }

    

}
