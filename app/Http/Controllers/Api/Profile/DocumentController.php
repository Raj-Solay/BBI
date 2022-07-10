<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\UserDocument;
use App\Transformers\Profile\DocumentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    //
    public function __construct(UserDocument $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {
        $bankDetails = auth()->user()->document;
        return fractal($bankDetails, new DocumentTransformer())->respond();
    }
    public function store(Request $request)
    {



 foreach($request->toArray() as $value){
       
 $pr =  new UserDocument;

        $pr->user_id = Auth::user()->id;

        $pr->document_id= $value['document_id'];
        $pr->document_name=$value['document_name'];
        $pr->document_type=$value['document_type'];
       
        $pr->save();
    }
        
        return fractal($pr, new DocumentTransformer())->respond(201);
    }

    public function show($id)
    {
        $role = $this->model->with('permissions')->byUuid($id)->firstOrFail();

        return fractal($role, new DocumentTransformer())->respond();
    }
    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'document_name' => 'required',
            
        ]);
        $pr = $this->model->byUuid($uuid)->firstOrFail();
        $pr->document_id= $request->document_id;
        $pr->document_name=$request->document_name;
        $pr->document_type=$request->document_type;
        
        $pr->save();

        return fractal($pr, new DocumentTransformer())->respond();
    }
    public function destroy(Request $request, $uuid)
    {
        $bank = $this->model->byUuid($uuid)->firstOrFail();
        $bank->delete();

        return response()->json(null, 204);
    }
}
