

function validation(){

    let mail = document.getElementById('inputEmail').value
    let mdp = document.getElementById('inputPassword').value

    let textErrorMail = document.getElementById('text-error-mail');
    let textErrorMDP = document.getElementById('text-error-mdp');

    if (mail.length === 0){
        textErrorMail.textContent = 'Veuillez saisir votre mail';
    }else if(mail !== 0){

        textErrorMail.textContent = '';
    }

    if (mdp.length === 0){
        textErrorMDP.textContent = 'Veuillez saisir votre mot de passe';
    }else if (mdp.length !== 0){
        textErrorMDP.textContent = '';
    }

}