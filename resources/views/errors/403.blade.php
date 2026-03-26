<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso denegado</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favela-v8.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favela-v8.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favela-v8.png') }}">
    <style>
      body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Sora", "Segoe UI", sans-serif;
        background: #fff3cd;
        color: #0b241b;
      }
      .card {
        max-width: 520px;
        padding: 28px 24px;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 12px 28px rgba(11, 36, 27, 0.12);
        border: 1px solid rgba(11, 58, 138, 0.18);
      }
      h1 {
        margin: 0 0 8px;
        font-size: 22px;
      }
      p {
        margin: 0 0 16px;
        line-height: 1.5;
      }
      a {
        color: #0b3a8a;
        text-decoration: none;
        font-weight: 600;
      }
    </style>
  </head>
  <body>
    <div class="card">
      <h1>Acceso denegado</h1>
      <p>No tienes permisos de administrador. Solicita acceso.</p>
      <a href="/">Volver al inicio</a>
    </div>
  </body>
</html>
