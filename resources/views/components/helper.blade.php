<script>

  function validateAlphabets(inputString) {
    const key = event.keyCode;
    return /[a-z]/i.test(event.key);
  }

  function validatePassword(password) {
      const minLength = 8;
      const hasLowerCase = /[a-z]/.test(password);
      const hasUpperCase = /[A-Z]/.test(password);
      const hasNumber = /[0-9]/.test(password);
      const hasSpecialChar = /[!@#$%^&*()]/.test(password);

      if(password.length > 0) {
        if (password.length < minLength) {
          return "Password must be at least " + minLength + " characters long.";
        }
        if (!hasLowerCase) {
            return "Password must contain at least one lowercase letter.";
        }
        if (!hasUpperCase) {
            return "Password must contain at least one uppercase letter.";
        }
        if (!hasNumber) {
            return "Password must contain at least one number.";
        }
        if (!hasSpecialChar) {
            return "Password must contain at least one special character.";
        }
      }

      if(password.length === 0) {
        return " ";
      }
      
      return ""; // No errors
  }

</script>