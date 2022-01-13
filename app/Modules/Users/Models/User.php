<?php
namespace App\Modules\Users\Models;
use App\Modules\Users\Models\User;
use DB;
use Session;
use Log;
use Illuminate\Support\Str;
class User {
    protected $table = 'users';

    protected $fillable =["first_name","surname","number","gender","date","comments","email"];

    public function saveData($request,$date){
      $details = array(
        'first_name'=>$request['name'],
        'surname'=>$request['surname'],
        'number'=>$request['number'],
        'gender'=>$request['gender'],
        'comments'=>$request['comments'],
        'email'=>$request['email'],
         'date'=> $date,
        'created_at'=>date('Y-m-d H:i:s'),
        'updated_at'=>date('Y-m-d H:i:s'),
      );
      $query = DB::table('users')->insertGetId($details);
      return $query;
    }
    public function getData(){
      $users = DB::table('users')
                ->orderBy('id', 'desc')
                ->get();
      return $users;
    }
}


