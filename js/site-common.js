(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var button = document.querySelector('.dr_menu_button');
    var navigation = document.querySelector('.dr_global_nav');
    var mobileQuery = window.matchMedia('(max-width: 820px)');
    var backgroundState = [];

    if (!button || !navigation) {
      return;
    }

    function lockBackground() {
      backgroundState = Array.prototype.slice.call(document.body.children)
        .filter(function (element) {
          return !element.matches('.dr_header, script, noscript');
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

    function syncNavigationVisibility(isOpen) {
      if (mobileQuery.matches) {
        navigation.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
      } else {
        navigation.removeAttribute('aria-hidden');
      }
    }

    function menuFocusableElements() {
      return [button].concat(Array.prototype.slice.call(
        navigation.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])')
      ));
    }

    function openMenu() {
      navigation.classList.add('is_open');
      button.setAttribute('aria-expanded', 'true');
      button.setAttribute('aria-label', 'メニューを閉じる');
      document.body.classList.add('dr_menu_open');
      syncNavigationVisibility(true);
      lockBackground();

      window.requestAnimationFrame(function () {
        var firstLink = navigation.querySelector('a[href]');
        if (firstLink) {
          firstLink.focus();
        }
      });
    }

    function closeMenu(restoreFocus) {
      navigation.classList.remove('is_open');
      button.setAttribute('aria-expanded', 'false');
      button.setAttribute('aria-label', 'メニューを開く');
      document.body.classList.remove('dr_menu_open');
      unlockBackground();
      syncNavigationVisibility(false);
      if (restoreFocus) {
        button.focus();
      }
    }

    button.addEventListener('click', function () {
      if (navigation.classList.contains('is_open')) {
        closeMenu(true);
      } else {
        openMenu();
      }
    });

    navigation.addEventListener('click', function (event) {
      if (event.target.closest('a') && window.matchMedia('(max-width: 820px)').matches) {
        closeMenu(false);
      }
    });

    document.addEventListener('click', function (event) {
      if (navigation.classList.contains('is_open') && !event.target.closest('.dr_header')) {
        closeMenu(false);
      }
    });

    document.addEventListener('keydown', function (event) {
      if (!navigation.classList.contains('is_open')) {
        return;
      }

      if (event.key === 'Escape') {
        closeMenu(true);
        return;
      }

      if (event.key === 'Tab') {
        var focusable = menuFocusableElements();
        var first = focusable[0];
        var last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
          event.preventDefault();
          last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
          event.preventDefault();
          first.focus();
        }
      }
    });

    window.addEventListener('resize', function () {
      if (!mobileQuery.matches) {
        closeMenu(false);
      } else {
        syncNavigationVisibility(navigation.classList.contains('is_open'));
      }
    });

    syncNavigationVisibility(false);
  });
})();
