<!DOCTYPE html>
<html lang="en">
<head>
     @include('components.metas') 
</head>
<body>
     <div class="container" style="height: 100vh;">
        <div class="row login-row">
        <div class="col-sm-12 col-lg-6 offset-lg-3">
            <form action="{{route('create.signup.step.one')}}" method="POST">
                {!! csrf_field() !!}
                <div class="login-container p-5">
                    <span>Step 1 of 2</span>
                    <h1 class="text-center">Sign Up</h1>
                    <div class="text-field mt-3">
                        <label for="first_name" class="fs-16 text-black">First Name <span class="required">*</span></label>
                        <input type="text" pattern="[A-Za-z]+" class="text-only form-control mt-2" id="first_name" placeholder="Enter your first name" name="first_name" required value={{isset($user_details['first_name']) ? $user_details['first_name'] : ''}}>
                    </div>  
                    <div class="text-field mt-3">
                        <label for="middle_name" class="fs-16 text-black">Middle Name</label>
                        <input type="text" pattern="[A-Za-z]+" class="text-only form-control mt-2" id="middle_name" placeholder="Enter your middle name" name="middle_name" value={{isset($user_details['middle_name']) ? $user_details['middle_name'] : ''}}>
                    </div>  
                    <div class="text-field mt-3">
                        <label for="last_name" class="fs-16 text-black">Last Name <span class="required">*</span></label>
                        <input type="text" pattern="[A-Za-z]+" class="text-only form-control mt-2" id="last_name" placeholder="Enter your last name" name="last_name" required value={{isset($user_details['last_name']) ? $user_details['last_name'] : ''}}>
                    </div>  
                    <div class="text-field mt-3">
                        <label for="email" class="fs-16 text-black">Email Address <span class="required">*</span></label>
                        <input type="email" class="form-control mt-2" id="email" placeholder="eg. test@mail.com" name="email" required value={{isset($user_details['email']) ? $user_details['email'] : ''}}>
                    </div>  
                    <div class="text-field mt-3">
                        <label for="mobile_number" class="fs-16 text-black">Mobile Number <span class="required">*</span></label>
                        <input minlength="11" maxlength="11" type="text" class="form-control mt-2" id="mobile_number" placeholder="eg. 09321320333" name="mobile_number" required value={{isset($user_details['mobile_number']) ? $user_details['mobile_number'] : ''}}>
                    </div>  
                    <div class="login-questions">
                        <div>
                            <span>Already have an account? <a href="{{route('login')}}">Sign in here</a></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary next-btn mt-3 w-100">Next</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    @include('components.reusables.toast') 
    @include('components.scripts') 
    @include('components.helper') 
    <script>
        $('#mobile_number').keypress(function(event) {
            if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
            }
        })

         $('.text-only').keypress(function(event) {
           if(!validateAlphabets(event.target.value)) {
            event.preventDefault();
           } 
        })
    </script>
</body>
</html>