@extends('layout')
@section('content')
    <div class="py-5 text-center">
        <h2>Welcome to Candonga</h2>
        <p class="lead">In Cuba, we call "Candonga" an street markets where you can find a wide variety of items at very low prices.</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form class="form-signin" method="POST" action="{{ route('login') }}">
                @csrf
                <p>Log in so you can see the sellers of our Candonga and what products they offer.</p>
                <div class="card mb-3">
                    <div class="card-body">
                        <p>Default credentials</p>
                        <b>User:</b> admin@candonga.com <b>Pass:</b> YourP@ssword
                    </div>
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" required="" autofocus="" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Let me in to Candonga</button>
            </form>
        </div>
        <div class="col-md-4 mb-4">
            <p>Scared by crowds. Try Candonga remotely using its simple RESTful API</p>
            <a href="https://documenter.getpostman.com/view/9689259/SWE3bepC?version=latest#49308999-3427-43aa-86cf-eff2875a06fe" class="btn btn-success" target="_blank">See API documentation</a>
        </div>
    </div>

@stop