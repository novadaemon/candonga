@extends('layout')

@section('content')
    <div class="py-5 text-center">
        <h2>Welcome to Candonga</h2>
        <p class="lead">In Cuba, we call street markets "Candonga" where you can find a wide variety of items at very low prices.</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form class="form-signin">
                <p>Sign in so you can see who has visited our Candonga and what products they have purchased</p>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" placeholder="Email address" required="" autofocus="">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" required="">
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Let me in to Candonga</button>
            </form>
        </div>
        <div class="col-md-4 mb-4">
            <p>Scared by multitutes. Try Candonga remotely using its simple RESTful API</p>
            <a href="https://documenter.getpostman.com/view/9689259/SWE3bepC?version=latest#49308999-3427-43aa-86cf-eff2875a06fe" class="btn btn-success" target="_blank">See API documentation</a>
        </div>
    </div>

@stop