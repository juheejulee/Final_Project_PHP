<?php
$title = 'Sign In';
require __DIR__ . '/../header.php';

if (isset($_COOKIE['email'])) {
    header("Location: ../game/startpage.php");
    exit;
}
?>

<body>

    <form onsubmit="submitValidation(event)" method="POST" class="needs-validation d-flex flex-column align-items-center justify-content-center vh-100" novalidate>
        <h1>Sign In</h1>
        <div class="form-floating w-25 p-1">
            <input type="email" name="email" placeholder="Enter your email" class="form-control" id="email" required>
            <label for="email">Email address</label>
            <div id="invalid-email" class="invalid-feedback">Please enter a valid email</div>
        </div>
        <div class="form-floating w-25 p-1">
            <input type="password" name="pwd" placeholder="Enter your password" class="form-control" id="password" required>
            <label for="password">Password</label>
            <div id="invalid-password" class="invalid-feedback">Please enter your password</div>
        </div>
        <div class="form-floating w-25 p-1 d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary m-3">Sign In</button>
        </div>
        <a href="../index.php" class="btn btn-danger">Go Back</a>
    </form>

    <script>
        window.history.forward(0);

        const email = document.querySelector('#email');
        const invalidEmail = document.querySelector('#invalid-email');
        const password = document.querySelector('#password');
        const invalidPassword = document.querySelector('#invalid-password');

        let forms = document.querySelectorAll('.needs-validation');
        forms.forEach((form) => {
            form.addEventListener("submit", (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                }
            }, false)

            form.addEventListener("input", (event) => {
                email.setCustomValidity('');
                email.classList.remove('is-invalid');
                invalidEmail.classList.remove('d-block');
                invalidEmail.textContent = "Please enter a valid email";
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.remove('was-validated');
                }
            }, false)

        })

        // Utilisation d'une fonction async pour pouvoir utiliser await
        async function submitValidation(event) {
            event.preventDefault();
            // get email input
            // check if email input is valid
            if (email.validity.valid && password.validity.valid) {
                try {
                    {
                        // Utilisation de fetch pour envoyer les données du formulaire au lieu de XMLHttpRequest
                        const response = await fetch('../../api/signin.php', {
                            method: 'POST',
                            body: new FormData(event.target),
                        })

                        const data = await response.json();
                        console.log(data.status);
                        if (data.status == 401) {
                            throw new Error(data.message);
                        } else { // Show bootstrap alert with message
                            const alert = document.createElement('div');
                            alert.classList.add('alert', 'alert-success', 'alert-dismissible', 'fade', 'show', 'position-fixed', 'top-0', 'start-50', 'z-index-5', 'translate-middle-x');
                            alert.setAttribute('role', 'alert');
                            alert.textContent = "You have successfully signed in!";
                            document.body.appendChild(alert);
                            // set email cookie that expires after 15 min of inactivity with localhost as domain
                            document.cookie = `email=${email.value}; max-age=900; path=/; domain=localhost`;
                            setTimeout(() => {
                                window.location.href = `../game/startpage.php`;
                            }, 1000);
                        }
                    }
                } catch (error) {
                    console.log(error);
                    email.setCustomValidity(error.message);
                    email.classList.add('is-invalid');
                    invalidEmail.textContent = error.message;
                    invalidEmail.classList.add('d-block');
                }
            }
        }
    </script>
</body>

</html>