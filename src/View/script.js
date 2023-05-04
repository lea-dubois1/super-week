const getAllUsers = document.querySelector('.getAllUsers');
const getAllBooks = document.querySelector('.getAllBooks');

const inputUserId = document.querySelector('#userId');
const getUserById = document.querySelector('#getUserById');

const inputBookId = document.querySelector('#bookId');
const getBookById = document.querySelector('#getBookById');

const displayDiv = document.createElement('div');
const body = document.getElementsByTagName('body')[0];
body.append(displayDiv);

getAllUsers.addEventListener('click', async() => {

    displayDiv.innerHTML = "";

    const response = await fetch('users');
    const listeUsers = await response.json();

    for (const dataUser of listeUsers) {
        const titre = document.createElement('h2');
        titre.innerHTML = dataUser.first_name + " " + dataUser.last_name;
        const para = document.createElement('p');
        para.innerHTML = "id : " + dataUser.id + "<br>" + "email : " + dataUser.email + "<br>";
        displayDiv.append(titre);
        displayDiv.append(para);
    }
})

getAllBooks.addEventListener('click', async() => {

    displayDiv.innerHTML = "";

    const response = await fetch('books');
    const listeBooks = await response.json();

    for (const dataBook of listeBooks) {
        const titre = document.createElement('h2');
        titre.innerHTML = dataBook.titre;
        const para = document.createElement('p');
        para.innerHTML = "id : " + dataBook.id + "<br>" + "contenu : " + dataBook.content + "<br>" + "id auteur : " + dataBook.id_user + "<br>";
        displayDiv.append(titre);
        displayDiv.append(para);
    }
})

getUserById.addEventListener('click', async() => {

    displayDiv.innerHTML = "";

    const response = await fetch('users/' + inputUserId.value);
    const dataUser = await response.json();

    for (const data of dataUser) {
        const titre = document.createElement('h2');
        titre.innerHTML = data.first_name + " " + data.last_name;
        const para = document.createElement('p');
        para.innerHTML = "id : " + data.id + "<br>" + "email : " + data.email + "<br>";
        displayDiv.append(titre);
        displayDiv.append(para);
    }

})

getBookById.addEventListener('click', async() => {

    displayDiv.innerHTML = "";

    const response = await fetch('books/' + inputBookId.value);
    const dataBook = await response.json();

    for (const data of dataBook) {
        const titre = document.createElement('h2');
        titre.innerHTML = data.titre;
        const para = document.createElement('p');
        para.innerHTML = "id : " + data.id + "<br>" + "contenu : " + data.content + "<br>" + "id auteur : " + dataBook.id_user + "<br>";
        displayDiv.append(titre);
        displayDiv.append(para);
    }
})