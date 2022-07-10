<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Transformers\Profile\AgreementsTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgreementController extends Controller
{
    //
    public function __construct(Agreement $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->agreements;
        return fractal($bankDetails, new AgreementsTransformer())->respond();
    }
    public function store(Request $request)
    {



 foreach($request->toArray() as $value){
       
        $pr =  new Agreement;
        $pr->user_id = Auth::user()->id;
        $pr->file_name= $value['file_name'];
        $pr->file_type=$value['file_type'];
        $pr->save();
    }
        
        return fractal($pr, new AgreementsTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new AgreementsTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'file_name' => 'required',
            'file_type' => 'required',
            
        ]);
        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->file_name= $request->file_name;
        $pr->file_type=$request->file_type;
        
        $pr->save();

        return fractal($pr, new AgreementsTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
