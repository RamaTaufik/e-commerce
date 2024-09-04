let timerOn = true;
let timeOut = 90;

function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.getElementById('timer').getElementsByTagName('span')[0].innerHTML = m + ':' + s;
    if(timeOut-remaining < 10) {
        document.getElementById('resend').innerHTML = "Kirim ulang dalam: " + (10 - (timeOut - remaining));
    } else {
        document.getElementById('resend').style.display = 'none';
        document.getElementById('resend-link').style.display = 'inline';
    }
    remaining -= 1;

    if(remaining >= 0 && timerOn) {
        setTimeout(function() {
            timer(remaining);
        }, 1000);
        return;
    }

    if(!timerOn) {
        // Do validate stuff here
        return;
    }

    // Do timeout stuff here
    document.getElementById('timer').innerHTML = "Kode anda sudah kadaluarsa";
    document.getElementsByTagName('button')[0].disabled = true;
}

timer(timeOut);