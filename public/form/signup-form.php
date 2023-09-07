<?php
$title = 'Sign Up';
require __DIR__ . '/../header.php';

if (isset($_COOKIE['email'])) {
    header("Location: ../game/game.php");
    exit;
}
?>

<body>
    <form onsubmit="submitValidation(event)" method="POST" class="needs-validation d-flex flex-column align-items-center justify-content-center vh-100" oninput='confirmPassword.setCustomValidity(confirmPassword.value != pwd.value && pwd.value ? "Passwords do not match." : "")' novalidate>
        <h1>Sign Up</h1>
        <div class="form-floating w-25 p-1">
            <input type="text" name="name" placeholder="" class="form-control" id="name" required>
            <label for="name">First Name</label>
            <div class="invalid-feedback">Please enter your name</div>
        </div>
        <div class="form-floating w-25 p-1">
            <input type="text" name="lname" placeholder="" class="form-control" id="lname" required>
            <label for="lname">Last Name</label>
            <div class="invalid-feedback">Please enter your last name</div>
        </div>
        <div class="form-floating w-25 p-1">
            <input type="email" name="email" placeholder="" class="form-control" id="email" required>
            <label for="email">Email address</label>
            <div id="invalid-email" class="invalid-feedback">Please enter a valid email</div>
        </div>
        <div class="form-floating w-25 p-1">
            <input type="password" name="pwd" placeholder="" class="form-control" id="password" required>
            <label for="password">Password</label>
            <div class="invalid-feedback">Please enter your password</div>
        </div>
        <div class="form-floating w-25 p-1">
            <input type="password" name="confirmPassword" placeholder="" class="form-control" id="confirmPassword" required>
            <label for="confirmPassword">Confirm Password</label>
            <div id="invalid-confirm" class="invalid-feedback">Password does not match</div>
        </div>
        <div class="form-floating w-25 p-1 d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary m-3">Sign Up</button>
        </div>
        <a href="../index.php" class="btn btn-danger">Go Back</a>
    </form>

    <script>
        window.history.forward(0);

        let forms = document.querySelectorAll('.needs-validation');
        forms.forEach((form) => {
            form.addEventListener("submit", (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false)

            form.addEventListener("input", (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.remove('was-validated');
                }
            }, false)

        })

        async function submitValidation(event) {
            event.preventDefault();
            // get email input
            const email = document.querySelector('#email');
            const invalidEmail = document.querySelector('#invalid-email');
            const pwd = document.querySelector('#password');
            // check if email input is valid
            if (email.validity.valid && pwd.validity.valid && confirmPassword.validity.valid) {
                try {
                    {
                        const response = await fetch('../../api/signup.php', {
                            method: 'POST',
                            body: new FormData(event.target),
                        })

                        const data = await response.json();
                        if (data.status == 409) {
                            throw new Error(data.message);
                        } else {
                            const alert = document.createElement('div');
                            alert.classList.add('alert', 'alert-success', 'alert-dismissible', 'fade', 'show', 'position-fixed', 'top-0', 'start-50', 'z-index-5', 'translate-middle-x');
                            alert.setAttribute('role', 'alert');
                            alert.textContent = "Sign up successful! Redirecting to start page";
                            document.body.appendChild(alert);
                            document.cookie = `email=${email.value}; max-age=900; path=/; domain=localhost`;
                            setTimeout(() => {
                                window.location.href = `../game/startpage.php`;
                            }, 1000);
                        }
                    }
                } catch (error) {
                    console.log(error);
                    email.validity.valid = false;
                    email.setCustomValidity(error.message);
                    invalidEmail.textContent = error.message;
                    invalidEmail.classList.add('d-block');
                    email.addEventListener('input', () => {
                        invalidEmail.classList.remove('d-block');
                        invalidEmail.textContent = 'Please enter a valid email';
                    }, false)
                }
            }

        }
    </script>
</body>

</html>