window.onload = function() {
    const initCustomSelect = (selectContainer, hiddenInputId) => {
        const selected = selectContainer.querySelector('.select-selected');
        const items = selectContainer.querySelector('.select-items');
        const options = selectContainer.querySelectorAll('.select-option');
        const hiddenInput = document.getElementById(hiddenInputId);

        selected.addEventListener('click', () => {
            items.classList.toggle('select-hide');
            selected.classList.toggle('select-arrow-active');
        });

        options.forEach(option => {
            option.addEventListener('click', () => {
                selected.childNodes[0].textContent = option.textContent + " ";
                hiddenInput.value = option.dataset.value;
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

    initCustomSelect(document.getElementById('tipo-select'), 'tipo_forn');

    const cargoErrorMessage = document.getElementById('error-message');
    const cargoForm = document.getElementById('cadastroTipoForm');

    const checkCargoFields = () => {
        const cargoNome = document.getElementById('tipo_nome').value.trim();

        if (cargoNome) {
            cargoErrorMessage.style.display = 'none';
        } else {
            cargoErrorMessage.style.display = 'block';
        }
    };

    document.getElementById('tipo_nome').addEventListener('input', checkCargoFields);

    cargoForm.addEventListener('submit', (event) => {
        const cargoNome = document.getElementById('tipo_nome').value.trim();

        if (!cargoNome) {
            event.preventDefault();
            cargoErrorMessage.style.display = 'block';
        } else {
            document.getElementById('cadastroTipo').style.display = 'none';
            const card = new Card('Sucesso!', 'Tipo de fornecedor cadastrado.');
            const app = document.getElementById('app');
            app.appendChild(card.render()); 
            cargoErrorMessage.style.display = 'none';
        }
    });

    const openModal = () => {
        document.getElementById('cadastroTipo').style.display = 'flex';
        cargoErrorMessage.style.display = 'none';
    };

    const closeModal = () => {
        document.getElementById('cadastroTipo').style.display = 'none';
        cargoErrorMessage.style.display = 'none';
    };

    document.getElementById('btnAdicionarTipo').addEventListener('click', openModal);
    document.getElementById('btnFecharCadastro').addEventListener('click', closeModal);
};

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("cadFornecedor").addEventListener("submit", function(event) {
        var nome = document.getElementById("nome_forn").value;
        var tel = document.getElementById("telefone").value;
        var tipo = document.getElementById("tipo_forn").value;

        if (nome === "" || tel === "" || tipo === "" ) {
            document.getElementById("error-message-user").style.display = "block";
            event.preventDefault();
            return;
        }else{
            const card = new Card('Sucesso!', 'Fornecedor cadastrado.');
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

    document.getElementById("tipo-select").addEventListener("click", function() {
        document.getElementById("error-message-user").style.display = "none";
    });
});
