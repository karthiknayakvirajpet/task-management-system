@extends('base')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Show Task</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="/index-task">
                                <button type="button" class="btn btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive pl-3 pr-3 pt-3">
                    <table class="table table-bordered table-hover table-striped" id="product_list">
                        <tr><th>Title</th><td>{{ $task->title }}</td></tr>
                        <tr><th>Description</th><td>{{ $task->description }}</td></tr>
                        <tr><th>Deadline</th><td>{{ $task->deadline }}</td></tr>
                        <tr><th>Progress</th><td>{{ $task->progress }}</td></tr>
                        <tr><th>Status</th><td>{{ $task->is_completed == 0 ? 'Pending' : 'Completed' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection