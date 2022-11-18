@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 mx-auto">
            <div class="panel panel-default border rounded bg-white col-sm-6 mb-4">
                <div class="panel-heading border-bottom text-center fw-bold p-3">
                    Form Create Task
                </div>

                <div class="panel-body p-3">

                    <!-- New Task Form -->
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group mb-3">
                            <label for="task-name" class="form-label">Task Name :</label>

                            <div class="col-sm-12">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}" required>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

			@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p class="mb-0">{{ $message }}</p>
			</div>
			@endif

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default border rounded mb-3">
                    <div class="panel-heading border-bottom text-center fw-bold p-3 bg-light">
                        Tasks Data
                    </div>

                    <div class="panel-body p-3">
                        <table class="table table-striped task-table">
                            <thead>
                                <th class="align-middle">Task Name</th>
                                <th class="text-end" colspan="2">
									<form class="form" method="get" action="/search">
										<div class="form-group">
											<input type="text" name="search" class="form-control w-50 d-inline" placeholder="Keyword..." required>
                                            <button type="submit" class="btn btn-primary mx-1 mb-1">Search</button>
										</div>
									</form>
								</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text col-8"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td class="col-6 col-xs-3 text-end">
                                            <form action="{{url('task/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete') }} {{ $task->name }} {{ '?' }}')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
										<td class="col-2 text-end">
											<a href="{{url('task/edit')}}/{{$task->id}}" class="btn btn-success">Edit</a>
										</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        {{-- <br/>
                        Halaman: {{ $tasks->currentPage() }} <br/>
                        Jumlah Data : {{ $tasks->total() }} <br/>
                        Data Per Halaman : {{ $tasks->perPage() }} <br/>
                        
                        <div class="d-flex justify-content-center">
                            {!! $tasks->links() !!}
                        </div> --}}
                    </div>
                </div>
            @else
            <div class="panel panel-default border rounded mb-3">
                <div class="panel-heading border-bottom text-center fw-bold p-3 bg-light">
                    Tasks Data
                </div>

                <div class="panel-body p-3">
                    <table class="table table-striped task-table">
                        <thead>
                            <th class="align-middle">Task Name</th>
                            <th class="text-end" colspan="2">
                                <form class="form" method="get" action="/search">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control w-50 d-inline" placeholder="Keyword..." required>
                                        <button type="submit" class="btn btn-primary mx-1 mb-1">Search</button>
                                    </div>
                                </form>
                            </th>
                        </thead>
                    </table>
                    <div class="alert alert-danger">Data tidak ditemukan</div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection