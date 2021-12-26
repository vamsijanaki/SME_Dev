<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\Homework\Entities\InfixHomework;
use Modules\Homework\Entities\InfixAssignHomework;

class StudyMaterialController extends Controller
{
    public function myHomework(){
         if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {

            $homework_list=InfixAssignHomework::where('student_id',Auth::user()->id)->latest()->paginate(5);
       
            return view(theme('pages.myHomework'), compact('homework_list'));
        } catch (\Exception $e) {
            // dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
    public function myHomeworkDetails($id){
         if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            return view(theme('pages.homework_details'),compact('id'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
