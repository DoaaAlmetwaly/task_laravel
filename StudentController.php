<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;


class StudentController extends Controller
{
    public function index(){

       if(auth()->check()){

       $data =   student::get();

       return view('Users.index',['data' => $data]);

        }/*else{
            return redirect(url('/Login'));
        }
*/
    }

  public function create(){



    return view('Users.create');
  }


   public function store(Request $request){

         # Validate Data .....
       $data =   $this->validate($request,[
             "name"     => "required|min:3",
             "password" => "required|min:6",
             "email"    => "required|email",
             "file"     => 'required||mimes:pdf'

         ]);



          //$data['password'] =  bcrypt($data['password']);

          if($request->file('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();

            // File upload location
            $location = 'files';

            // Upload file
            $file->move($location,$filename);
            $op =   student::create($data);
            if ($op) {
                $message = 'Raw Inserted';
            } else {
                $message = 'Error Try Again';
            }
        } else {
            $message = 'Error In Uploading file';
        }




        session()->flash('Message',$message);
        return redirect(url('/Users'));

   }





 public function edit($id){
        // code ....

           $data =student::find($id);


           return view('Users.edit',['data' => $data]);}




           public function update(Request $request){


          $data =   $this->validate($request,[
                "name"     => "required|min:3",
                "email"    => "required|email",
                "file"     => 'required||mimes:pdf'

            ]);
         if($request->file('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();

            // File upload location
            $location = 'files';

            // Upload file
            $file->move($location,$filename);
       $op =   student::where('id',$request->id)->update($data);

       if ($op) {
        $message = 'Raw updated';
    } else {
        $message = 'Error Try Again';
    }
} else {
    $message = 'Error In Uploading file';}


       session()->flash('Message',$message);

       return redirect(url('/Users'));



    }




     // delete item .....

     public function destroy($id){
      // code ....
     $op  =  student::where('id',$id)->delete();

     if($op){
         $message = "Raw Removed";
     }else{
         $message = "Error Try Again";
     }
    session()->flash('Message',$message);
     return redirect(url('/Users'));
    }


  # Auth .....

  /*public function Login(){
      return view('Users.login');
  }



  public function DoLogin(Request $request){
      // logic .....

      $data = $this->validate($request,[
          "email"    => "required|email",
          "password" => "required|min:6"
      ]);

      dd(auth()->attempt($data));

   /* if(auth()->attempt($data)){
        return redirect(url('/Users'));
    }else{
        return redirect('/Login');
    }*/

  }/*



  public function logout(){
      auth()->logout();
      return redirect(url('/Login'));

}
}
