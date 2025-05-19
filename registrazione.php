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
    $conn = new mysqli('localhost', 'root', '', 'kingame');

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
    $conn = new mysqli('localhost', 'root', '', 'kingame'); // Connessione al database

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Classifica per nazione
    $query = "SELECT ISO,Nome_Nazione
            FROM nazioni 
            ORDER BY Nome_Nazione";
    
    $result = $conn->query($query);
    $data;
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
    /* echo "<pre>";
    print_r($data);
    echo "</pre>"; */
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
                foreach ($data as $country) {
                    echo '<option value="' . $country['ID'] . '">' . $country['nome']. '</option>';
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
}
?>

<script>
    const passwordMismatchText = '<?= $TEXT['register_password_mismatch'] ?>';
    const passwordShortText = '<?= $TEXT['register_password_short'] ?>';

    function checkEquality() {
        const password = document.getElementById('password').value;
        const cpassword = document.getElementById('cpassword').value;
        const errorDiv = document.getElementById('passwordMismatch');

        if (password !== cpassword) {
            if (!errorDiv) {
                const newErrorDiv = document.createElement('div');
                newErrorDiv.id = 'passwordMismatch';
                newErrorDiv.style.color = 'red';
                newErrorDiv.textContent = passwordMismatchText;
                document.getElementById('cpassword').parentNode.insertBefore(newErrorDiv, document.getElementById('cpassword').nextSibling);
            }
        } else {
            if (errorDiv) {
                errorDiv.remove();
            }
        }
    }

    function validatePasswordLength() {
        const password = document.getElementById('password').value;
        const passwordErrorDiv = document.getElementById('passwordLengthError');

        if (password.length < 10) {
            if (!passwordErrorDiv) {
                const newPasswordErrorDiv = document.createElement('div');
                newPasswordErrorDiv.id = 'passwordLengthError';
                newPasswordErrorDiv.style.color = 'red';
                newPasswordErrorDiv.textContent = passwordShortText;
                document.getElementById('password').parentNode.insertBefore(newPasswordErrorDiv, document.getElementById('password').nextSibling);
            }
        } else {
            if (passwordErrorDiv) {
                passwordErrorDiv.remove();
            }
        }
    }

    function validateForm() {
        const form = document.getElementById('registrationForm');
        const submitBtn = document.getElementById('submitBtn');
        const password = document.getElementById('password')?.value ?? "";
        const cpassword = document.getElementById('cpassword')?.value ?? "";

        const allFieldsFilled = Array.from(form.elements).every((input) => {
            return input.value.trim() !== '' || !input.required;
        });

        const passwordValid = password.length >= 10;
        submitBtn.disabled = !(allFieldsFilled && password === cpassword);
    }

    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', () => {
            validateForm();
        });
    });

    $(document).ready(function () {
        $('#foto').select2({
            templateResult: function (data) {
                if (!data.id) return data.text;
                var $result = $('<span><img src="' + $(data.element).data('image') + '" style="width: 140px; height: 140px; margin-right: 10px;" />' + data.text + '</span>');
                return $result;
            }
        });
    });
</script>
</body>
</html>
