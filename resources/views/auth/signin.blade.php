<x-layout>
    <h1 class="display-4 text-center my-3">login form</h1>
    <form class="col-md-5 mx-auto" action="{{ route('authenticate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email' )}}">
            @if ($errors->has('email'))
                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
            @endif
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
            @if ($errors->has('password'))
                <small class="form-text text-danger">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <input type="submit" class="btn btn-dark w-100 btn-block" value="Enter">
    </form>
    <p class="text-muted text-center my-2">- OR -</p>
    <div class="w-100 mt-2 text-center">
        <a href="{{ route('signup') }}" class="btn btn-success col-md-5">Create New Account</a>
    </div>
</x-layout>
