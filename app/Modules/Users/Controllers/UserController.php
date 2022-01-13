<?php 
namespace App\Modules\Users\Controllers;
use App\Modules\Users\Controllers\UserController;
use Illuminate\Http\Request;
use App\Modules\Users\Models\User;
use Lang;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
date_default_timezone_set('Asia/Kolkata'); 

class UserController{
    private $user;
  	public function __construct(){
    $this->user = new User();
    }

    public function index(){
    	return View('Users::index');
    }

    public function saveData(Request $request){
        
        $request =$request->all();
        $date = $request['day'].",".$request['month'].",".$request['year'];
        // $validator = Validator::make($request->all(), [
        //     'first_name' => 'required',
        //     'surname' => 'required',
        //     'number' => 'required',
        //     'gender' => 'required',
        //     'comments' => 'required',
        //     'email' => 'required',
        // ]);
        $validator = Validator::make(
            array(
                'first_name'=>$request['name'],
                'surname'=>$request['surname'],
                'number'=>$request['number'],
                'gender'=>$request['gender'],
                'comments'=>$request['comments'],
                'email'=>$request['email'],
                 'day'=> $request['day'],
                 'month'=>$request['month'],
                 'year'=>$request['year'],
            ),
            array(
                'first_name'=>'required',
                'surname' => 'required',
                'number'=>'required',
                'gender' => 'required',
                'comments'=>'required',
                'email' => 'required',
                'day' => 'required',
                'month' => 'required',
                'year' => 'required',
            )
        );
        if ($validator->fails()){
            return array("status" => 400, "message" => "failed");
        }else{
            $data = $this->user->saveData($request,$date);
        }
        return array("status" => 1, "message" => "Successfully");
    }

    public function getUsersData(){
        $data = $this->user->getData();
        return view('Users::data')->with("data",$data);
    }
}    