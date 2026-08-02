(() => {
  const opening = document.getElementById("dneko-opening");
  if (!opening) return;

  const storageKey = "dneko-opening-seen-v1";
  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  try {
    if (window.localStorage.getItem(storageKey)) {
      document.documentElement.classList.remove("dneko-opening-pending", "dneko-opening-lock");
      opening.remove();
      return;
    }
  } catch (error) {
    // Storage unavailable: play the opening for this page load only.
  }

  const finish = () => {
    opening.classList.add("is-leaving");
    document.documentElement.classList.remove("dneko-opening-pending", "dneko-opening-lock");

    if (window.__dnekoOpeningFailsafe) {
      window.clearTimeout(window.__dnekoOpeningFailsafe);
    }

    window.setTimeout(() => {
      opening.remove();
    }, 420);

    try {
      window.localStorage.setItem(storageKey, "1");
    } catch (error) {
      // Keep the website usable even when storage is blocked.
    }
  };

  document.documentElement.classList.add("dneko-opening-pending", "dneko-opening-lock");
  opening.classList.add("is-visible");

  if (reducedMotion) {
    window.setTimeout(finish, 250);
    return;
  }

  window.requestAnimationFrame(() => {
    opening.classList.add("is-playing");
  });
  window.setTimeout(finish, 4700);
})();
