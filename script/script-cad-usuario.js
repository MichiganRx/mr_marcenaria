window.onload = function() {
    const initCustomSelect = (selectContainer, hiddenInputId) => {
        const selected = selectContainer.querySelector('.select-selected');
        const items = selectContainer.querySelector('.select-items');
        const options = selectContainer.querySelectorAll('.select-option');
        const hiddenInput = document.getElementById(hiddenInputId);
        const icon = selected.querySelector('i');

        selected.addEventListener('click', () => {
            items.classList.toggle('select-hide');
            selected.classList.toggle('select-arrow-active');
        });

        options.forEach(option => {
            option.addEventListener('click', () => {
                selected.childNodes[0].textContent = option.textContent + " ";
                hiddenInput.value = option.dataset.value;
                selected.appendChild(icon);
                items.classList.add('select-hide');
                selected.classList.remove('select-arrow-active');
                checkUserFields();
            });
        });

        document.addEventListener('click', (event) => {
            if (!event.target.matches('.select-selected') && !event.target.matches('.select-selected *')) {
                items.classList.add('select-hide');
                selected.classList.remove('select-arrow-active');
            }
        });
    };

    initCustomSelect(document.getElementById('cargo-select'), 'cargo');

    const cargoErrorMessage = document.getElementById('error-message');
    const cargoForm = document.getElementById('cadastroCargoForm');

    const checkCargoFields = () => {
        const cargoNome = document.getElementById('cargo_nome').value.trim();

        if (cargoNome) {
            cargoErrorMessage.style.display = 'none';
        } else {
            cargoErrorMessage.style.display = 'flex';
        }
    };

    document.getElementById('cargo_nome').addEventListener('input', checkCargoFields);

    cargoForm.addEventListener('submit', (event) => {
        const cargoNome = document.getElementById('cargo_nome').value.trim();

        if (!cargoNome) {
            event.preventDefault();
            cargoErrorMessage.style.display = 'flex';
        } else {
            document.getElementById('cadastroCargo').style.display = 'none';
            const card = new Card('Sucesso!', 'Cargo cadastrado.');
            const app = document.getElementById('app');
            app.appendChild(card.render()); 
            cargoErrorMessage.style.display = 'none';
        }
    });

    const openModal = () => {
        document.getElementById('cadastroCargo').style.display = 'flex';
        cargoErrorMessage.style.display = 'none';
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    };

    const closeModal = () => {
        document.getElementById('cadastroCargo').style.display = 'none';
        cargoErrorMessage.style.display = 'none';
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
    };

    document.getElementById('btnAdicionarCargo').addEventListener('click', openModal);
    document.getElementById('btnFecharCadastro').addEventListener('click', closeModal);
};

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("cadUsuario").addEventListener("submit", function(event) {
        var nome = document.getElementById("nome_usuario").value;
        var login = document.getElementById("login").value;
        var senha = document.getElementById("senha").value;
        var senha_confirma = document.getElementById("confirmacao-senha").value;
        var cargo = document.getElementById("cargo").value;

        if (nome === "" || login === "" || senha === "" || senha_confirma === "" || cargo === "") {
            document.getElementById("error-message-user").style.display = "flex";
            event.preventDefault();
            return;
        }

        if (senha !== senha_confirma) {
            document.getElementById("error-message-senha").style.display = "flex";
            event.preventDefault();
            return;
        }else{
            const card = new Card('Sucesso!', 'Usuario cadastrado.');
            const app = document.getElementById('app');
            app.appendChild(card.render()); 
        }

    });

    var inputs = document.querySelectorAll("input");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener("input", function() {
            document.getElementById("error-message-user").style.display = "none";
        });
    }

    document.getElementById("senha").addEventListener("input", function() {
        document.getElementById("error-message-senha").style.display = "none";
    });

    document.getElementById("cargo-select").addEventListener("click", function() {
        document.getElementById("error-message-user").style.display = "none";
    });
});

