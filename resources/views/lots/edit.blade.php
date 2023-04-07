@extends('base')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('user.lots.update', $lot) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">Edit lot</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="required" for="title">Title</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                   type="text"
                                   name="title"
                                   id="title"
                                   value="{{ old('title', $lot->title) }}">

                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif

                            <span class="help-block"> </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="description">Description</label>
                        <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                               type="text"
                               name="description"
                               id="description"
                               value="{{ old('description',$lot->description) }}">

                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                        <span class="help-block"> </span>
                        <label for="categories">Category:</label>
                        <select name="categories"
                                id="categories"
                                multiple
                        >
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <form action="{{ route('user.lots.destroy', $lot) }}" method="POST" onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                    </form>
                    <button class="btn btn-primary" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
