document.getElementById('CheckPresencial').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('CheckOnline').checked = false;
    }
});

document.getElementById('CheckOnline').addEventListener('change', function() {
    if (this.checked) {
        document.getElementById('CheckPresencial').checked = false;
    }
});