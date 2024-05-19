document.getElementById('CheckPresencial').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('CheckOnline').checked = false;
    }else{
        document.getElementById('CheckOnline').checked = true;
    }
});

document.getElementById('CheckOnline').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('CheckPresencial').checked = false;
    }else{
        document.getElementById('CheckPresencial').checked = true;
    }
});