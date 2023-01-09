<?php
if(isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";

    // Get form data
    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];
    $afdeling = mysqli_escape_string($db, $_POST['afdeling']);

    // Server-side validation
    $errors = [];
    if($name == '') {
        $errors['name'] = 'Please fill in your name.';
    }
    if($email == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    if($password == '') {
        $errors['password'] = 'Please fill in your password.';
    }
    if($afdeling == '') {
        $errors['afdeling'] = 'Please fill in your afdeling.';
    }

    // If data valid
    if(empty($errors)) {
        // create a secure password, with the PHP function password_hash()
        $password = password_hash($password, PASSWORD_DEFAULT);

        // store the new user in the database.
        $query = "INSERT INTO users (name, email, password, afdeling) VALUES ('$name', '$email', '$password', '$afdeling')";

        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evenement login</title>
    <link rel="icon" type="image/x-icon" href="./images/#.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

</head>
<body class="bg-no-repeat bg-cover bg-center bg-fixed min-h-screen pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif; background-image: url('../images/gemeentenissewaard.jpg')">
 <main class="bg-white max-w-lg mx-auto p-8 md:p-12 mt-14 rounded-lg shadow-2xl">
        <section>
            <h3 class="font-bold text-2xl">Registreer</h3>
            <p class="text-gray-600 pt-2">Maak hier je account</p>
        </section>

        <section class="mt-10">
            <form class="flex flex-col" action="" method="post">
            <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="name">Naam</label>
                    <input type="text" id="name" name="name" value="<?= $name ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                    <p class="help is-danger">
                                <?= $errors['name'] ?? '' ?>
                            </p>
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?= $email ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                    <p class="help is-danger">
                                <?= $errors['email'] ?? '' ?>
                            </p>
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                    <?= $errors['password'] ?? '' ?>
                </div>
                <div class="mb-6 pt-3 rounded">
  <span class="text-gray-700">Afdeling</span>
  <div class="mt-2">
    <label class="inline-flex items-center">
      <input type="radio" class="form-radio" name="afdeling" value="HR" required>
      <?= $errors['afdeling'] ?? '' ?>
      <span class="ml-2">HR</span>
    </label>
    <label class="inline-flex items-center ml-6">
      <input type="radio" class="form-radio" name="afdeling" value="Communicatie">
      <?= $errors['afdeling'] ?? '' ?>
      <span class="ml-2">Communicatie</span>
    </label>
    <label class="inline-flex items-center ml-6">
      <input type="radio" class="form-radio" name="afdeling" value="IT">
      <?= $errors['afdeling'] ?? '' ?>
      <span class="ml-2">IT</span>
    </label>
  </div>
</div>
                <div class="flex justify-end">
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-700 hover:underline mb-6">Forgot your password?</a>
                </div>
                <button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200" 
                type="submit" name="submit">Sign In</button>
            </form>
        </section>
    </main>
    <div class="max-w-lg mx-auto bg-white rounded-lg md:p-6 mt-4">
    <div class="max-w-lg mx-auto text-center mt-2 mb-6">
        <p class="text-black">Already got an account? <a href="Login.php" class="font-bold hover:underline">Log in</a>.</p>
    </div>

    <footer class="max-w-lg mx-auto flex justify-center text-black">
        <a href="index.php" class="hover:underline">Home</a>
        <span class="mx-3">•</span>
        <a href="#" class="hover:underline">Privacy</a>
    </footer>
</div>
</body>
</html>