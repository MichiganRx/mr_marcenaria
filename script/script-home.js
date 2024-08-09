function confirmarExclusao(nomeProduto, url) {
    const modalWrapper = document.createElement('div');
    modalWrapper.className = 'modal-wrapper';

    const content = 'Tem certeza que deseja excluir o produto:';
    const card = new CardDelet('Atenção!', content, nomeProduto, () => {
        window.location.href = url; 
    });

    const modal = card.render();
    modalWrapper.appendChild(modal);

    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';

    document.body.appendChild(modalWrapper);

    modalWrapper.addEventListener('click', () => {
        document.body.style.overflow = ''; 
        document.documentElement.style.overflow = '';
        if (document.body.contains(modalWrapper)) {
            document.body.removeChild(modalWrapper);
        }
    });

    return false;
}

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
                checkFields();
            });
        });

        document.addEventListener('click', (event) => {
            if (!event.target.matches('.select-selected') && !event.target.matches('.select-selected *')) {
                items.classList.add('select-hide');
                selected.classList.remove('select-arrow-active');
            }
        });
    };

    initCustomSelect(document.getElementById('fornecedor-select'), 'idfornecedores');
    initCustomSelect(document.getElementById('estoque-select'), 'idestoque');
    initCustomSelect(document.getElementById('edit_fornecedor-select'), 'edit_idfornecedores');
    initCustomSelect(document.getElementById('edit_estoque-select'), 'edit_idestoque');

    const btnAdicionarProduto = document.getElementById('btnAdicionarProduto');
    const btnFecharCadastro = document.getElementById('btnFecharCadastro');
    const btnFecharEdicao = document.getElementById('btnFecharEdicao');
    const cadastroProduto = document.getElementById('cadastroProduto');
    const editarProduto = document.getElementById('editarProduto');
    const form = document.getElementById('cadastroProdutoForm');
    const errorMessage = document.getElementById('error-message');

    const inputs = document.querySelectorAll('#cadastroProdutoForm input');

    function checkFields() {
        const nomeProduto = document.getElementById('nome_produto').value.trim();
        const saldo = document.getElementById('saldo').value.trim();
        const minimo = document.getElementById('minimo').value.trim();
        const idFornecedores = document.getElementById('idfornecedores').value.trim();
        const idEstoque = document.getElementById('idestoque').value.trim();

        if (nomeProduto && saldo && minimo && idFornecedores && idEstoque) {
            errorMessage.style.display = 'none';
        }
    }

    inputs.forEach(input => {
        input.addEventListener('input', checkFields);
    });

    btnAdicionarProduto.addEventListener('click', () => {
        cadastroProduto.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    });

    btnFecharCadastro.addEventListener('click', () => {
        cadastroProduto.style.display = 'none';
        errorMessage.style.display = 'none';
        document.body.style.overflow = ''; 
        document.documentElement.style.overflow = '';
    });
    
    btnFecharEdicao.addEventListener('click', () => {
        editarProduto.style.display = 'none';
        document.body.style.overflow = ''; 
        document.documentElement.style.overflow = '';
    });

    document.querySelectorAll('.btnEdita').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const nome = this.dataset.nome;
            const saldo = this.dataset.saldo;
            const minimo = this.dataset.minimo;
            const fornecedor = this.dataset.fornecedor;

            document.getElementById('edit_idproduto').value = id;
            document.getElementById('edit_nome_produto').value = nome;
            document.getElementById('edit_saldo').value = saldo;
            document.getElementById('edit_minimo').value = minimo;
            document.getElementById('edit_idfornecedores').value = fornecedor;

            const fornecedorOption = document.querySelector(`#edit_fornecedor-select .select-option[data-value='${fornecedor}']`);
            if (fornecedorOption) {
                document.querySelector('#edit_fornecedor-select .select-selected').textContent = fornecedorOption.textContent + " ";
                fornecedorOption.click();
            }

            const estoqueOption = this.dataset.estoque; 
            const estoqueSelectOption = document.querySelector(`#edit_estoque-select .select-option[data-value='${estoqueOption}']`);
            if (estoqueSelectOption) {
                document.querySelector('#edit_estoque-select .select-selected').textContent = estoqueSelectOption.textContent + " ";
                estoqueSelectOption.click();
            }

            editarProduto.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
        });
    });

    form.addEventListener('submit', (event) => {
        const nomeProduto = document.getElementById('nome_produto').value.trim();
        const saldo = document.getElementById('saldo').value.trim();
        const minimo = document.getElementById('minimo').value.trim();
        const idFornecedores = document.getElementById('idfornecedores').value.trim();
        const idEstoque = document.getElementById('idestoque').value.trim();

        if (!nomeProduto || !saldo || !minimo || !idFornecedores || !idEstoque) {
            event.preventDefault();
            errorMessage.style.display = 'flex';
        } else {
            errorMessage.style.display = 'none';
            cadastroProduto.style.display = 'none';
            document.body.style.overflow = ''; 
            document.documentElement.style.overflow = '';
            const card = new Card('Sucesso!', 'Produto Cadastrado.');
            const app = document.getElementById('app');
            app.appendChild(card.render()); 
        }
    });
};

function checkEditFields() {
    const nomeProduto = document.getElementById('edit_nome_produto').value.trim();
    const saldo = document.getElementById('edit_saldo').value.trim();
    const minimo = document.getElementById('edit_minimo').value.trim();
    const idFornecedores = document.getElementById('edit_idfornecedores').value.trim();
    const idEstoque = document.getElementById('edit_idestoque').value.trim();
    const errorMessageEdita = document.getElementById('error-message-edita');

    if (nomeProduto && saldo && minimo && idFornecedores && idEstoque) {
        errorMessageEdita.style.display = 'none';
    } else {
        errorMessageEdita.style.display = 'flex';
    }
}

document.querySelectorAll('#editarProdutoForm input').forEach(input => {
    input.addEventListener('input', checkEditFields);
});

document.getElementById('editarProdutoForm').addEventListener('submit', (event) => {
    const nomeProduto = document.getElementById('edit_nome_produto').value.trim();
    const saldo = document.getElementById('edit_saldo').value.trim();
    const minimo = document.getElementById('edit_minimo').value.trim();
    const idFornecedores = document.getElementById('edit_idfornecedores').value.trim();
    const idEstoque = document.getElementById('edit_idestoque').value.trim();
    const errorMessageEdita = document.getElementById('error-message-edita');
    const editarProduto = document.getElementById('editarProduto');

    if (!nomeProduto || !saldo || !minimo || !idFornecedores || !idEstoque) {
        event.preventDefault();
        errorMessageEdita.style.display = 'flex';
    } else {
        errorMessageEdita.style.display = 'none';
        editarProduto.style.display = 'none';
        document.body.style.overflow = ''; 
        document.documentElement.style.overflow = '';
        const card = new Card('Sucesso!', 'Produto Atualizado.');
        const app = document.getElementById('app');
        app.appendChild(card.render());
    }
});
