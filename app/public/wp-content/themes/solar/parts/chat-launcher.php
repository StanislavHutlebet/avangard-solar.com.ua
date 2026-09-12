<?php
/**
 * Channel launcher markup — Telegram bot + on-site SendPulse chat.
 * Rendered on wp_footer (see inc/chat-launcher.php). Styles/behaviour live in
 * assets/css/chat-launcher.css and assets/js/chat-launcher.js.
 */

$avs_tg_link = apply_filters( 'avs_chat_telegram_link', 'https://t.me/avangard_client_bot?start=site' );
?>
<div class="avs-chat" id="avsChat" hidden>
  <div class="avs-chat__menu" id="avsChatMenu" role="menu" aria-label="Способи звʼязку">
    <a class="avs-chat__item" role="menuitem" data-avs="tg"
       href="<?php echo esc_url( $avs_tg_link ); ?>" target="_blank" rel="noopener nofollow">
      <span class="avs-chat__ico avs-chat__ico--tg">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-2.1 2.04c-.23.23-.42.42-.72.42z"/></svg>
      </span>
      <span>Написати в Telegram</span>
    </a>
    <button class="avs-chat__item" type="button" role="menuitem" data-avs="web">
      <span class="avs-chat__ico avs-chat__ico--web">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3C7 3 3 6.6 3 11c0 2.5 1.3 4.7 3.4 6.2V21l3.2-1.8c.8.2 1.6.3 2.4.3 5 0 9-3.6 9-8.5S17 3 12 3z"/></svg>
      </span>
      <span>Чат на сайті</span>
    </button>
  </div>

  <button class="avs-chat__fab" type="button" aria-label="Звʼязатися з нами"
          aria-haspopup="true" aria-controls="avsChatMenu" aria-expanded="false">
    <!-- main icon: chat bubble -->
    <svg class="avs-ico-chat" viewBox="0 0 31 33" aria-hidden="true"><path d="M23.7261 0.28125H7.26593C3.48198 0.28125 0.265625 3.43839 0.265625 7.15268V21.0813C0.265625 24.9813 3.48198 28.1384 7.26593 28.1384H18.9962V32.7812C25.4289 32.7812 30.7264 27.5812 30.7264 21.267V7.33839C30.9156 3.43839 27.6993 0.28125 23.7261 0.28125ZM11.8067 16.6241C10.4823 16.6241 9.3471 15.5098 9.3471 14.2098C9.3471 12.9098 10.4823 11.7955 11.8067 11.7955C13.1311 11.7955 14.2662 12.9098 14.2662 14.2098C14.2662 15.5098 13.1311 16.6241 11.8067 16.6241ZM19.3746 16.6241C18.0502 16.6241 16.915 15.5098 16.915 14.2098C16.915 12.9098 18.0502 11.7955 19.3746 11.7955C20.699 11.7955 21.8341 12.9098 21.8341 14.2098C22.0233 15.5098 20.8882 16.6241 19.3746 16.6241Z" fill="#fff"/></svg>
    <svg class="avs-ico-close" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.3 5.7a1 1 0 0 0-1.4 0L12 10.6 7.1 5.7a1 1 0 1 0-1.4 1.4l4.9 4.9-4.9 4.9a1 1 0 1 0 1.4 1.4l4.9-4.9 4.9 4.9a1 1 0 0 0 1.4-1.4L13.4 12l4.9-4.9a1 1 0 0 0 0-1.4z"/></svg>
    <svg class="avs-ico-tg" viewBox="0 0 24 24" aria-hidden="true"><path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-2.1 2.04c-.23.23-.42.42-.72.42z"/></svg>
  </button>
</div>
