// Function to check password match
function checkPasswordMatch() {
    var password1 = document.getElementById("exampleInputPassword1").value;
    var password2 = document.getElementById("exampleInputPassword2").value;
    var minNbrError = document.getElementById("min_number_error");
    var matchError = document.getElementById("match_error");
    var submitButton = document.getElementById("submitButton");


    // Check if passwords have at least 8 characters
    if (password1.length < 8) {
        minNbrError.textContent = "The password must contain at least 8 characters!";
        minNbrError.style.color = "red";
        submitButton.disabled = true;
    } else {
        minNbrError.textContent = "Password is valid."; // Clear the error message if the condition is met
        minNbrError.style.color = "green";
        submitButton.disabled = false;
    }

    // Check if passwords match
    if (password1 !== password2) {
        matchError.textContent = "Passwords do not match!";
        matchError.style.color = "red";
        submitButton.disabled = true;
    }else if (password2 == ""){
        matchError.textContent = "";
    } 
    else {
        
            matchError.textContent = "Passwords matched. You can register now.";
            matchError.style.color = "green";
            submitButton.disabled = false;
    }
    }




    // Event listeners to check password match on input change
    document.getElementById("exampleInputPassword1").addEventListener("input", checkPasswordMatch);
    document.getElementById("exampleInputPassword2").addEventListener("input", checkPasswordMatch);

    // Prevent form submission on Enter key press
    document.getElementById("passwordForm").addEventListener("keypress", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    });