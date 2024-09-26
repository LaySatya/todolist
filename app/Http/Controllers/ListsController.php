<?php

namespace App\Http\Controllers;
use Flasher\Toastr\Prime\ToastrInterface;
use \Illuminate\Validation\ValidationException;
use App\Models\Lists;
use Illuminate\Http\Request;

class ListsController extends Controller
{   
    // show all tasks
    public function lists(){
        $lists = Lists::all();
        return view('lists', compact('lists'));
    }

    // add new task
    public function storeLists(Request $request){
        // Validate input fields
        try{
            $attributes = $request->validate([
                'title' => 'required',
                'description' => 'nullable'
            ]);
            Lists::create($attributes);
            toastr()->closeButton()->addSuccess('List created successfully.');
            return redirect('/');

        }catch (ValidationException $e) {
            // Show error message using toastr if validation fails
            toastr()->closeButton()->warning('Please fill the task title.');

            // Redirect back to the previous page with input data and errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
       
    }
    //  delete task
    public function deleteList($id){
        Lists::destroy($id);
        toastr()->closeButton()->addSuccess('List deleted successfully.');
        return redirect('/');
    }

    // edit task
    public function editList($id){
        $list = Lists::find($id);
        $list->update(['isDone' => true]);
        toastr()->closeButton()->addSuccess('This list marked as done.');
        return redirect('/');
    }

    // filter tasks which are done tasks

    public function filterLists($status){
        $isDone = $status === 'done' ? true : false;
        $lists = Lists::where('isDone', $isDone)->get();
        return view('lists', compact('lists'));
    }
    
}
