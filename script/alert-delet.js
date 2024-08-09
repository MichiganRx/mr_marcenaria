class CardDelet {
    constructor(title, content, productName, onConfirm) {
        this.title = title;
        this.content = content;
        this.productName = productName;
        this.onConfirm = onConfirm;
    }

    render() {
        const cardWrapper = document.createElement('div');
        cardWrapper.className = 'card-wrapper';

        const spinner = document.createElement('div');
        spinner.className = 'spinner spinerDelet';

        cardWrapper.appendChild(spinner);
        const card = document.createElement('div');
        card.className = 'card delet';

        const cardTitle = document.createElement('div');
        cardTitle.className = 'card-title';
        cardTitle.textContent = this.title;

        const cardContent = document.createElement('div');
        cardContent.className = 'card-content';
        cardContent.textContent = this.content;

        const nameProduct = document.createElement('div');
        nameProduct.className = 'card-product';
        nameProduct.textContent = this.productName;

        const cardImage = document.createElement('img');
        cardImage.src = './assets/img/trash-bin.png'; 
        cardImage.className = 'card-image-delet';

        const buttonContainer = document.createElement('div');
        buttonContainer.className = 'button-container';

        const confirmButton = document.createElement('button');
        confirmButton.className = 'card-button';
        
        const confirmImage = document.createElement('img');
        confirmImage.src = './assets/img/sim.png';
        confirmImage.alt = '';
        
        const confirmText = document.createTextNode('Sim');
        
        confirmButton.appendChild(confirmImage);
        confirmButton.appendChild(confirmText);

        confirmButton.addEventListener('click', () => {
            this.onConfirm();
            document.body.style.overflow = ''; 
            document.documentElement.style.overflow = '';
            if (document.body.contains(cardWrapper)) {
                document.body.removeChild(cardWrapper);
            }
        });

        const cancelButton = document.createElement('button');
        cancelButton.className = 'close';
        
        const cancelImage = document.createElement('img');
        cancelImage.src = './assets/img/nao.png';
        cancelImage.alt = '';
        
        const cancelText = document.createTextNode('Não');
        
        cancelButton.appendChild(cancelImage);
        cancelButton.appendChild(cancelText);

        cancelButton.addEventListener('click', () => {
            const modalWrapper = document.querySelector('.modal-wrapper');
            document.body.style.overflow = ''; 
            document.documentElement.style.overflow = '';
            if (modalWrapper && document.body.contains(modalWrapper)) {
                document.body.removeChild(modalWrapper);
            }
        });        

        buttonContainer.appendChild(confirmButton);
        buttonContainer.appendChild(cancelButton);

        card.appendChild(cardImage);
        card.appendChild(cardTitle);
        card.appendChild(cardContent);
        card.appendChild(nameProduct);
        card.appendChild(buttonContainer);

        cardWrapper.appendChild(card);

        document.body.style.overflow = 'hidden'; 
        document.documentElement.style.overflow = 'hidden';

        return cardWrapper;
    }
}

window.CardDelet = CardDelet;
