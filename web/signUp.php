<style>

</style>
<div class="m-2">
    <a href="index?page=home">
        <img src="./public/img/devcoplus-logo.PNG" alt="" class="logo">
    </a>
    <h1>
        S'inscrire
    </h1>
    <p>
        Vous avez déja un compte ? <a class="brand__link" href="index.php?sign=in">Se connecter</a>
    </p>
</div>

<form action="./backEnd/data.php" method="post" class="text-start" id="myForm">
    <?php

    if (isset($_SESSION['compteIsSet'])) {
        echo '<center class="text-warning">' . $_SESSION['compteIsSet'] . '</center>';
    }

    ?>
    <input type="hidden" name="client">
    <label class="label" for="cecond_name">Nom</label> <input class="input-zone" type="text" name="nom" id="nom">
    <span class="notice">Nom unique de 2 à 16 caractères avec 1ère lettre en majuscule<br /><del>Caractère accentué</del></span>
    <label class="label" for="prenoms">Prénoms</label><input class="input-zone" type="text" name="prenoms" id="prenoms">
    <span class="notice">Pas plus de 3 prenoms <del>Caractère accentué</del></span>
    <label class="label" for="email">Email</label> <input class="input-zone" type="email" name="email" id="email">
    <span class="notice">Format invalide</span>
    <label class="label" for="pass">Mot de passe</label> <input class="input-zone" type="password" name="pass" id="pass">
    <span class="notice">Doit contenir au moins 4 caractères</span>
    <label class="label" for="confirmePass">Confirmez votre mot de passe</label> <input class="input-zone" type="password" name="confirmePass" id="confirmePass"><br />
    <span class="notice">Mot de passe non identique</span>
    <label class="label" for="tel">Tel</label><input class="input-zone" type="tel" name="tel" id="tel">
    <span class="notice">Format invalide</span>
    <div class="rappel" id="rappel">
        <input type="checkbox" name="connexionAuto" id="connexionAuto" class="p-5">
        <label for="connexionAuto"> Connexion auto</label>
    </div>
    <input class="submit text-light bg-primary p-2" id="submit" type="submit" value="Inscription">
</form>
<a class="mt-5 mb-5 p-2 via text-dark" href="">Via compte Google</a>
<script>
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

    check['nom'] = function(id) {

        let nom = document.getElementById(id),
            noticeStyle = getNotice(nom).style;

        if (/^[A-Z]{1}[a-z]{2,15}$/.test(nom.value)) {
            nom.className = 'correct';
            noticeStyle.display = 'none';
            return true;
        } else {
            nom.className = 'incorrect';
            noticeStyle.display = 'block';
            return false;
        }

    };

    check['prenoms'] = function() {

        let prenoms = document.getElementById('prenoms'),
            noticeStyle = getNotice(prenoms).style;

        if (/^([A-Z]?[a-z]{2,10} ?){1,3}$/.test(prenoms.value)) {
            prenoms.className = 'correct';
            noticeStyle.display = 'none';
            return true;
        } else {
            prenoms.className = 'incorrect';
            noticeStyle.display = 'block';
            return false;
        }

    };

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

    check['confirmePass'] = function() {

        let pass = document.getElementById('pass'),
            confirmePass = document.getElementById('confirmePass'),
            noticeStyle = getNotice(confirmePass).style;

        if (pass.value == confirmePass.value && confirmePass.value != '') {
            confirmePass.className = 'correct';
            noticeStyle.display = 'none';
            return true;
        } else {
            confirmePass.className = 'incorrect';
            noticeStyle.display = 'block';
            return false;
        }

    };

    check['email'] = function() {
        let email = document.getElementById('email'),
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

    check['tel'] = function() {
        let tel = document.getElementById('tel'),
            noticeStyle = getNotice(tel).style;

        if (/^([0-9]{2}[-. ]?){5}$/.test(tel.value)) {
            tel.className = 'correct';
            noticeStyle.display = 'none';
            return true;
        } else {
            tel.className = 'incorrect';
            noticeStyle.display = 'block';
            return false;
        }

    };


    // Begin event

    (function() { // Using IIFE for avoid globales letiables.

        let myForm = document.getElementById('myForm'),
            inputs = document.querySelectorAll('input[type=text], input[type=password],input[type=email], input[type=tel]'),
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

        myForm.addEventListener('reset', function() {

            for (let i = 0; i < inputsLength; i++) {
                inputs[i].className = '';
            }

            desactiverNotice();

        });

    })();

    // Maintenant que tout est initialisé, on peut désactiver les "tooltips"

    desactiverNotice();
</script>