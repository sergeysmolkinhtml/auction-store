@extends('base')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{route('user.lots.create')}}">
                Create lot
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Lots list</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-responsive-sm table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($lots as $lot)
                    <tr>
                        <td>{{ $lot->title }}</td>
                        <td>{{ $lot->description }}</td>
                        <td>{{ $lot->category_id }}</td>
                        <td>{{ $lot->created_at->toDateString() }}</td>
                        <td>{{ $lot->updated_at->toDateString() }}</td>
                        <td>
                            <a class="btn btn-xs btn-info" href="">
                                Edit
                            </a>
                            @can('delete')
                                <form action="" method="POST" onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>

@endsection

