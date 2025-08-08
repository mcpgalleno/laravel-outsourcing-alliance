<!DOCTYPE html>
<html lang="en">
<head>
     @include('components.metas') 
</head>
<body>
     <div class="container" style="height: 100vh;">
        <div class="row login-row">
        <div class="col-sm-12 col-lg-6 offset-lg-3">
            <form action="{{route('handle.login')}}" method="POST">
                {!! csrf_field() !!}
                <div class="login-container p-5">
                    <h1 class="text-center">Sign In</h1>
                    <div class="text-field mt-3">
                        <label for="email" class="fs-16 text-black">Email Address</label>
                        <input type="email" class="form-control mt-2" id="email" placeholder="Enter your email address" name="email" required>
                    </div>  
                    <div class="text-field mt-3">
                        <label for="password" class="fs-16 text-black">Password</label>
                        <input type="password" class="form-control mt-2" id="password" placeholder="Enter your password" name="password" required>
                    </div>  
                    <div class="login-questions d-flex justify-content-between mt-2">
                        <div>
                            <span>Don't have an account? <a href="{{route('signup.step.one')}}">Sign up here</a></span>
                        </div>
                        <div>
                            <span><a href="#">Forgot password?</a></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary login-btn mt-3 w-100">Sign In</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@include('components.reusables.toast') 
@include('components.scripts') 
</body>
</html>