/**
 * Channel launcher for avangard-solar.com.ua.
 * Custom FAB over the SendPulse widget; on click offers Telegram bot or the on-site chat.
 *
 * SendPulse widget = <sp-live-chat> with an OPEN shadow DOM containing button.widget-fab.
 * We hide their button from inside that shadow root and click it programmatically when
 * the visitor picks "chat here". Safeguard: widget not found within 15s -> we touch nothing
 * and just show our own Telegram bubble above where the green one usually is.
 */
(function () {
  var box = document.getElementById('avsChat');
  if (!box) return;

  var fab = box.querySelector('.avs-chat__fab');
  var tgItem = box.querySelector('[data-avs="tg"]');
  var webItem = box.querySelector('[data-avs="web"]');
  var TG_LINK = (tgItem && tgItem.getAttribute('href')) || 'https://t.me/avangard_client_bot?start=site';
  var solo = false;
  var watch = null;   // poll that restores our bubble after their panel closes

  function shadow() {
    var host = document.querySelector('sp-live-chat');
    return host && host.shadowRoot ? host.shadowRoot : null;
  }
  function spFab() {
    var sr = shadow();
    return sr ? sr.querySelector('.widget-fab') : null;
  }
  function open(v) {
    box.classList.toggle('is-open', v);
    fab.setAttribute('aria-expanded', v ? 'true' : 'false');
  }

  // Their bundle loads asynchronously; on a slow network that is seconds. 15s -> fallback.
  var since = Date.now();
  var wait = setInterval(function () {
    var f = spFab();
    if (f) { clearInterval(wait); attach(); }
    else if (Date.now() - since > 15000) { clearInterval(wait); degrade(); }
  }, 300);

  function attach() {
    // Position, size and colour are fixed in chat-launcher.css to match the SendPulse
    // widget (right 20 / bottom 10 / 64px / green). If the widget is ever repositioned
    // in the SendPulse dashboard, update those CSS values.
    // Here we only hide their button from inside the shadow root (outside styles do not
    // reach it) and reveal ours in its place.
    var st = document.createElement('style');
    st.textContent = '.widget-fab{display:none!important}';
    shadow().appendChild(st);

    box.hidden = false;
  }

  // Fallback: widget missing (did not load / disabled) — break nothing, just give Telegram
  // as a standalone button above the usual green-bubble spot.
  function degrade() {
    solo = true;
    box.classList.add('is-solo');
    fab.setAttribute('aria-label', 'Написати в Telegram');
    box.hidden = false;
  }

  fab.addEventListener('click', function () {
    if (solo) { window.open(TG_LINK, '_blank', 'noopener'); return; }
    open(!box.classList.contains('is-open'));
  });

  tgItem.addEventListener('click', function () { open(false); });

  webItem.addEventListener('click', function () {
    var f = spFab();
    if (!f) { degrade(); return; }      // widget vanished between clicks — do not strand the visitor
    open(false);
    box.classList.add('is-hidden');     // our bubble must not overlap their panel
    f.click();
    clearInterval(watch);               // avoid stacking polls on repeated clicks
    watch = setInterval(function () {
      var sr = shadow();
      if (!sr || !sr.querySelector('.widget-panel.widget-open')) {
        clearInterval(watch);
        box.classList.remove('is-hidden');
      }
    }, 500);
  });

  document.addEventListener('click', function (e) {
    if (!box.contains(e.target)) open(false);
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') open(false);
  });
})();
