<!DOCTYPE html>
<html lang="en">
<head>
     @include('components.metas') 
</head>
<style>
    .signup-back-btn {
        cursor: pointer;
    }
</style>
<body>
     <div class="container" style="height: 100vh;">
        <div class="row login-row">
        <div class="col-sm-12 col-lg-6 offset-lg-3">
            <form action="{{route('create.signup.step.two')}}" method="POST">
                {!! csrf_field() !!}
                <div class="login-container p-5">
                    <p>Step 2 of 2</p>
                    <h1 class="text-center">Sign Up</h1>
                    <div class="text-field mt-3">
                        <label for="username" class="fs-16 text-black">Username <span class="required">*</span></label>
                        <input type="text" class="form-control mt-2" id="username" placeholder="eg. jdelacruz" name="username" required value={{isset($user_details['username']) ? $user_details['username'] : ''}}>
                    </div>  
                    <div class="text-field mt-3">
                        <label for="password" class="fs-16 text-black">Password <span class="required">*</span></label>
                        <input type="password" class="form-control mt-2" id="password" placeholder="Enter your password" name="password" required value={{isset($user_details['password']) ? $user_details['password'] : ''}}>
                    </div>  
                    <div class="invalid-feedback" style="display: block;">
                        <span class="password-error"></span>
                    </div>
                    <div class="text-field mt-3">
                        <label for="confirm_password" class="fs-16 text-black">Confirm Password <span class="required">*</span></label>
                        <input type="password" class="form-control mt-2" id="confirm_password" placeholder="Enter your confirm password" name="confirm_password" required value={{isset($user_details['confirm_password']) ? $user_details['confirm_password'] : ''}}>
                    </div>
                    <div class="invalid-feedback" style="display: block;">
                        <span class="confirm-password-error"></span>
                    </div>
                    <div class="d-flex justify-content center gap-3">
                        <button type="button" class="w-50 btn btn-primary signup-back-btn mt-3">Previous</button>
                        <button type="submit" class="w-50 btn btn-primary signup-btn mt-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    @include('components.reusables.toast') 
    @include('components.scripts') 
    @include('components.helper') 
    <script>
        $(document).ready(function() {
            const password = $('#password').val()
            const confirm_password = $('#confirm_password').val()
            const isInvalidPassword = validatePassword(password)
            if(isInvalidPassword) {
                $('.password-error').html(isInvalidPassword)
                $('.password-error').css("display", "block")
                $('.signup-btn').prop('disabled', true);
            } else {
                $('.password-error').html("")
                $('.password-error').css("display", "none")
            }
            if(password != '' && password != confirm_password) {
                $('.confirm-password-error').html('Password do not match.')
                $('.confirm-password-error').css("display", "block")
                $('.signup-btn').prop('disabled', true);
            } else {
                $('.confirm-password-error').html("")
                $('.confirm-password-error').css("display", "none")
            }

            if(password === confirm_password && !isInvalidPassword) {
                $('.signup-btn').prop('disabled', false);
            }
        });
        $('.signup-back-btn').click(function() {
            window.location.href = "{{ route('signup.step.one') }}";
        });

        $('#password').keyup(function() {
            const isInvalidPassword = validatePassword($(this).val())
            const password = $('#password').val()
            const confirm_password = $('#confirm_password').val()
            if(isInvalidPassword) {
                $('.password-error').html(isInvalidPassword)
                $('.password-error').css("display", "block")
                $('.signup-btn').prop('disabled', true);
            } else {
                $('.password-error').html("")
                $('.password-error').css("display", "none")
            }
            if(password != '' && password != confirm_password) {
                $('.confirm-password-error').html('Password do not match.')
                $('.confirm-password-error').css("display", "block")
                $('.signup-btn').prop('disabled', true);
            } else {
                $('.confirm-password-error').html("")
                $('.confirm-password-error').css("display", "none")
            }

            if(password != '' && confirm_password != '' && password === confirm_password && !isInvalidPassword) {
                $('.signup-btn').prop('disabled', false);
            }
        });
        $('#confirm_password').keyup(function() {
            const password = $('#password').val()
            const confirm_password = $('#confirm_password').val()
            if(password === '' || confirm_password === '' || password != confirm_password) {
                $('.confirm-password-error').html('Passwords do not match.')
                $('.confirm-password-error').css("display", "block")
                $('.signup-btn').prop('disabled', true);
            } else {
                $('.confirm-password-error').html("")
                $('.confirm-password-error').css("display", "none")
                $('.signup-btn').prop('disabled', false);
            }
        });
    </script>
</body>
</html>