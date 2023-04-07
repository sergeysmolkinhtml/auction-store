@extends('base')

@section('content')
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
            <tr>
                <td>{{ $lot->title }}</td>
                <td>{{ $lot->description }}</td>
                <td>
                    @foreach($lot->categories as $category)
                        {{ $category->name }}
                    @endforeach</td>

                <td>{{ $lot->created_at->toDateString() }}</td>
                <td>{{ $lot->updated_at->toDateString() }}</td>
                <td>
                    <a class="btn btn-xs btn-info" href="{{route('user.lots.edit',$lot)}}">
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
        </tbody>
    </table>

@endsection
