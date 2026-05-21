<style>
  /* ===== Mandala Reveal Loader ===== */
  #preloader {
    position: fixed;
    inset: 0;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    background: radial-gradient(circle at 25% 20%, #3b372d 0%, #2c281f 45%, #221f18 78%, #191611 100%);
    transition: opacity 0.8s ease, visibility 0.8s ease;
  }

  #preloader::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
      radial-gradient(circle at 70% 30%, rgba(218, 165, 32, 0.14), transparent 45%),
      radial-gradient(circle at 30% 70%, rgba(85, 107, 47, 0.16), transparent 45%),
      repeating-linear-gradient(45deg, rgba(0, 0, 0, 0.2) 0 2px, transparent 2px 7px);
    opacity: 0.75;
  }

  .preloader.loaded,
  #preloader.hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
  }

  .mandala-reveal {
    position: relative;
    display: grid;
    place-items: center;
    gap: 16px;
    z-index: 1;
  }

  .mandala-reveal__core {
    position: relative;
    width: 230px;
    height: 230px;
    animation: mandalaBreath 6s ease-in-out infinite;
  }

  .mandala-reveal__glow {
    position: absolute;
    inset: -30px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(218, 165, 32, 0.28) 0%, rgba(218, 165, 32, 0.08) 50%, transparent 75%);
    filter: blur(1px);
    animation: glowPulse 4s ease-in-out infinite;
  }

  .mandala-reveal__ring {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
  }

  .mandala-reveal__ring path,
  .mandala-reveal__ring circle {
    fill: none;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 600;
    stroke-dashoffset: 600;
    animation: drawStroke 3.8s ease forwards;
  }

  .mandala-reveal__ring.ring-1 {
    animation: ringFloat 18s ease-in-out infinite;
  }

  .mandala-reveal__ring.ring-2 {
    animation: ringFloatReverse 20s ease-in-out infinite;
  }

  .mandala-reveal__ring.ring-3 {
    animation: ringFloat 22s ease-in-out infinite;
  }

  .mandala-reveal__ring.ring-1 path,
  .mandala-reveal__ring.ring-1 circle {
    animation-delay: 0.2s;
  }

  .mandala-reveal__ring.ring-2 path,
  .mandala-reveal__ring.ring-2 circle {
    animation-delay: 0.8s;
  }

  .mandala-reveal__ring.ring-3 path,
  .mandala-reveal__ring.ring-3 circle {
    animation-delay: 1.4s;
  }

  .mandala-reveal__dots {
    position: absolute;
    inset: 0;
    display: grid;
    place-items: center;
    opacity: 0;
    animation: dotsFade 2.6s ease 1.6s forwards;
  }

  .mandala-reveal__dots span {
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: rgba(218, 165, 32, 0.85);
    box-shadow: 0 0 10px rgba(218, 165, 32, 0.7);
  }

  .mandala-reveal__dots span:nth-child(1) {
    top: 12px;
    left: 50%;
  }

  .mandala-reveal__dots span:nth-child(2) {
    right: 16px;
    top: 35%;
  }

  .mandala-reveal__dots span:nth-child(3) {
    bottom: 12px;
    left: 45%;
  }

  .mandala-reveal__dots span:nth-child(4) {
    left: 12px;
    top: 40%;
  }

  .mandala-reveal__dots span:nth-child(5) {
    right: 28px;
    bottom: 30%;
  }

  .mandala-reveal__dots span:nth-child(6) {
    left: 28px;
    bottom: 30%;
  }

  .mandala-reveal__logo {
    position: absolute;
    inset: 0;
    display: grid;
    place-items: center;
    opacity: 0;
    animation: logoReveal 2.4s ease 2.1s forwards;
  }

  .mandala-reveal__logo-badge {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: transparent;
    border: none;
    box-shadow: none;
    display: grid;
    place-items: center;
  }

  .mandala-reveal__logo-badge img {
    width: 30px;
    height: auto;
    display: block;
    filter: drop-shadow(0 0 10px rgba(218, 165, 32, 0.45));
  }

  .mandala-reveal__shimmer {
    position: absolute;
    inset: -14px;
    border-radius: 50%;
    background: conic-gradient(from 0deg, rgba(255, 255, 255, 0) 0deg, rgba(255, 255, 255, 0.25) 25deg, rgba(255, 255, 255, 0) 65deg);
    animation: shimmerSweep 7s ease-in-out infinite;
    mix-blend-mode: soft-light;
    opacity: 0.4;
  }

  .mandala-reveal__dust span {
    position: absolute;
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: rgba(218, 165, 32, 0.85);
    box-shadow: 0 0 10px rgba(218, 165, 32, 0.7);
    animation: dustFloat 4s ease-in-out infinite;
  }

  .mandala-reveal__dust span:nth-child(1) {
    top: -6px;
    left: 50%;
    animation-delay: 0s;
  }

  .mandala-reveal__dust span:nth-child(2) {
    top: 10%;
    right: -8px;
    animation-delay: 0.8s;
  }

  .mandala-reveal__dust span:nth-child(3) {
    bottom: -6px;
    left: 40%;
    animation-delay: 1.4s;
  }

  .mandala-reveal__dust span:nth-child(4) {
    top: 28%;
    left: -8px;
    animation-delay: 2s;
  }

  .mandala-reveal__dust span:nth-child(5) {
    bottom: 24%;
    right: -6px;
    animation-delay: 1s;
  }

  .mandala-reveal__dust span:nth-child(6) {
    top: 6%;
    left: 30%;
    animation-delay: 2.6s;
  }

  .mandala-reveal__caption {
    font-family: 'Urbanist', sans-serif;
    font-size: 12px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(240, 230, 210, 0.75);
    opacity: 0;
    animation: captionFade 2.4s ease 2.2s forwards;
  }

  @keyframes drawStroke {
    to {
      stroke-dashoffset: 0;
    }
  }

  @keyframes ringFloat {

    0%,
    100% {
      transform: rotate(0deg);
    }

    50% {
      transform: rotate(6deg);
    }
  }

  @keyframes ringFloatReverse {

    0%,
    100% {
      transform: rotate(0deg);
    }

    50% {
      transform: rotate(-6deg);
    }
  }

  @keyframes glowPulse {

    0%,
    100% {
      opacity: 0.55;
      transform: scale(1);
    }

    50% {
      opacity: 0.9;
      transform: scale(1.04);
    }
  }

  @keyframes mandalaBreath {

    0%,
    100% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.02);
    }
  }

  @keyframes logoReveal {
    0% {
      opacity: 0;
      transform: scale(0.92);
    }

    100% {
      opacity: 1;
      transform: scale(1);
    }
  }

  @keyframes dotsFade {
    to {
      opacity: 1;
    }
  }

  @keyframes shimmerSweep {
    0% {
      transform: rotate(0deg);
      opacity: 0.1;
    }

    50% {
      opacity: 0.5;
    }

    100% {
      transform: rotate(360deg);
      opacity: 0.1;
    }
  }

  @keyframes dustFloat {

    0%,
    100% {
      opacity: 0.2;
      transform: scale(0.8);
    }

    50% {
      opacity: 1;
      transform: scale(1.25);
    }
  }

  @keyframes captionFade {
    to {
      opacity: 1;
    }
  }

  @media (max-width: 480px) {
    .mandala-reveal__core {
      width: 180px;
      height: 180px;
    }

    .mandala-reveal__caption {
      font-size: 11px;
    }

    .mandala-reveal__logo-badge {
      width: 46px;
      height: 46px;
    }

    .mandala-reveal__logo-badge img {
      width: 26px;
    }
  }
