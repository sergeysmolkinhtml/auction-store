@extends('base')

@section('content')
    <form action="{{route('user.lots.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">Create lot</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="title">Title</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                           type="text"
                           name="title"
                           id="title"
                           value="{{ old('title') }}" >
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif

                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="description">Description</label>
                    <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                           name="description" id="description" value="{{ old('description') }}" >
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <label for="categories">Category:</label>
                <select name="categories" id="categories" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>


        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                Save
            </button>
        </div>

    </form>
@endsection
