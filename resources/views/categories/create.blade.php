@extends('base')

@section('content')
    <form action="{{route('user.categories.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">Create category</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="form-group" for="name">Title</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}" >

                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif

                    <span class="help-block"> </span>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                Save
            </button>
        </div>

    </form>
@endsection
