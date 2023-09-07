<?php
$title = 'Change Password';
require __DIR__ . '/../header.php';

$indexPage = '../index.php';

if (!isset($_COOKIE['email'])) {
    header("Location: ../index.php");
}
?>

<body>

    <form onsubmit="submitValidation(event)" method="POST" class="needs-validation d-flex flex-column align-items-center justify-content-center vh-100" oninput='confirmPassword.setCustomValidity(confirmPassword.value != newPassword.value ? "Password do not match." : "")' novalidate>
        <h1>Change Password</h1>
        <div class="form-floating w-25 p-1">
            <input type="password" name="currentPassword" placeholder="" class="form-control" id="currentPassword" required>
            <label for="currentPassword">Current Password</label>
            <div id="invalid-current" class="invalid-feedback">Password is not valid</div>
        </div>
        <div class="form-floating w-25 p-1">
            <input type="password" name="newPassword" placeholder="" class="form-control" id="newPassword" required>
            <label for="newPassword">New Password</label>
            <div id="invalid-new" class="invalid-feedback">Please enter your new password</div>
        </div>
        <div class="form-floating w-25 p-1">
            <input type="password" name="confirmPassword" placeholder="" class="form-control" id="confirmPassword" required>
            <label for="confirmPassword">Confirm Password</label>
            <div id="invalid-confirm" class="invalid-feedback">Password does not match</div>
        </div>
        <div class="form-floating w-25 p-1 d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary m-3">Submit</button>
        </div>
        <div class="form-floating w-25 p-1 d-flex justify-content-center align-items-center">
            <a href="../game/startpage.php" class="btn btn-danger">Cancel</a>
        </div>
    </form>

    <script>
        window.history.forward(0);

        const invalidCurrent = document.getElementById('invalid-current');

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
                    invalidCurrent.classList.remove('d-block');
                    invalidCurrent.textContent = 'Password is not valid';
                    currentPassword.setCustomValidity('');
                    newPassword.setCustomValidity('');
                    form.classList.remove('was-validated');
                }
            }, false)
        })

        // Utilisation d'une fonction async pour pouvoir utiliser await
        async function submitValidation(event) {
            event.preventDefault();

            // Check if new password is different from current password
            const currentPassword = document.getElementById('currentPassword');
            const newPassword = document.getElementById('newPassword');
            const confirmPassword = document.getElementById('confirmPassword');

            if (currentPassword.value == newPassword.value) {
                newPassword.setCustomValidity(' ');
                document.getElementById('invalid-new').innerHTML = 'New password must be different from current password';
                return;
            }

            // verifie que les champs sont valides
            if (currentPassword.validity.valid && newPassword.validity.valid && confirmPassword.validity.valid) {
                const formData = new FormData(event.target);
                formData.append('email', '<?php echo $_COOKIE['email'] ?>');
                console.log(formData);
                try {
                    {
                        // Utilisation de fetch pour envoyer les données du formulaire au lieu de XMLHttpRequest
                        const response = await fetch('../../api/password-change.php', {
                            method: 'POST',
                            body: formData
                        })

                        const data = await response.json();
                        console.log(data);
                        if (data.status == 401) {
                            throw new Error(data.message);
                        } else if (data.status == 200) {
                            console.log(data);
                            // Show bootstrap alert with message
                            const alert = document.createElement('div');
                            alert.classList.add('alert', 'alert-success', 'alert-dismissible', 'fade', 'show', 'position-fixed', 'top-0', 'start-50', 'z-index-5', 'translate-middle-x');
                            alert.setAttribute('role', 'alert');
                            alert.textContent = data.message;
                            document.body.appendChild(alert);
                            setTimeout(() => {
                                window.location.href = '../game/startpage.php';
                            }, 1000);


                        }
                    }
                } catch (error) {
                    currentPassword.setCustomValidity(' ');
                    invalidCurrent.textContent = error.message;
                    invalidCurrent.classList.add('d-block');
                }
            }

        }
    </script>
</body>

</html>

<?php
require __DIR__ . '/../cookie-timeout.php';
