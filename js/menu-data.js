(() => {
  const grid = document.querySelector('.menu-grid');
  if (!grid) return;

  const page = grid.getAttribute('data-menu-page');
  if (!page) return;

  const lang = document.documentElement.lang || 'es';
  const dataUrl = `/data/${lang}/${page}.json`;

  const bindText = (selector, value) => {
    const el = document.querySelector(selector);
    if (el && value) el.textContent = value;
  };

  fetch(dataUrl)
    .then((res) => {
      if (!res.ok) throw new Error(`Failed to load ${dataUrl}`);
      return res.json();
    })
    .then((data) => {
      bindText('[data-menu-title]', data.title);
      bindText('[data-menu-subtitle]', data.subtitle);
      bindText('[data-menu-hours]', data.hours);
      if (data.ad) {
        bindText('[data-menu-ad]', data.ad);
      }

      grid.innerHTML = '';
      if (!Array.isArray(data.sections)) return;

      data.sections.forEach((section) => {
        const card = document.createElement('div');
        card.className = 'menu-card';

        const h3 = document.createElement('h3');
        h3.textContent = section.title || '';
        card.appendChild(h3);

        (section.items || []).forEach((item) => {
          const itemRow = document.createElement('div');
          itemRow.className = 'menu-item';

          const left = document.createElement('div');
          const name = document.createElement('span');
          name.textContent = item.name || '';
          left.appendChild(name);

          if (item.description) {
            const desc = document.createElement('small');
            desc.textContent = item.description;
            left.appendChild(desc);
          }

          const price = document.createElement('div');
          price.className = 'price';
          price.textContent = item.price || '';

          itemRow.appendChild(left);
          itemRow.appendChild(price);
          card.appendChild(itemRow);
        });

        grid.appendChild(card);
      });
    })
    .catch((err) => {
      console.error(err);
    });
})();
