@extends('layout')

@section('content')

    <section id="form">
        <!--form-->
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Login to your account</h2>
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                        echo $message;
                        Session::put('message', null);
                        } 
                        ?>
                        <form action="{{ URL::to('/login-customer') }}" method="POST">
                            @csrf
                            <input type="email" placeholder="Email" name="email_account" required />
                            <input type="password" placeholder="Password" name="password_account" required />
                            <span>
                                <input type="checkbox" class="checkbox">
                                Keep me signed in
                            </span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{ URL::to('/add-customer') }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Name" name="name_account" required />
                            <input type="email" placeholder="Email Address" name="email_account" required />
                            <input type="text" placeholder="Phone" name="phone_account" required>
                            <input type="password" placeholder="Password" name="password_account" required />
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
@endsection
