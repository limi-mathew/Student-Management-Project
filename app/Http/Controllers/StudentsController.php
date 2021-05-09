<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::all();
        $count= Student::all()->count();
        return view('students.index')->with(compact('students','count')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name'=>['required','min:3','max:255'],
            'reporting_teacher'=>'required',
            'gender'=>'required',
            'age'=>'required',
        ],
        [  'name.required'=>'Please enter Name',
           'reporting_teacher.required'=>'Please select Reporting Teacher',
           'gender.required'=>'Please select Gender.',
           'age.required'=>'Please enter the Age',
           'name.min'=>'Please enter atleast 3 character'
          
        ]);
        
         if ($validator->passes()) {
        $students=new Student;
        $students->name=request("name");
        $students->age=request("age");
        $students->gender=request("gender");
        $students->reporting_teacher=request("reporting_teacher");
        $students->save();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Student was successfully added!');
          
        }else {
            return back()->withErrors($validator)
                    ->withInput();
       }
        
        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students=Student::find($id);
        return view('students.show',["students"=>$students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students=Student::find($id);
        return view('students.edit',["students"=>$students]);  
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
        $validator = Validator::make($request->all(), [
            'name'=>['required','min:3','max:255'],
            'reporting_teacher'=>'required',
            'gender'=>'required',
            'age'=>'required'
        ]);
       if ($validator->passes()) { 
        $students=Student::find($id);
        $students->name=request("name");
        $students->age=request("age");
        $students->gender=request("gender");
        $students->reporting_teacher=request("reporting_teacher");
        $students->save(); 
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Student was successfully updated!');
       return redirect('/students');

        }else{  
            return back()->withErrors($validator)
                    ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
         $student=Student::find($id);
         $student->delete();
         $request->session()->flash('message.level', 'success');
         $request->session()->flash('message.content', 'Student was successfully deleted!');
        return redirect('/students');    }
}
