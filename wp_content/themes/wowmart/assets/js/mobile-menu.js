/**
 * Accessible Mobile Menu with Focus Trap & Dropdown Toggles
 *
 * Features:
 * - Topbar with logo and hamburger button
 * - Slide-in panel with close button and logo
 * - Dropdown toggle buttons with chevron icons injected for parent menu items
 * - Animated submenus with smooth expand/collapse
 * - Full keyboard accessibility (Tab, Shift+Tab, Escape, Arrow keys)
 * - Focus trap: when menu is open, keyboard focus stays inside panel
 * - ARIA state management for screen readers
 * - Overlay backdrop closes menu on click
 * - Body scroll lock when menu is open
 * - Supports nested submenus at any depth
 */

(function () {
	'use strict';

	// Elements
	var menuBar   = document.getElementById('wsm-menu');
	var openBtn   = document.getElementById('mmenu-btn');
	var closeBtn  = document.getElementById('mmenu-close-btn');
	var panel     = document.getElementById('mobile-menu-panel');
	var overlay   = document.getElementById('mobile-menu-overlay');

	if (!menuBar || !openBtn || !panel) {
		return;
	}

	var isMenuOpen = false;

	// Chevron SVG (down arrow)
	var CHEVRON_SVG =
		'<svg class="toggle-icon" width="18" height="18" viewBox="0 0 24 24" ' +
		'fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">' +
		'<path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" ' +
		'stroke-linecap="round" stroke-linejoin="round"/></svg>';

	// -------------------------------------------------------
	// Focus-trap helpers
	// -------------------------------------------------------
	var FOCUSABLE_SELECTOR =
		'a[href]:not([disabled]):not([tabindex="-1"]), ' +
		'button:not([disabled]):not([tabindex="-1"]), ' +
		'textarea:not([disabled]):not([tabindex="-1"]), ' +
		'input:not([disabled]):not([tabindex="-1"]), ' +
		'select:not([disabled]):not([tabindex="-1"]), ' +
		'[tabindex]:not([tabindex="-1"])';

	function getFocusableElements() {
		if (!panel) return [];
		var all = panel.querySelectorAll(FOCUSABLE_SELECTOR);
		var visible = [];
		for (var i = 0; i < all.length; i++) {
			if (all[i].offsetParent !== null) {
				visible.push(all[i]);
			}
		}
		return visible;
	}

	// -------------------------------------------------------
	// Inject dropdown toggle buttons
	// -------------------------------------------------------
	function injectDropdownToggles() {
		var parents = panel.querySelectorAll(
			'.menu-item-has-children, .page_item_has_children'
		);

		for (var i = 0; i < parents.length; i++) {
			// Skip if already has a toggle button
			if (parents[i].querySelector(':scope > .submenu-toggle')) {
				continue;
			}

			var link = parents[i].querySelector(':scope > a');
			if (!link) continue;

			// Get menu text for aria-label
			var menuText = link.textContent.trim();

			// Create toggle button
			var toggleBtn = document.createElement('button');
			toggleBtn.className = 'submenu-toggle';
			toggleBtn.setAttribute('type', 'button');
			toggleBtn.setAttribute('aria-expanded', 'false');
			toggleBtn.setAttribute('aria-label', 'Expand ' + menuText + ' submenu');
			toggleBtn.innerHTML = CHEVRON_SVG;

			// Insert after the link (before sub-menu)
			link.insertAdjacentElement('afterend', toggleBtn);

			// Click handler
			toggleBtn.addEventListener('click', handleToggleClick);

			// Focus handler – open dropdown when tabbed to (keyboard navigation)
			toggleBtn.addEventListener('focus', handleToggleFocus);
		}
	}

	// Track whether focus just opened a submenu, so click doesn't immediately close it
	var focusJustOpened = false;
	var focusOpenTimer = null;

	function handleToggleClick(e) {
		e.preventDefault();
		e.stopPropagation();

		// If focus just auto-opened this submenu, skip the click so it doesn't close
		if (focusJustOpened) {
			focusJustOpened = false;
			return;
		}

		var toggleBtn = e.currentTarget;
		var parentItem = toggleBtn.parentNode;
		var isOpen = parentItem.classList.contains('submenu-open');

		if (isOpen) {
			closeSubmenu(parentItem, toggleBtn);
		} else {
			closeSiblingSubmenus(parentItem);
			openSubmenu(parentItem, toggleBtn);
		}
	}

	function handleToggleFocus(e) {
		if (!isMenuOpen) return;

		var toggleBtn = e.currentTarget;
		var parentItem = toggleBtn.parentNode;
		var isOpen = parentItem.classList.contains('submenu-open');

		// Open only if not already open
		if (!isOpen) {
			closeSiblingSubmenus(parentItem);
			openSubmenu(parentItem, toggleBtn);

			// Set flag so the subsequent click (if any) won't close it
			focusJustOpened = true;
			clearTimeout(focusOpenTimer);
			// Reset flag after a short delay — if no click follows, clear it
			focusOpenTimer = setTimeout(function () {
				focusJustOpened = false;
			}, 300);
		}
	}

	function openSubmenu(parentItem, toggleBtn) {
		parentItem.classList.add('submenu-open');
		toggleBtn.setAttribute('aria-expanded', 'true');

		var menuText = '';
		var link = parentItem.querySelector(':scope > a');
		if (link) menuText = link.textContent.trim();
		toggleBtn.setAttribute('aria-label', 'Collapse ' + menuText + ' submenu');
	}

	function closeSubmenu(parentItem, toggleBtn) {
		parentItem.classList.remove('submenu-open');
		toggleBtn.setAttribute('aria-expanded', 'false');

		var menuText = '';
		var link = parentItem.querySelector(':scope > a');
		if (link) menuText = link.textContent.trim();
		toggleBtn.setAttribute('aria-label', 'Expand ' + menuText + ' submenu');

		// Also close any nested open submenus
		var nestedOpen = parentItem.querySelectorAll('.submenu-open');
		for (var i = 0; i < nestedOpen.length; i++) {
			nestedOpen[i].classList.remove('submenu-open');
			var btn = nestedOpen[i].querySelector(':scope > .submenu-toggle');
			if (btn) {
				btn.setAttribute('aria-expanded', 'false');
				var nestedLink = nestedOpen[i].querySelector(':scope > a');
				if (nestedLink) {
					btn.setAttribute('aria-label', 'Expand ' + nestedLink.textContent.trim() + ' submenu');
				}
			}
		}
	}

	function closeSiblingSubmenus(parentItem) {
		var parent = parentItem.parentNode;
		if (!parent) return;

		var siblings = parent.querySelectorAll(':scope > .submenu-open');
		for (var i = 0; i < siblings.length; i++) {
			if (siblings[i] !== parentItem) {
				var btn = siblings[i].querySelector(':scope > .submenu-toggle');
				if (btn) {
					closeSubmenu(siblings[i], btn);
				}
			}
		}
	}

	function closeAllSubmenus() {
		var openItems = panel.querySelectorAll('.submenu-open');
		for (var i = 0; i < openItems.length; i++) {
			openItems[i].classList.remove('submenu-open');
			var btn = openItems[i].querySelector(':scope > .submenu-toggle');
			if (btn) {
				btn.setAttribute('aria-expanded', 'false');
				var link = openItems[i].querySelector(':scope > a');
				if (link) {
					btn.setAttribute('aria-label', 'Expand ' + link.textContent.trim() + ' submenu');
				}
			}
		}
	}

	// -------------------------------------------------------
	// Open / Close / Toggle Menu
	// -------------------------------------------------------
	function openMenu() {
		isMenuOpen = true;

		// Visual state
		menuBar.classList.add('menu-open');
		panel.classList.add('panel-open');
		panel.setAttribute('aria-hidden', 'false');
		if (overlay) {
			overlay.classList.add('active');
			overlay.setAttribute('aria-hidden', 'false');
		}
		openBtn.setAttribute('aria-expanded', 'true');

		// Lock body scroll
		document.body.classList.add('mobile-menu-is-open');

		// Inject toggle buttons (idempotent)
		injectDropdownToggles();

		// Move focus to the close button
		if (closeBtn) {
			closeBtn.focus();
		}

		// Attach keyboard handler
		document.addEventListener('keydown', handleKeyDown);
	}

	function closeMenu() {
		isMenuOpen = false;

		// Visual state
		menuBar.classList.remove('menu-open');
		panel.classList.remove('panel-open');
		panel.setAttribute('aria-hidden', 'true');
		if (overlay) {
			overlay.classList.remove('active');
			overlay.setAttribute('aria-hidden', 'true');
		}
		openBtn.setAttribute('aria-expanded', 'false');

		// Unlock body scroll
		document.body.classList.remove('mobile-menu-is-open');

		// Collapse all sub-menus
		closeAllSubmenus();

		// Return focus to hamburger button
		openBtn.focus();

		// Detach keyboard handler
		document.removeEventListener('keydown', handleKeyDown);
	}

	function toggleMenu() {
		if (isMenuOpen) {
			closeMenu();
		} else {
			openMenu();
		}
	}

	// -------------------------------------------------------
	// Keyboard handler – focus trap + navigation
	// -------------------------------------------------------
	function handleKeyDown(e) {
		if (!isMenuOpen) return;

		var key = e.key;

		// Escape → close menu
		if (key === 'Escape') {
			e.preventDefault();
			closeMenu();
			return;
		}

		// Tab / Shift+Tab → trap focus inside panel
		if (key === 'Tab') {
			var focusable = getFocusableElements();
			if (focusable.length === 0) {
				e.preventDefault();
				return;
			}

			var first = focusable[0];
			var last  = focusable[focusable.length - 1];

			if (e.shiftKey) {
				if (document.activeElement === first) {
					e.preventDefault();
					last.focus();
				}
			} else {
				if (document.activeElement === last) {
					e.preventDefault();
					first.focus();
				}
			}
			return;
		}

		// Arrow keys for menu item navigation
		if (key === 'ArrowDown' || key === 'ArrowUp') {
			e.preventDefault();
			var focusable = getFocusableElements();
			var idx = -1;
			for (var i = 0; i < focusable.length; i++) {
				if (focusable[i] === document.activeElement) {
					idx = i;
					break;
				}
			}

			if (key === 'ArrowDown') {
				var next = idx < focusable.length - 1 ? idx + 1 : 0;
				focusable[next].focus();
			} else {
				var prev = idx > 0 ? idx - 1 : focusable.length - 1;
				focusable[prev].focus();
			}
			return;
		}

		// Home / End keys
		if (key === 'Home') {
			e.preventDefault();
			var focusable = getFocusableElements();
			if (focusable.length) focusable[0].focus();
			return;
		}
		if (key === 'End') {
			e.preventDefault();
			var focusable = getFocusableElements();
			if (focusable.length) focusable[focusable.length - 1].focus();
			return;
		}
	}

	// -------------------------------------------------------
	// Event bindings
	// -------------------------------------------------------

	// Hamburger button
	openBtn.addEventListener('click', function (e) {
		e.preventDefault();
		toggleMenu();
	});

	openBtn.addEventListener('keydown', function (e) {
		if (e.key === 'Enter' || e.key === ' ') {
			e.preventDefault();
			toggleMenu();
		}
	});

	// Close button inside panel
	if (closeBtn) {
		closeBtn.addEventListener('click', function (e) {
			e.preventDefault();
			closeMenu();
		});

		closeBtn.addEventListener('keydown', function (e) {
			if (e.key === 'Enter' || e.key === ' ') {
				e.preventDefault();
				closeMenu();
			}
		});
	}

	// Overlay click
	if (overlay) {
		overlay.addEventListener('click', function () {
			closeMenu();
		});
	}

	// Close on outside click (fallback)
	document.addEventListener('click', function (e) {
		if (!isMenuOpen) return;
		if (panel.contains(e.target) || openBtn.contains(e.target)) return;
		closeMenu();
	});

	// Close if window grows wider than mobile breakpoint
	window.addEventListener('resize', function () {
		if (window.innerWidth > 991 && isMenuOpen) {
			closeMenu();
		}
	});

})();