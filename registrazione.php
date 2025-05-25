<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'it';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['it', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'];
include_once "lang/$lang.php";

$signUpPhase = 1;
$isOk = true;
$usernameError = "";
$emailError = "";
$passwordError = "";

include 'menu.php';
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST) && !empty($_POST)) {
    require 'db_connect.php'; // [original]: $conn = new mysqli('localhost', 'root', '', 'kingame');

    $sql = "SELECT * FROM utenti WHERE UserName = '" . $_POST['username'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $isOk = false;
        $usernameError = $TEXT['register_username_taken'];
    }

    if ($isOk) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (strlen($password) < 10) {
            $isOk = false;
            $passwordError = $TEXT['register_password_short'];
        }

        if ($isOk) {
            $signUpPhase = 2;
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <title><?= $TEXT['register_title'] ?></title>
</head>
<body>

<?php
if ($signUpPhase == 1) {
    echo '<div class="form-container">
        <h2>' . $TEXT['register_title'] . '</h2>

        <form method="POST" action="registrazione.php" id="registrationForm">
            <label for="username">' . $TEXT['register_username'] . '</label>
            <input type="text" id="username" name="username" required>';
            if (!empty($usernameError)) {
                echo "<p style='color:red;'>$usernameError</p>";
            }

        echo '<label for="email">' . $TEXT['register_email'] . '</label>
            <input type="email" id="email" name="email" required>';
            if (!empty($emailError)) {
                echo "<p style='color:red;'>$emailError</p>";
            }

        echo '<label for="password">' . $TEXT['register_password'] . '</label>
            <input type="password" id="password" name="password" required>

            <label for="cpassword">' . $TEXT['register_confirm_password'] . '</label>
            <input type="password" id="cpassword" name="cpassword" oninput="checkEquality()" required>';
            if (!empty($passwordError)) {
                echo "<p style='color:red;'>$passwordError</p>";
            }

        echo '<input type="submit" value="' . $TEXT['register_button'] . '" id="submitBtn" disabled>
            <a href="index.php" class="home-link">' . $TEXT['register_home'] . '</a>
        </form>
    </div>';
} else {
    require 'db_connect.php'; // [original]: $conn = new mysqli('localhost', 'root', '', 'kingame'); 

    // [original]: if ($conn->connect_error) {
    // [original]:     die("Connessione fallita: " . $conn->connect_error);
    // [original]: }

    $query = "SELECT ISO,Nome_Nazione
            FROM nazioni 
            ORDER BY Nome_Nazione";
    
    $result = $conn->query($query);
    $data = []; // Initialize $data as an empty array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                "ID" => $row["ISO"],
                "nome" => $row["Nome_Nazione"]
            );
        }
    }
    if (!$result) {
        die("Errore nella query: " . $conn->error);
    }
    echo '
    <div class="form-container">
        <h2>' . $TEXT['register_complete_title'] . '</h2>

        <header>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        </header>

        <form method="POST" action="regRiquest.php" id="registrationForm">
            <label for="name">' . $TEXT['register_nickname'] . '</label>
            <input type="text" id="nome" name="nickname" required>

            <label for="paesi">' . $TEXT['register_select_country'] . '</label>
            <select name="paese" id="paese">';
                if (!empty($data)) { // Check if $data is not empty before iterating
                    foreach ($data as $country) {
                        echo '<option value="' . $country['ID'] . '">' . $country['nome']. '</option>';
                    }
                }
            echo '</select>

            <input type="hidden" name="username" value="' . htmlspecialchars($username) . '">
            <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
            <input type="hidden" name="password" value="' . md5($password) . '">

            <label for="paesi">' . $TEXT['register_select_avatar'] . '</label>
            <select name="foto" id="foto">';
                for ($i = 1; $i <= 16; $i++) {
                    $img_url = "https://raw.githubusercontent.com/Elm4lek/kingame_img/main/img_profilo/{$i}.png";
                    echo "<option value='$img_url' data-image='$img_url'>$i</option>";
                }
            echo '</select>

            <input type="submit" value="' . $TEXT['register_button'] . '" id="submitBtn">
        </form>
    </div>';
    $conn->close(); // Close connection for the 'else' block
}
?>

