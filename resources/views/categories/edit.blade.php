@extends('base')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('user.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">Edit categories</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="required" for="name">Title</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $category->name) }}">

                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif

                            <span class="help-block"> </span>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Save
                    </button>
                </div>
            </form>
            <form action="{{ route('user.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
            </form>
        </div>
    </div>

@endsection