</style>

<div id="preloader" class="preloader preloader-mandala">
  <div class="mandala-reveal">
    <div class="mandala-reveal__core">
      <div class="mandala-reveal__glow"></div>

      <svg class="mandala-reveal__ring ring-1" viewBox="0 0 240 240" aria-hidden="true">
        <circle cx="120" cy="120" r="106" stroke="rgba(218,165,32,0.9)" stroke-width="1.2" stroke-dasharray="4 8" />
        <circle cx="120" cy="120" r="90" stroke="rgba(85,107,47,0.75)" stroke-width="1" stroke-dasharray="10 10" />
      </svg>

      <svg class="mandala-reveal__ring ring-2" viewBox="0 0 240 240" aria-hidden="true">
        <circle cx="120" cy="120" r="72" stroke="rgba(218,165,32,0.75)" stroke-width="1" stroke-dasharray="2 6" />
        <path d="M120 40 L132 70 L160 80 L132 90 L120 120 L108 90 L80 80 L108 70 Z" stroke="rgba(85,107,47,0.8)"
          stroke-width="1" />
      </svg>

      <svg class="mandala-reveal__ring ring-3" viewBox="0 0 240 240" aria-hidden="true">
        <circle cx="120" cy="120" r="48" stroke="rgba(201,162,92,0.9)" stroke-width="1" stroke-dasharray="3 7" />
        <circle cx="120" cy="120" r="34" stroke="rgba(245,235,210,0.8)" stroke-width="1" stroke-dasharray="2 5" />
      </svg>

      <div class="mandala-reveal__dots">
        <span></span><span></span><span></span><span></span><span></span><span></span>
      </div>

      <div class="mandala-reveal__logo">
        <div class="mandala-reveal__logo-badge">
          <img src="images/logo-header.png" alt="Kiracollection Art">
        </div>
      </div>

      <div class="mandala-reveal__shimmer"></div>

      <div class="mandala-reveal__dust">
        <span></span><span></span><span></span><span></span><span></span><span></span>
      </div>
    </div>

    <div class="mandala-reveal__caption">Crafting Art...</div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
      var preloader = document.getElementById('preloader');
      if (preloader) preloader.classList.add('hidden');
    }, 600);
  });
</script>