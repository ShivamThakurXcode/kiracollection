<style>
  #kira-preloader {
    position: fixed;
    inset: 0;
    z-index: 999999;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity 0.55s ease, visibility 0.55s ease;
  }
  #kira-preloader.kira-hide {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
  }
  .kira-pl__logo {
    height: 64px;
    width: auto;
    display: block;
    animation: kiraPulse 1.6s ease-in-out infinite;
  }
  @keyframes kiraPulse {
    0%, 100% { opacity: 1;   transform: scale(1);    }
    50%       { opacity: 0.6; transform: scale(0.96); }
  }
</style>

<div id="kira-preloader" aria-hidden="true">
  <img
    src="images/logo-header.png"
    alt=""
    class="kira-pl__logo"
    onerror="this.src='images/logo.png'"
  />
</div>

<script>
  (function () {
    var start = Date.now();
    var MIN_MS = 1200;
    function hide() {
      var el = document.getElementById('kira-preloader');
      if (el) el.classList.add('kira-hide');
    }
    function maybeHide() {
      var elapsed = Date.now() - start;
      setTimeout(hide, Math.max(0, MIN_MS - elapsed));
    }
    if (document.readyState === 'complete') maybeHide();
    else window.addEventListener('load', maybeHide);
  })();
</script>
