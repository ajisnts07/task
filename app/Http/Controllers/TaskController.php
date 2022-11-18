<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);

        // $tasks = Task::paginate(5);
        // return view('tasks.index', compact([
        //     'tasks' => $this->tasks->forUser($request->user())
        // ]));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
        ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        
        return redirect('/tasks');
    }

    public function edit($id)
    {
        $task = Task::whereId($id)->first();
        return view('tasks.edit')->with('task', $task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id)->update($request->all());
        return redirect('/tasks')->with('success', 'Update Oke');
    }

    public function destroy($id)
    {
        $task = Task::find($id)->delete($id);
        return redirect('/tasks')->with('success', 'Delete Oke');
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $task = $this->tasks->search($request->user(),$data['search']);
        return view('tasks.index')->with('tasks',$task);
    }
}
