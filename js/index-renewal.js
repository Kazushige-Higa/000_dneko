(function () {
  'use strict';

  function closestSlideIndex(viewport, slides) {
    var viewportCenter = viewport.scrollLeft + viewport.clientWidth / 2;
    var closestIndex = 0;
    var closestDistance = Infinity;

    slides.forEach(function (slide, index) {
      var slideCenter = slide.offsetLeft + slide.offsetWidth / 2;
      var distance = Math.abs(slideCenter - viewportCenter);
      if (distance < closestDistance) {
        closestDistance = distance;
        closestIndex = index;
      }
    });

    return closestIndex;
  }

  function initSlider(slider) {
    var viewport = slider.querySelector('.dr_slider_viewport');
    var track = slider.querySelector('.dr_slider_track');
    var previous = slider.querySelector('.dr_slider_prev');
    var next = slider.querySelector('.dr_slider_next');
    var dotsContainer = slider.querySelector('[data-slider-dots]');
    var originalSlides = track ? Array.prototype.slice.call(track.children) : [];
    var autoplayDelay = Number(slider.getAttribute('data-autoplay') || 0);
    var autoplayTimer = null;
    var scrollTimer = null;
    var resizeTimer = null;
    var activeIndex = 0;
    var physicalIndex = 0;
    var isJumping = false;

    if (!viewport || originalSlides.length < 1) {
      return;
    }

    function updateDots(index) {
      if (!dotsContainer) {
        return;
      }

      dotsContainer.querySelectorAll('button').forEach(function (dot, dotIndex) {
        dot.classList.toggle('is_active', dotIndex === index);
        dot.setAttribute('aria-current', dotIndex === index ? 'true' : 'false');
      });
    }

    if (dotsContainer) {
      originalSlides.forEach(function (_, index) {
        var dot = document.createElement('button');
        dot.type = 'button';
        dot.setAttribute('aria-label', (index + 1) + '枚目のスライドを表示');
        dotsContainer.appendChild(dot);
      });
      updateDots(0);
    }

    if (originalSlides.length === 1) {
      slider.classList.add('is_static');
      if (previous) {
        previous.hidden = true;
      }
      if (next) {
        next.hidden = true;
      }
      return;
    }

    function prepareClone(slide, position) {
      var clone = slide.cloneNode(true);

      clone.setAttribute('data-renewal-clone', position);
      clone.setAttribute('aria-hidden', 'true');
      clone.removeAttribute('id');
      clone.querySelectorAll('[id]').forEach(function (element) {
        element.removeAttribute('id');
      });
      clone.querySelectorAll('a, button, input, select, textarea, [tabindex]').forEach(function (element) {
        element.setAttribute('tabindex', '-1');
      });
      clone.querySelectorAll('img').forEach(function (image) {
        image.removeAttribute('fetchpriority');
        image.setAttribute('loading', 'lazy');
      });

      return clone;
    }

    var headClones = document.createDocumentFragment();
    var tailClones = document.createDocumentFragment();

    originalSlides.forEach(function (slide) {
      headClones.appendChild(prepareClone(slide, 'head'));
      tailClones.appendChild(prepareClone(slide, 'tail'));
    });

    track.insertBefore(headClones, originalSlides[0]);
    track.appendChild(tailClones);

    var slides = Array.prototype.slice.call(track.children);
    var logicalCount = originalSlides.length;
    physicalIndex = logicalCount;
    slider.classList.add('is_looping');

    function normalizedIndex(index) {
      return ((index % logicalCount) + logicalCount) % logicalCount;
    }

    function slideLeft(index) {
      var slide = slides[index];

      if (!slide) {
        return viewport.scrollLeft;
      }

      var left = slide.offsetLeft - (viewport.clientWidth - slide.offsetWidth) / 2;
      return Math.max(0, left);
    }

    function jumpTo(index) {
      window.clearTimeout(scrollTimer);
      isJumping = true;
      physicalIndex = index;
      activeIndex = normalizedIndex(index);
      updateDots(activeIndex);
      slider.classList.add('is_jumping');
      viewport.scrollTo({ left: slideLeft(index), behavior: 'auto' });
      viewport.getBoundingClientRect();

      window.requestAnimationFrame(function () {
        window.requestAnimationFrame(function () {
          slider.classList.remove('is_jumping');
          isJumping = false;
        });
      });
    }

    function goToPhysical(index) {
      var targetIndex = index;

      if (targetIndex < 0) {
        targetIndex += logicalCount;
        jumpTo(physicalIndex + logicalCount);
      } else if (targetIndex >= slides.length) {
        targetIndex -= logicalCount;
        jumpTo(physicalIndex - logicalCount);
      }

      physicalIndex = targetIndex;
      activeIndex = normalizedIndex(targetIndex);
      updateDots(activeIndex);
      viewport.scrollTo({
        left: slideLeft(targetIndex),
        behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth'
      });
    }

    function goBy(delta) {
      physicalIndex = closestSlideIndex(viewport, slides);
      goToPhysical(physicalIndex + delta);
    }

    function goToLogical(index) {
      var normalized = normalizedIndex(index);
      var candidates = [
        normalized,
        logicalCount + normalized,
        logicalCount * 2 + normalized
      ];
      var closestTarget = candidates[0];
      var closestDistance = Infinity;

      physicalIndex = closestSlideIndex(viewport, slides);
      candidates.forEach(function (candidate) {
        var distance = Math.abs(candidate - physicalIndex);
        if (distance < closestDistance) {
          closestDistance = distance;
          closestTarget = candidate;
        }
      });

      goToPhysical(closestTarget);
    }

    function settlePosition() {
      if (isJumping) {
        return;
      }

      physicalIndex = closestSlideIndex(viewport, slides);
      activeIndex = normalizedIndex(physicalIndex);
      updateDots(activeIndex);

      if (physicalIndex < logicalCount) {
        jumpTo(physicalIndex + logicalCount);
      } else if (physicalIndex >= logicalCount * 2) {
        jumpTo(physicalIndex - logicalCount);
      }
    }

    function resetAutoplay() {
      if (!autoplayDelay || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
      }

      window.clearInterval(autoplayTimer);
      autoplayTimer = window.setInterval(function () {
        goBy(1);
      }, autoplayDelay);
    }

    if (dotsContainer) {
      dotsContainer.querySelectorAll('button').forEach(function (dot, index) {
        dot.addEventListener('click', function () {
          goToLogical(index);
          resetAutoplay();
        });
      });
    }

    if (previous) {
      previous.addEventListener('click', function () {
        goBy(-1);
        resetAutoplay();
      });
    }

    if (next) {
      next.addEventListener('click', function () {
        goBy(1);
        resetAutoplay();
      });
    }

    viewport.addEventListener('scroll', function () {
      if (isJumping) {
        return;
      }

      window.clearTimeout(scrollTimer);
      scrollTimer = window.setTimeout(settlePosition, 100);
    }, { passive: true });

    slider.addEventListener('mouseenter', function () {
      window.clearInterval(autoplayTimer);
    });

    slider.addEventListener('mouseleave', resetAutoplay);
    slider.addEventListener('focusin', function () {
      window.clearInterval(autoplayTimer);
    });
    slider.addEventListener('focusout', resetAutoplay);

    window.addEventListener('resize', function () {
      window.clearTimeout(resizeTimer);
      resizeTimer = window.setTimeout(function () {
        jumpTo(logicalCount + activeIndex);
      }, 120);
    });

    window.requestAnimationFrame(function () {
      jumpTo(logicalCount);
    });

    resetAutoplay();
  }

  function initVideoModal() {
    var modal = document.querySelector('[data-video-modal]');
    var iframe = modal ? modal.querySelector('iframe') : null;
    var closeButton = modal ? modal.querySelector('.dr_video_close') : null;
    var lastTrigger = null;
    var backgroundState = [];

    if (!modal || !iframe || !closeButton) {
      return;
    }

    function lockBackground() {
      backgroundState = Array.prototype.slice.call(document.body.children)
        .filter(function (element) {
          return element !== modal && element.tagName !== 'SCRIPT' && element.tagName !== 'NOSCRIPT';
        })
        .map(function (element) {
          var state = {
            element: element,
            hadInert: element.hasAttribute('inert'),
            ariaHidden: element.getAttribute('aria-hidden')
          };

          element.setAttribute('inert', '');
          element.setAttribute('aria-hidden', 'true');
          return state;
        });
    }

    function unlockBackground() {
      backgroundState.forEach(function (state) {
        if (!state.hadInert) {
          state.element.removeAttribute('inert');
        }

        if (state.ariaHidden === null) {
          state.element.removeAttribute('aria-hidden');
        } else {
          state.element.setAttribute('aria-hidden', state.ariaHidden);
        }
      });
      backgroundState = [];
    }

    function focusableElements() {
      return Array.prototype.slice.call(
        modal.querySelectorAll('button:not([disabled]), a[href], iframe, input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])')
      ).filter(function (element) {
        return !element.hidden && element.getAttribute('aria-hidden') !== 'true';
      });
    }

    function closeModal() {
      if (modal.hidden) {
        return;
      }

      modal.hidden = true;
      iframe.src = '';
      document.body.classList.remove('dr_modal_open');
      unlockBackground();

      if (lastTrigger && document.contains(lastTrigger)) {
        lastTrigger.focus();
      }
    }

    function openModal(trigger) {
      var videoId = trigger.getAttribute('data-youtube-id') || '';

      if (!/^[A-Za-z0-9_-]{11}$/.test(videoId)) {
        return;
      }

      lastTrigger = trigger;
      iframe.src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent(videoId) + '?autoplay=1&rel=0';
      modal.hidden = false;
      document.body.classList.add('dr_modal_open');
      lockBackground();
      window.requestAnimationFrame(function () {
        closeButton.focus();
      });
    }

    document.addEventListener('click', function (event) {
      var trigger = event.target.closest('.dr_movie_trigger');
      var closeTarget = event.target.closest('[data-video-close]');

      if (trigger) {
        openModal(trigger);
        return;
      }

      if (closeTarget && modal.contains(closeTarget)) {
        closeModal();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && !modal.hidden) {
        closeModal();
        return;
      }

      if (event.key === 'Tab' && !modal.hidden) {
        var focusable = focusableElements();
        var first = focusable[0];
        var last = focusable[focusable.length - 1];

        if (!first) {
          event.preventDefault();
          modal.querySelector('.dr_video_dialog').focus();
          return;
        }

        if (event.shiftKey && (document.activeElement === first || !modal.contains(document.activeElement))) {
          event.preventDefault();
          last.focus();
        } else if (!event.shiftKey && (document.activeElement === last || !modal.contains(document.activeElement))) {
          event.preventDefault();
          first.focus();
        }
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-renewal-slider]').forEach(initSlider);
    initVideoModal();
  });
})();
