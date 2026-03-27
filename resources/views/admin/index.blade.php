<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | La Favela</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favela-v8.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favela-v8.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favela-v8.png') }}">
    <style>
      body {
        margin: 0;
        font-family: "Sora", "Segoe UI", sans-serif;
        background: #fff7de;
        color: #0b241b;
      }
      header {
        position: sticky;
        top: 0;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(6px);
        border-bottom: 1px solid rgba(11, 58, 138, 0.18);
        padding: 14px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        z-index: 5;
      }
      .wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 22px;
      }
      .card {
        background: #fff;
        border: 1px solid rgba(11, 58, 138, 0.18);
        border-radius: 16px;
        padding: 18px;
        box-shadow: 0 12px 24px rgba(11, 36, 27, 0.08);
      }
      .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
      }
      label {
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        margin-bottom: 6px;
        font-weight: 700;
        color: #0b3a8a;
      }
      input, textarea, select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid rgba(11, 58, 138, 0.25);
        font-family: inherit;
      }
      textarea { min-height: 90px; resize: vertical; }
      .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid rgba(11, 58, 138, 0.25);
        background: #0b3a8a;
        color: #fff;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
      }
      .btn.secondary { background: #fff; color: #0b3a8a; }
      .row { display: flex; gap: 12px; flex-wrap: wrap; }
      .notice {
        border: 1px dashed rgba(11, 58, 138, 0.3);
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 10px;
        background: #fffdf2;
      }
      .status {
        margin: 10px 0 0;
        color: #0f5d4c;
        font-weight: 600;
      }
    </style>
  </head>
  <body>
    <header>
      <strong>Admin La Favela</strong>
      <div class="row">
        <a class="btn secondary" href="{{ route('admin.menu', ['locale' => $lang, 'page' => 'menu']) }}">Cartas</a>
        <a class="btn secondary" href="{{ route('home', ['lang' => $lang]) }}" target="_blank" rel="noopener">Ver sitio</a>
      </div>
    </header>

    <div class="wrap">
      @if (session('status'))
        <div class="status">{{ session('status') }}</div>
      @endif

      <div class="card" style="margin-top: 16px;">
        <h2>Ajustes del Home</h2>
        <form method="POST" action="{{ route('admin.settings') }}">
          @csrf
          <div class="row" style="margin-bottom: 12px;">
            <div style="min-width: 180px;">
              <label>Idioma</label>
              <select name="lang" onchange="this.form.submit()">
                @foreach ($supported as $code)
                  <option value="{{ $code }}" {{ $lang === $code ? 'selected' : '' }}>{{ strtoupper($code) }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="grid">
            <div>
              <label>Subtítulo</label>
              <input name="subtitle" value="{{ $settings['subtitle'] ?? '' }}" />
            </div>
            <div>
              <label>Horario</label>
              <input name="hours" value="{{ $settings['hours'] ?? '' }}" />
            </div>
            <div style="grid-column: 1 / -1;">
              <label>Intro visita</label>
              <textarea name="visit_intro">{{ $settings['visit_intro'] ?? '' }}</textarea>
            </div>
            <div style="grid-column: 1 / -1;">
              <label>Banner / AD</label>
              <textarea name="home_ad" placeholder="Ejemplo: Chupitos a 2">{{ $settings['home_ad'] ?? '' }}</textarea>
            </div>
          </div>
          <div style="margin-top: 12px;">
            <button class="btn" type="submit">Guardar ajustes</button>
          </div>
        </form>
      </div>

      <div class="card" style="margin-top: 18px;">
        <h2>Avisos operativos</h2>
        <form method="POST" action="{{ route('admin.notices.store') }}">
          @csrf
          <div class="grid">
            <div>
              <label>Idioma</label>
              <select name="lang">
                <option value="">Todos</option>
                @foreach ($supported as $code)
                  <option value="{{ $code }}">{{ strtoupper($code) }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label>Título</label>
              <input name="title" required />
            </div>
            <div>
              <label>Inicio (opcional)</label>
              <input type="datetime-local" name="starts_at" />
            </div>
            <div>
              <label>Fin (opcional)</label>
              <input type="datetime-local" name="ends_at" />
            </div>
            <div style="grid-column: 1 / -1;">
              <label>Mensaje</label>
              <textarea name="body"></textarea>
            </div>
          </div>
          <div style="margin-top: 12px;">
            <button class="btn" type="submit">Publicar aviso</button>
          </div>
        </form>

        <div style="margin-top: 14px;">
          @forelse ($notices as $notice)
            <div class="notice">
              <strong>{{ $notice->title }}</strong>
              <div style="font-size: 13px; opacity: 0.7;">{{ $notice->lang ? strtoupper($notice->lang) : 'Todos' }}</div>
              @if ($notice->body)
                <p style="margin: 8px 0;">{{ $notice->body }}</p>
              @endif
              <form method="POST" action="{{ route('admin.notices.delete', $notice) }}">
                @csrf
                @method('DELETE')
                <button class="btn secondary" type="submit">Eliminar</button>
              </form>
            </div>
          @empty
            <p>No hay avisos.</p>
          @endforelse
        </div>
      </div>
    </div>
  </body>
</html>
