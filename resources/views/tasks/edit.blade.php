@extends('layouts.app')

@section('title', 'Post Edit')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2">
            <div class="panel panel-default border rounded bg-white mb-4 col-sm-6">
			
				<div class="panel-heading border-bottom text-center fw-bold p-3">
					Form Edit Task
				</div>
				
				<div class="panel-body p-3">
					<form method="POST" action="{{ url('task/update', $task->id ) }}">
						{{ csrf_field() }}
						<!-- Task Name -->
						<div class="form-group mb-3">
							<label for="task-name" class="col-sm-3 form-label">Task Name :</label>

							<div class="col-sm-12">
								<input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
							</div>
						</div>
						<!-- Add Task Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6 align-end">
								<button type="submit" class="btn btn-primary">
									Update Task
								</button>
							</div>
						</div>
					</form>
				</div>
	
			</div>
		</div>
	</div>
  
  	@if ($message = Session::get('success'))
	   <p class="text-success text-center">{{ $message }}</p>
	@endif
  
@endsection