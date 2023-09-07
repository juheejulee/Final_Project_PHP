<script type="text/javascript">
    let timer, currSeconds = 0;

    function resetTimer() {
        /* Clear the previous interval */
        clearInterval(timer);

        /* Reset the seconds of the timer */
        currSeconds = 0;

        /* Set a new interval */
        timer =
            setInterval(startIdleTimer, 1000);
    }

    // Define the events that
    // would reset the timer
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer;
    window.ontouchstart = resetTimer;
    window.onclick = resetTimer;
    window.onkeypress = resetTimer;

    function startIdleTimer() {
        console.log(currSeconds)

        /* Increment the
            timer seconds */
        currSeconds++;

        /* If currSeconds reach 900
            (15 minutes), clear email cookie,
             redirect the
            user and reset the timer */
        if (currSeconds == 900) {
            document.cookie = `email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=localhost`;
            const alert = document.createElement('div');
            alert.classList.add('alert', 'alert-success', 'alert-dismissible', 'fade', 'show', 'position-fixed', 'top-0', 'start-50', 'z-index-5', 'translate-middle-x');
            alert.setAttribute('role', 'alert');
            alert.textContent = "You have been logged out due to inactivity";
            document.body.appendChild(alert);
            setTimeout(() => {
                window.location.href = "<?php echo $indexPage ?>";
            }, 3000);
        }
    }
</script>