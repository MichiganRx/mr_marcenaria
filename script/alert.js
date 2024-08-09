class Card {
    constructor(title, content) {
        this.title = title;
        this.content = content;
    }

    render() {
        const cardWrapper = document.createElement('div');
        cardWrapper.className = 'card-wrapper';

        const spinner = document.createElement('div');
        spinner.className = 'spinner';

        cardWrapper.appendChild(spinner);
        const card = document.createElement('div');
        card.className = 'card';

        const cardTitle = document.createElement('div');
        cardTitle.className = 'card-title';
        cardTitle.textContent = this.title;

        const cardContent = document.createElement('div');
        cardContent.className = 'card-content';
        cardContent.textContent = this.content;

        const cardImage = document.createElement('img');
        cardImage.src = './assets/img/ok.png'; 
        cardImage.className = 'card-image';

        card.appendChild(cardImage);
        card.appendChild(cardTitle);
        card.appendChild(cardContent);

        cardWrapper.appendChild(card);

        document.body.style.overflow = 'hidden'; 
        document.documentElement.style.overflow = 'hidden';

        cardWrapper.addEventListener('click', () => {
            document.body.style.overflow = ''; 
            document.documentElement.style.overflow = '';
            if (document.body.contains(cardWrapper)) {
                document.body.removeChild(cardWrapper);
            }
        });

        return cardWrapper;
    }
}

window.Card = Card;
