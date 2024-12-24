<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
  
  body {
    font-family: Arial, sans-serif;
    background-image: url('../assets/bg.png'); /* Ganti dengan path gambar Anda */
    background-size: cover; /* Membuat gambar memenuhi seluruh layar */
    background-repeat: no-repeat; /* Mencegah gambar diulang */
    background-position: center; /* Menempatkan gambar di tengah */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

header {
    position: absolute; /* Membuat elemen bebas diposisikan */
    top: 10px; /* Jarak dari atas halaman */
    left: 10px; /* Jarak dari kiri halaman */
    z-index: 10; /* Pastikan elemen berada di atas */
}

.logo {
    width: 50px; /* Sesuaikan ukuran logo */
    height: auto; /* Pertahankan proporsi logo */
}

.login-container {
    background-color: white;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 500px; 
    max-width: 300px;
}

.login-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #69AF00;
}

.login-container label {
    display: block;
    margin-bottom: 10px;
    color: #000000;
}

.login-container input {
    width: 90%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-container button {
    width: 100%;
    padding: 10px;
    background-color: #69AF00;
    color: white;
    border: black;
    border-style: double;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.login-container button:hover {
    opacity: 0.9;
}

/* Media Queries untuk Responsivitas */
@media (max-width: 768px) { /* Tablet */
    .login-container {
        padding: 15px 20px;
    }
    .login-container h2 {
        font-size: 20px;
    }
    .login-container button {
        font-size: 14px;
    }
}

@media (max-width: 480px) { /* HP */
    .login-container {
        padding: 10px 15px;
    }
    .login-container h2 {
        font-size: 18px;
    }
    .login-container input, .login-container button {
        font-size: 14px;
    }
}

  </style>
</head>
<body>

  <header>
    <img src="../assets/logo.png" alt="Logo" class="logo">
</header>
  <div class="login-container">
    <h2>Login</h2>
    <form id="loginForm">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </div>

  <script>
    // Tangani form login
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Login successful!');
      // Anda bisa menambahkan logika autentikasi di sini
    });
  </script>
</body>
</html>
