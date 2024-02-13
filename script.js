document.getElementById('contactForm').addEventListener('submit', function (event) {
    //
    //Sélectionne tous les éléments ayant la classe "error" et réinitialise leur contenu texte à une chaîne vide.
    //
    document.querySelectorAll('.error').forEach(errorElement => errorElement.textContent = '');

    const firstName = document.getElementById('fname').value.trim();
    const lastName = document.getElementById('lname').value.trim();
    const email = document.getElementById('email').value.trim();
    const description = document.getElementById('description').value.trim();
    const avatar = document.getElementById('avatar').value;

    if (isEmpty(firstName) || firstName.length > 255) {
        showError('fname', 'First name is required and must be between 2 and 255 characters.');
        event.preventDefault();
    }

    if (isEmpty(lastName) || lastName.length > 255) {
        showError('lname', 'Last name is required and must be between 2 and 255 characters.');
        event.preventDefault();
    }

    if (!isValidEmail(email)) {
        showError('email', 'Please enter a valid email address.');
        event.preventDefault();
    }

    if (isEmpty(description) || description.length > 1000) {
        showError('description', 'Description is required and must be between 2 and 1000 characters.');
        event.preventDefault();
    }

    if (avatar && !isValidFileExtension(avatar)) {
        showError('avatar', 'Invalid file type. Please upload a valid image (png, jpeg, gif).');
        event.preventDefault();
    }
});

function showError(elementId, message) {
    const errorElement = document.createElement('span');
    errorElement.classList.add('error');
    errorElement.textContent = message;

    document.getElementById(elementId).insertAdjacentElement('afterend', errorElement);
}

function isEmpty(value) {
    return value.trim() === '';
}
//
// Méthode REGEX
//
function isValidEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
// function isValidEmail(email) {
//     //
//     // Vérifie que l 'email' contienne au min 2 caractères,un @ et un .
//     //
//     return email.length > 2 && email.includes('@') && email.includes('.');
// }


function isValidFileExtension(filename) {
    
    const allowedExtensions = ['png', 'jpeg', 'jpg', 'gif'];
    //
    //Tranforme le nom du fichier en tableau divisé par "."
    //Sélectionne la derniere chaine du tableau
    //la retranscrit en miniscule pour éviter la casse
    //
    const ext = filename.split('.').pop().toLowerCase();
    return allowedExtensions.includes(ext);
}
