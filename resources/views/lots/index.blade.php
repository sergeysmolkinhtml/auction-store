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
                @if(isset($lots))
                    @foreach($lots as $lot)
                        <tr>
                            <td>{{ $lot->title }}</td>
                            <td>{{ $lot->description }}</td>
                            <td>
                                @foreach($lot->categories as $category)
                                    {{ $category->name }}
                                @endforeach
                            </td>
                            <td>{{ $lot->created_at->toDateString() }}</td>
                            <td>{{ $lot->updated_at->toDateString() }}</td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{route('user.lots.edit',$lot->id)}}">
                                    Edit
                                </a>
                                <form action="{{route('user.categories.destroy',$lot->id)}}" method="POST"
                                      onsubmit="return confirm('Are your sure?');"
                                      style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <form action="{{route('user.lots.index')}}" method="get">
                {{-- Choose category --}}
                <div class="mb-3">
                    @foreach($categories as $cat)
                    <label for="categories">
                    <input type="checkbox" id="categories" name="categories" value="{{$cat->id}}">
                            {{$cat->name}}
                    </label>
                    <br>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <p>Filtered lots</p>
        {{$lots->pluck('title')}}
        </div>
    </div>
@endsection

