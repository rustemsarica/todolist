<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoList;
class ToDoListController extends Controller
{
    public function index()
    {
        $tasks = ToDoList::query();
        $tasks = $tasks->where('is_deleted', 0)->orderBy('created_at')->get();
        return view('todolist',["tasks"=>$tasks]);
    }

    public function ajaxRequestDelete(Request $request)
    {
        $input = $request->all();
        $id=$input['id'];
        $task = ToDoList::query();
        return  $task = $task->where('id', $id)->update(['is_deleted' => 1]);
    }
    
    public function ajaxRequestStatus(Request $request)
    {
        $input = $request->all();
        $id=$input['id'];
        $task = ToDoList::query();
        $task = $task->where('id', $id)->first();
        if($task->status=="Completed"){
            return  $task = $task->where('id', $id)->update(['status' => "Waiting"]);
        }else{
            return  $task = $task->where('id', $id)->update(['status' => "Completed"]);
        }
        
    }

    public function ajaxRequestSearch(Request $request)
    {	
        $input = $request->all();
        $input_value=$input['input_value'];
    
        $data = array(
            'result' => 0,
            'response' => ''
        );
		
        if (!empty($input_value)) {
            $data['result'] = 1;
            $response = '<div class="search-results-tasks"><ul>';
			$tasks=ToDoList::query();
            $tasks = $tasks->where('task', 'like', '%'.$input_value.'%')->get();
				if(!empty($tasks)){
					foreach ($tasks as $task) {
						$response .= '<li>';
                    	$response .= $task->task;
                        $response .= '<b>'.$task->status.'</b></li>';
					}
				}
				$response .= '</ul></div>';
				$data['response'] = $response;
		}
        echo json_encode($data);
    }

    public function taskPost(Request $request)
    {
        $input = $request->all();
        ToDoList::add_task($input);
        return redirect()->back();
    }
}
