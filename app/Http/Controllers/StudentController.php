<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Validator;
use Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['student']    = Student::paginate(5);
        return view('student.index',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|max:255|unique:users',
            'name'=>'required|max:255',
            'gender'=>'required',
            'phone'=>'required|digits_between:10,12',
            'avatar'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if($request->file('avatar')->isValid())
        {
            $avatarFile = $request->file('avatar');
            $extension  = $avatarFile->getClientOriginalExtension();
            $fileName   = "student-avatar/".date('YmdHis').".".$extension;
            $uploadPath = env('UPLOAD_PATH')."/student-avatar";
            $request->file('avatar')->move($uploadPath,$fileName);
            $input['avatar'] = $fileName;
        }

         $input['password'] = password_hash($request->get('email'),PASSWORD_BCRYPT);
         Student::create($input);

         return redirect()->route('student.index')->with('status','Student SuccessFully Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['student']    = Student::findOrFail($id);

        return view('student.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataStudent    = Student::findOrFail($id);

         $validator = Validator::make($request->all(),[
            'name'=>'required|max:255',
            'gender'=>'required',
            'status'=>'required',
            'phone'=>'required|digits_between:10,12',
            'avatar'=>'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);

         if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                Storage::disk('upload')->delete($dataStudent->avatar);
                $avatarFile = $request->file('avatar');
                $extension  = $avatarFile->getClientOriginalExtension();
                $fileName   = "student-avatar/".date('YmdHis').".".$extension;
                $uploadPath = env('UPLOAD_PATH')."/student-avatar";
                $request->file('avatar')->move($uploadPath,$fileName);
                $input['avatar']    = $fileName;

            }
        }

        $dataStudent->update($input);

        return redirect()->route('student.index')->with('status','Student SuccessFully Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resetPassword($id)
    {

        
        $dataStudent = Student::findOrFail($id);
        
        $dataStudent->update(['password'=> password_hash($dataStudent->email,PASSWORD_BCRYPT)]);

        return redirect()->back()->with('status','Student Password Has Been Reset');

    }
}
