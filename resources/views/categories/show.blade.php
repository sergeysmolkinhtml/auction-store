@extends('base')

@section('content')
    <table class="table table-responsive-sm table-striped">
        <thead>
        <tr>
            <th>Title</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $category->name }}</td>
        </tr>
        </tbody>
    </table>
    <a class="btn btn-xs btn-info" href="{{route('user.categories.edit',$category)}}">
        Edit
    </a>
    <form action="{{route('user.categories.destroy',$category)}}" method="POST"
          onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
    </form>
@endsection
