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
                        <td>
                            @foreach($lot->categories as $category)
                                {{ $category->name }}
                            @endforeach</td>

                        <td>{{ $lot->created_at->toDateString() }}</td>
                        <td>{{ $lot->updated_at->toDateString() }}</td>
                        <td>
                            <a class="btn btn-xs btn-info" href="{{route('user.lots.edit',$lot->id)}}">
                                Edit
                            </a>
                            <form action="" method="POST" onsubmit="return confirm('Are your sure?');"
                                  style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
                <form action="{{route('user.lots.index')}}" method="get">
                    <div class="mb-3">
                        <div class="form-label">Filter category</div>
                        <input name="search_field"
                               @if(isset($_GET['search_field']))
                                   value="{{$_GET['search_field']}}"
                               @endif
                               type="text" class="form-control"
                               id="formControlInput"
                               placeholder="Search">
                        <select name="category_id"
                                class="form-select form-select sm"
                                aria-label=".form-select-sm example"
                                id="">
                            <option></option>
                            @foreach($lot->categories as $cat)
                                <option value="{{$cat->id}}" @if(isset($_GET['category_id']))
                                    @if($_GET['category_id'] == $category->id)
                                        selected
                                    @endif
                                    @endif>
                                    {{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
                </tbody>
            </table>


        </div>
    </div>

@endsection