<script>
    const passwordMismatchText = '<?= $TEXT['register_password_mismatch'] ?>';
    const passwordShortText = '<?= $TEXT['register_password_short'] ?>';

    function checkEquality() {
        const passwordField = document.getElementById('password');
        const cpasswordField = document.getElementById('cpassword');
        // Procedi solo se entrambi i campi sono effettivamente presenti (siamo nel primo form)
        if (!passwordField || !cpasswordField) return;

        const password = passwordField.value;
        const cpassword = cpasswordField.value;
        let errorDiv = document.getElementById('passwordMismatch');

        if (cpassword.length > 0 && password !== cpassword) { // Mostra solo se c'è testo e non combaciano
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.id = 'passwordMismatch';
                errorDiv.style.color = 'red';
                cpasswordField.parentNode.insertBefore(errorDiv, cpasswordField.nextSibling);
            }
            errorDiv.textContent = passwordMismatchText;
        } else {
            if (errorDiv) {
                errorDiv.remove();
            }
        }
    }

    function validatePasswordLength() {
        const passwordField = document.getElementById('password');
        // Procedi solo se il campo password è presente
        if (!passwordField) return;

        const password = passwordField.value;
        let errorDiv = document.getElementById('passwordLengthError');

        // Mostra l'errore sulla lunghezza solo se l'utente ha iniziato a scrivere
        // e la password è troppo corta, OPPURE se il campo è in focus e vuoto (per la prima visualizzazione su click)
        // Per evitare che appaia subito se il campo è precompilato e valido, aggiungiamo un check sulla lunghezza
        if (password.length > 0 && password.length < 10) {
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.id = 'passwordLengthError';
                errorDiv.style.color = 'red';
                passwordField.parentNode.insertBefore(errorDiv, passwordField.nextSibling);
            }
            errorDiv.textContent = passwordShortText;
        } else if (document.activeElement === passwordField && password.length === 0 && !errorDiv) {
            // Caso specifico: campo password in focus, vuoto, e nessun messaggio di errore già presente
            // Questo è per quando l'utente clicca nel campo vuoto
            errorDiv = document.createElement('div');
            errorDiv.id = 'passwordLengthError';
            errorDiv.style.color = 'red';
            errorDiv.textContent = passwordShortText;
            passwordField.parentNode.insertBefore(errorDiv, passwordField.nextSibling);
        }
         else {
            if (errorDiv) {
                errorDiv.remove();
            }
        }
    }

    function validateForm() {
        let currentForm;
        const form1 = document.querySelector('form[action="registrazione.php"]');
        const form2 = document.querySelector('form[action="regRiquest.php"]');

        if (form1 && (form1.offsetParent !== null || window.getComputedStyle(form1.parentElement).display !== 'none')) {
            currentForm = form1;
        } else if (form2 && (form2.offsetParent !== null || window.getComputedStyle(form2.parentElement).display !== 'none')) {
            currentForm = form2;
        } else {
            currentForm = form1 || form2;
        }

        if (!currentForm) return;
        const submitBtn = currentForm.querySelector('input[type="submit"]');
        if (!submitBtn) return;

        let allFieldsFilled = true;
        currentForm.querySelectorAll('input[required]').forEach(input => {
            if (input.type === 'text' || input.type === 'email' || input.type === 'password') {
                if (input.value.trim() === '') {
                    allFieldsFilled = false;
                }
            }
        });

        if (currentForm.action.includes('registrazione.php')) {
            const passwordField = currentForm.querySelector('#password');
            const cpasswordField = currentForm.querySelector('#cpassword');
            if (passwordField && cpasswordField) {
                const password = passwordField.value;
                const cpassword = cpasswordField.value;
                const passwordValidLength = password.length >= 10;
                submitBtn.disabled = !(allFieldsFilled && password === cpassword && passwordValidLength);
            } else {
                submitBtn.disabled = !allFieldsFilled;
            }
        } else if (currentForm.action.includes('regRiquest.php')) {
            submitBtn.disabled = !allFieldsFilled;
        }
    }

    // Setup degli event listeners
    const passwordField = document.getElementById('password');
    const cpasswordField = document.getElementById('cpassword');
    const emailField = document.getElementById('email'); // Assumendo ci sia un campo email
    const usernameField = document.getElementById('username'); // Assumendo ci sia un campo username

    if (passwordField) {
        // Mostra "register_password_short" quando si clicca/entra nel campo password
        passwordField.addEventListener('focus', () => {
            // Valida solo se il campo è vuoto, per mostrare il messaggio la prima volta
            // La validazione completa avverrà su 'input'
            if(passwordField.value.length === 0) {
                validatePasswordLength();
            }
        });
        // Aggiorna validazione lunghezza e stato form mentre si scrive
        passwordField.addEventListener('input', () => {
            validatePasswordLength();
            if (cpasswordField && cpasswordField.value.length > 0) { // Se c'è testo in cpassword, rivaluta la corrispondenza
                checkEquality();
            }
            validateForm();
        });
    }

    if (cpasswordField) {
        // Mostra "register_password_mismatch" quando si inizia a scrivere in "conferma password"
        cpasswordField.addEventListener('input', () => {
            checkEquality();
            validateForm();
        });
    }

    // Listener generici per username ed email per validare lo stato del form
    if (usernameField) {
        usernameField.addEventListener('input', validateForm);
    }
    if (emailField) {
        emailField.addEventListener('input', validateForm);
    }
    
    // Listener per gli input del secondo form (nickname)
    const nicknameField = document.getElementById('nome');
    if(nicknameField) {
        nicknameField.addEventListener('input', validateForm);
    }


    // Chiamata iniziale per impostare lo stato del pulsante (non mostra errori di password qui)
    validateForm();

    $(document).ready(function () {
        if ($('#foto').length) {
            $('#foto').select2({
                templateResult: function (data) {
                    if (!data.id) return data.text;
                    var $result = $('<span><img src="' + $(data.element).data('image') + '" style="width: 140px; height: 140px; margin-right: 10px;" />' + data.text + '</span>');
                    return $result;
                }
            });
        }
    });
</script>
</body>
</html>