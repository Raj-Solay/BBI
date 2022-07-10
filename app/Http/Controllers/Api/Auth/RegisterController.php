<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\Users\UserTransformer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required'
        ]);
        
        $user = $this->model->create($request->all());
        $user->assignRole('User');
        event(new Registered($user));

        return fractal($user, new UserTransformer())->respond(201);
    }

    public function notification(){

      
            $jayParsedAry = array (
                0 => 
                array (
                  'data' => 'sample notification data',
                  'icon' => '',
                  "created_at"=> "2022-05-24T21:14:59+00:00",
                ),
                1 => 
                array (
                'data' => 'sample notification data',
                'icon' => '',
                  "created_at"=> "2022-05-24T21:14:59+00:00",
                ),
              );      
        
             echo json_encode($jayParsedAry);
            
        
    }


public function applyPromo(Request $request){
  $this->validate($request, [
    'code' => 'required',
    'totalAmount' => 'required'
]);

if($request->code=='code123456'){

  $response=array("payAmt"=>$request->totalAmount-20,"discountAmt"=>20,'status'=>"success");
  echo json_encode($response);
}else{
  $response=array("discountAmt"=>0,'status'=>"invalid Code");
  echo json_encode($response);
}
}


    public function userStatus(){


        $data=  array (
          'business_name' => 'Biz Bull',
          'customer_name' => 'LJ Raj Solay',
          'date' => '07-01-2022 6:00 PM',
          'number' => 'BBBBBBIJHJJHJHJ',
          'customer_status' => 'Active',
          'type' => 'customer',
          'kyc' => 
          array (
            'status' => 'Completed',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
          'bb_agreement' => 
          array (
            'status' => 'Completed',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
          'registration_fees' => 
          array (
            'status' => 'Pending',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'amount' => 25000,
            'gst' => 2500,
            'discount' => 2500,
          ),
          'finability' => 
          array (
            'status' => 'Completed',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
          'location_update' => 
          array (
            'status' => 'Pending Approval',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
          'agreement' => 
          array (
            'status' => 'Pending Approval',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
          'site_visit' => 
          array (
            'dates' => 
            array (
              0 => '07-01-2022',
              1 => '08-01-2022',
              2 => '09-01-2022',
            ),
            'status' => 'Completed',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
          'frenchisee_fee' => 
          array (
            'status' => 'Pending',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'amount' => 25000,
            'gst' => 2500,
            'discount' => 2500,
          ),
          'setup' => 
          array (
            'status' => 'Pending Approval',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
          'licence' => 
          array (
            'status' => 'Pending Approval',
            'date' => ' 07-01-2022 6:00 PM',
            'message' => 'abc',
            'document_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          ),
        );
  
          echo json_encode($data);
          die();
      }

      public function sitevigit(Request $request){

   echo json_encode(["status"=>1,"message"=>"success"]);

      }
}
