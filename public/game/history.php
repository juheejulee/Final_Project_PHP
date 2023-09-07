<?php
$title = 'Results';
require __DIR__ . '/../header.php';

$email = $_COOKIE['email'];
?>


<div class="container-fluid  d-flex flex-column align-items-center justify-content-center vh-100 w-50">
    <h1 class="text-warning mb-3">Results</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">User id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Game Result</th>
                <th scope="col">Level Completed</th>
                <th scope="col">Lives Remaining</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <a class="btn btn-danger m-3" href="startpage.php?abandon=true" name="abandon">Go Back</a>
</div>

<script>
    (async function getResults() {
        const email = '<?php echo $email; ?>';
        const formData = new FormData();
        formData.append('email', email);
        const response = await fetch('../../api/get-results.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        console.log(data.result);
        if (data.result.length == 0) {
            // show bootstrap alert
            const div = document.createElement('div');
            div.classList.add('alert', 'alert-danger', 'position-absolute', 'start-50', 'translate-middle-x', 'top-0', 'text-center', 'text-uppercase', 'fw-bold');
            div.textContent = 'No results found';
            document.querySelector('body').prepend(div);
            setTimeout(() => {
                div.remove();
            }, 3000);
        } else if (data.result.length > 0) {

            const tbody = document.querySelector('tbody');
            data.result.forEach(result => {
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                td1.textContent = result.id;
                const td2 = document.createElement('td');
                td2.textContent = result.name;
                const td3 = document.createElement('td');
                td3.textContent = result.lname;
                const td4 = document.createElement('td');
                td4.textContent = result.won;
                const td5 = document.createElement('td');
                td5.textContent = result.levelCompleted;
                const td6 = document.createElement('td');
                td6.textContent = result.tries;
                const td7 = document.createElement('td');
                td7.textContent = result.date;
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td7);
                tbody.appendChild(tr);
            });
        }
    })();
</script>