<style>
    .icons-pass {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .pass {
        width: 100%;
    }

    .icons {
        text-indent: -100px;
    }

    .icons img {
        border: 1px solid white;
        padding: 10px;
        border-radius: 50px;
    }

    .icons img:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .displayNone {
        display: none;
    }
</style>
<div class="m-2">
    <a href="index?page=home">
        <img src="./public/img/devcoplus-logo.PNG" alt="" class="logo">
    </a>
    <h1>
        Se connecter
    </h1>
    <p>
        Vous n'avez pas de compte ? <a class="brand__link" href="index.php?sign=up">S'inscrire</a>
    </p>
</div>
<form action="./backEnd/data.php" method="post" class="text-start" id="myForm">
    <label class="label" for="email">Email</label> <input class="input-zone" type="email" name="emailConnexion" id="emailConnexion"> <br />
    <span class="notice">Format invalide</span>
    <label class="label" for="pass">Mot de passe</label>
    <input class="input-zone password" type="password" name="pass" id="pass"><br />
    <!-- 
    <div class="icons-pass">
        <div class="pass">
            <label class="label" for="pass">Mot de passe</label>
            <input class="input-zone password" type="password" name="pass" id="pass"><br />
        </div>
        <div class="icons">
            <img src="./public/img/icons/eye-fill.svg" alt="" class="show-pass__none displayNone">
            <img src="./public/img/icons/eye-slash-fill.svg" alt="" class="hide-pass__none displayNone">
        </div>
    </div> 
    -->
    <span class="notice">Doit contenir au moins 4 caractères</span><br />
    <a class="forgot" href="">Mot de passe ou email oublié ?</a>
    <div class="rappel text-end" id="rappel">
        <input type="checkbox" name="connexionAuto" id="connexionAuto" class="p-5"> <label for="connexionAuto">Connexion automatique</label>
    </div>
    <input class="submit justify-content-center text-light bg-primary p-2" type="submit" value="Connexion">
</form>
<a class="mt-5 mb-5 p-2 via text-dark" href="">Via compte Google</a>
<script>
    /*
    function showMdp() {

        let password = document.querySelector('.password'),
            showPass = document.querySelector('.show-pass__none'),
            hidePass = document.querySelector('.hide-pass__none');

        showPass.addEventListener('click', function(e) {
            password.type = 'text';
            hidePass.style.display = 'block';
            showPass.className = 'displayNone';

            hidePass();
        });

        hidePass.addEventListener('click', function(e) {
            password.type = 'password';
            showPass.style.display = 'block';
            hidePass.className = 'displayNone';

            showPass();
        });
    }

    showMdp();
    */
    function focusAfterHver(params) {
        let label = document.querySelectorAll('.label'),
            input = document.querySelectorAll('.input-zone');

        for (let i = 0; i < label.length; i++) {
            label[i].addEventListener('mouseover', function() {
                input[i].focus();
            });
        }
    }

    focusAfterHver();

    function desactiverNotice() {
        let notice = document.querySelectorAll('.notice'),
            noticeLength = notice.length;

        for (let i = 0; i < noticeLength; i++) {
            notice[i].style.display = 'none';
        }
    }

    function getNotice(elements) {
        while (elements = elements.nextSibling) {
            if (elements.className === 'notice') {
                return elements
            }
        }
        return false;
    }


    let check = {}; // Put all data in litteral objet

    check['pass'] = function() {

        let pass = document.getElementById('pass'),
            noticeStyle = getNotice(pass).style;

        if (/(.){4,}/.test(pass.value)) {
            pass.className = 'correct';
            noticeStyle.display = 'none';
            return true;
        } else {
            pass.className = 'incorrect';
            noticeStyle.display = 'block';
            return false;
        }

    };

    check['emailConnexion'] = function() {
        let email = document.getElementById('emailConnexion'),
            noticeStyle = getNotice(email).style;

        if (/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/.test(email.value)) {
            email.className = 'correct';
            noticeStyle.display = 'none';
            return true;
        } else {
            email.className = 'incorrect';
            noticeStyle.display = 'block';
            return false;
        }

    };

    (function() { // Utilisation d'une IIFE pour éviter les letiables globales
        let myForm = document.getElementById('myForm'),
            inputs = document.querySelectorAll('input[type=password],input[type=email]'),
            inputsLength = inputs.length;

        for (let i = 0; i < inputsLength; i++) {
            inputs[i].addEventListener('keyup', function(e) {
                check[e.target.id](e.target.id); // "e.target" for thr input where update
            });
        }

        myForm.addEventListener('submit', function(e) {
            let result = true;
            for (let i in check) {
                result = check[i](i) && result;
            }
            if (!result) {
                e.preventDefault();
            }
        });

    })();

    desactiverNotice();
</script>