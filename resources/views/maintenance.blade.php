<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Situs Sedang Dalam Proses Pembangunan</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: #121212;
      color: #ffffff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
    }

    .container {
      max-width: 600px;
      padding: 20px;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 10px;
      color: #00bcd4;
    }

    p {
      font-size: 1.2rem;
      color: #ccc;
    }

    .logo {
      max-width: 150px;
      margin-bottom: 30px;
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }

      p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('img/logo.png') }}" alt="gilaprediksi" class="logo" />
    <h1>Situs Sedang Dalam Proses Maintenis</h1>
    <p>Kami sedang memperbaiki situs ini.</p>
    <p>Mohon kembali beberapa saat lagi. Terima kasih atas pengertian Anda.</p>
  </div>
</body>
</html>
