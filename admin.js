document.getElementById('adminButton').addEventListener('click', function(event) {
    event.preventDefault();

    const enteredAdminPassword = prompt('Veuillez entrer le mot de passe administrateur:'); 


    if (enteredAdminPassword === adminPassword) {

        alert('Mot de passe administrateur correct. Redirection vers la page d\'administration.');
        window.location.href = 'http://hackers-poulette.test/dashboard.php';
    } else {
        alert('Mot de passe administrateur incorrect.');
    }
});
