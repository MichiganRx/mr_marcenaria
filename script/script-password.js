document.getElementById('togglePassword').addEventListener('click', function() {
    var senha = document.getElementById('senha');
    var olho = document.getElementById('olho-1');
    if (senha.type === 'password') {
        senha.type = 'text';
        olho.src = './assets/img/olho-fechado.png';
    } else {
        senha.type = 'password';
        olho.src = './assets/img/olho-aberto.png';
    }
});