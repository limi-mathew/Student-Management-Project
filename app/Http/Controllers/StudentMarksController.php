<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Support\Facades\Validator;
use DB;

class StudentMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::all();
        $results = DB::table('students')
        ->join('student_marks', 'students.id', '=', 'student_marks.student_id')
        ->select('students.*', 'student_marks.*')
        ->get();
        $count= StudentMarks::all()->count();
        return view('studentsmark.index')->with(compact('students','results','count')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
         $students=Student::all();
         return view('studentsmark.create')->with('students',$students);
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
            'student_id'=>'required',
            'term'=>'required',
            'maths'=>'required',
            'history'=>'required',
            'science'=>'required',
            'total_marks'=>'required'
        ],
        [  'student_id.required'=>'Please select Student',
           'term.required'=>'Please select Term',
           'maths.required'=>'Please enter Maths mark',
           'history.required'=>'Please enter History mark',
           'science.required'=>'Please enter Science mark'
          
        ]);
        // echo 'd';die;
         if ($validator->passes()) { 
        $student_marks=new StudentMarks;
        $student_marks->student_id=request("student_id");
        $student_marks->term=request("term");
        $student_marks->maths=request("maths");
        $student_marks->science=request("science");
        $student_marks->history=request("history");
        $student_marks->total_marks=request("total_marks");
        $student_marks->save();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Student marks was successfully added!');
          
        }else {
        return back()->withErrors($validator)->withInput();
       }  
         return redirect('/studentmarks');  
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
        return view('studentmarks.show',["students"=>$students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students=Student::all();
        $studentmarks=StudentMarks::find($id);
        return view('studentsmark.edit')->with(compact('students','studentmarks')); 
        
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
            'student_id'=>'required',
            'term'=>'required',
            'maths'=>'required',
            'history'=>'required',
            'science'=>'required',
            'total_marks'=>'required'
        ],
        [  'student_id.required'=>'Please select student',
           'term.required'=>'Please select Term',
           'maths.required'=>'Please enter marks.',
           'history.required'=>'Please enter marks',
           'science.required'=>'Please enter marks'
          
        ]);
       if ($validator->passes()) { 
        $student_marks=StudentMarks::find($id);
        $student_marks->student_id=request("student_id");
        $student_marks->term=request("term");
        $student_marks->maths=request("maths");
        $student_marks->science=request("science");
        $student_marks->history=request("history");
        $student_marks->total_marks=request("total_marks");
        $student_marks->save();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Student was successfully edited!');
        }else {
        return back()->withErrors($validator)->withInput();
       } 
        return redirect('/studentmarks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {    
        
         $studentmarks=StudentMarks::find($id);
         $studentmarks->delete();
         $request->session()->flash('message.level', 'success');
         $request->session()->flash('message.content', 'Student was successfully deleted!');
        return redirect('/studentmarks');    }
}
