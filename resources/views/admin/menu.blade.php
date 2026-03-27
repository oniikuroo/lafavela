<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Cartas</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=4">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=4">
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
      .wrap { max-width: 1100px; margin: 0 auto; padding: 22px; }
      .card { background:#fff; border:1px solid rgba(11,58,138,.18); border-radius:16px; padding:18px; box-shadow:0 12px 24px rgba(11,36,27,.08); margin-top:16px; }
      .card:first-child { margin-top: 0; }
      .row { display:flex; gap:12px; flex-wrap:wrap; }
      .grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:12px; }
      label { display:block; font-size:12px; text-transform:uppercase; letter-spacing:.12em; margin-bottom:6px; font-weight:700; color:#0b3a8a; }
      input, select, textarea { width:100%; padding:10px 12px; border-radius:10px; border:1px solid rgba(11,58,138,.25); font-family:inherit; }
      textarea { min-height: 88px; resize: vertical; }
      .btn { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:10px; border:1px solid rgba(11,58,138,.25); background:#0b3a8a; color:#fff; font-weight:700; cursor:pointer; text-decoration:none; }
      .btn.secondary { background:#fff; color:#0b3a8a; }
      .section { border:1px dashed rgba(11,58,138,.3); padding:12px; border-radius:12px; margin-bottom:12px; }
      .status { margin:10px 0 0; color:#0f5d4c; font-weight:600; }
      h2 { margin-top: 0; }
      .field-note { margin-top:6px; font-size:12px; line-height:1.4; color:rgba(11,36,27,.68); }
      .promo-box { margin-top:14px; padding:14px; border-radius:14px; border:1px solid rgba(11,58,138,.18); background:rgba(247,200,0,.08); }
      .meta-badge { display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px; font-size:11px; letter-spacing:.12em; text-transform:uppercase; color:#0b3a8a; background:rgba(11,58,138,.06); border:1px solid rgba(11,58,138,.16); margin-bottom:14px; }
    </style>
  </head>
  <body>
    <header>
      <strong>Admin | Cartas</strong>
      <div class="row">
        <a class="btn secondary" href="{{ route('admin.index', ['lang' => $locale]) }}">Ajustes</a>
        <a class="btn secondary" href="{{ route('home', ['lang' => $locale]) }}" target="_blank" rel="noopener">Ver sitio</a>
      </div>
    </header>

    <div class="wrap">
      @if (session('status'))
        <div class="status">{{ session('status') }}</div>
      @endif

      <div class="card">
        <form method="GET" action="{{ route('admin.menu') }}">
          <div class="row">
            <div>
              <label>Locale</label>
              <select name="locale" onchange="this.form.submit()">
                @foreach ($supportedLocales as $code)
                  <option value="{{ $code }}" {{ $locale === $code ? 'selected' : '' }}>{{ strtoupper($code) }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label>Página</label>
              <select name="page" onchange="this.form.submit()">
                @foreach ($supportedPages as $pageCode)
                  <option value="{{ $pageCode }}" {{ $page === $pageCode ? 'selected' : '' }}>{{ strtoupper($pageCode) }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </form>
      </div>

      <div class="card">
        <h2>Página</h2>
        <form method="POST" action="{{ route('admin.menu.page.update') }}">
          @csrf
          <input type="hidden" name="locale" value="{{ $locale }}">
          <input type="hidden" name="page" value="{{ $page }}">
          <div class="meta-badge">{{ strtoupper($locale) }} · {{ strtoupper($page) }}</div>
          <div class="grid">
            <div>
              <label>Heading</label>
              <input name="heading" value="{{ $payload['heading'] }}" required>
            </div>
            <div>
              <label>Subtitle</label>
              <input name="subtitle" value="{{ $payload['subtitle'] }}">
            </div>
            <div>
              <label>Hours</label>
              <input name="hours" value="{{ $payload['hours'] }}">
            </div>
          </div>
          <div class="promo-box">
            <label>Ad / Promo</label>
            <textarea name="ad" placeholder="Ejemplo: Chupitos a 2">{{ $payload['ad'] }}</textarea>
            <div class="field-note">Este contenido se muestra como recuadro promocional en la página pública seleccionada cuando no está vacío.</div>
          </div>
          <div style="margin-top:12px;">
            <button class="btn" type="submit">Guardar página</button>
          </div>
        </form>
      </div>

      <div class="card">
        <h2>Nueva sección</h2>
        <form method="POST" action="{{ route('admin.menu.sections.store') }}">
          @csrf
          <input type="hidden" name="locale" value="{{ $locale }}">
          <input type="hidden" name="page" value="{{ $page }}">
          <div class="grid">
            <div>
              <label>Título</label>
              <input name="title" required>
            </div>
            <div>
              <label>Posición</label>
              <input name="position" type="number" min="0" value="{{ count($payload['sections']) }}">
            </div>
          </div>
          <div style="margin-top:12px;">
            <button class="btn" type="submit">Crear sección</button>
          </div>
        </form>
      </div>

      <div class="card">
        <h2>Secciones</h2>
        @forelse ($payload['sections'] as $sectionIndex => $section)
          <div class="section">
            <form method="POST" action="{{ route('admin.menu.sections.update') }}">
              @csrf
              <input type="hidden" name="locale" value="{{ $locale }}">
              <input type="hidden" name="page" value="{{ $page }}">
              <input type="hidden" name="section_index" value="{{ $sectionIndex }}">
              <div class="grid">
                <div>
                  <label>Título</label>
                  <input name="title" value="{{ $section['title'] }}" required>
                </div>
                <div>
                  <label>Posición</label>
                  <input name="position" type="number" min="0" value="{{ $sectionIndex }}">
                </div>
              </div>
              <div style="margin-top:10px;">
                <button class="btn" type="submit">Guardar sección</button>
              </div>
            </form>

            <form method="POST" action="{{ route('admin.menu.items.store') }}" style="margin-top:12px;">
              @csrf
              <input type="hidden" name="locale" value="{{ $locale }}">
              <input type="hidden" name="page" value="{{ $page }}">
              <input type="hidden" name="section_index" value="{{ $sectionIndex }}">
              <div class="grid">
                <div>
                  <label>Nombre</label>
                  <input name="name" required>
                </div>
                <div>
                  <label>Descripción</label>
                  <input name="description">
                </div>
                <div>
                  <label>Precio</label>
                  <input name="price">
                </div>
                <div>
                  <label>Posición</label>
                  <input name="position" type="number" min="0" value="{{ count($section['items']) }}">
                </div>
              </div>
              <div style="margin-top:10px;">
                <button class="btn secondary" type="submit">Agregar ítem</button>
              </div>
            </form>

            <div style="margin-top:12px;">
              @foreach ($section['items'] as $itemIndex => $item)
                <div style="margin-bottom:10px;">
                  <form method="POST" action="{{ route('admin.menu.items.update') }}">
                    @csrf
                    <input type="hidden" name="locale" value="{{ $locale }}">
                    <input type="hidden" name="page" value="{{ $page }}">
                    <input type="hidden" name="section_index" value="{{ $sectionIndex }}">
                    <input type="hidden" name="item_index" value="{{ $itemIndex }}">
                    <div class="grid">
                      <div>
                        <label>Nombre</label>
                        <input name="name" value="{{ $item['name'] }}" required>
                      </div>
                      <div>
                        <label>Descripción</label>
                        <input name="description" value="{{ $item['description'] }}">
                      </div>
                      <div>
                        <label>Precio</label>
                        <input name="price" value="{{ $item['price'] }}">
                      </div>
                      <div>
                        <label>Posición</label>
                        <input name="position" type="number" min="0" value="{{ $itemIndex }}">
                      </div>
                    </div>
                    <div class="row" style="margin-top:8px;">
                      <button class="btn" type="submit">Guardar ítem</button>
                    </div>
                  </form>
                  <form method="POST" action="{{ route('admin.menu.items.delete') }}" style="margin-top:8px;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="locale" value="{{ $locale }}">
                    <input type="hidden" name="page" value="{{ $page }}">
                    <input type="hidden" name="section_index" value="{{ $sectionIndex }}">
                    <input type="hidden" name="item_index" value="{{ $itemIndex }}">
                    <button class="btn secondary" type="submit">Eliminar ítem</button>
                  </form>
                </div>
              @endforeach
            </div>

            <form method="POST" action="{{ route('admin.menu.sections.delete') }}" style="margin-top:10px;">
              @csrf
              @method('DELETE')
              <input type="hidden" name="locale" value="{{ $locale }}">
              <input type="hidden" name="page" value="{{ $page }}">
              <input type="hidden" name="section_index" value="{{ $sectionIndex }}">
              <button class="btn secondary" type="submit">Eliminar sección</button>
            </form>
          </div>
        @empty
          <p>No hay secciones.</p>
        @endforelse
      </div>
    </div>
  </body>
</html>
