<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illumina\Support\Facades\Storage;

class StudentController extends Controller
{
    //
    public function index(){
        return view('index');
    }

    //add student method ajax
    public function store(Request $request){
        $file = $request->file('avatar');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/images',$fileName);

        $stuData = [
            'student_id' => $request->student_id,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => $fileName,
        ];

        Student::create($stuData);


        return response()->json($stuData, 200);
    }
}
