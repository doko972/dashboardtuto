            <header class="header" role="banner">
                <button class="mobile-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation menu">☰</button>

                <div class="header-brand">
                    <h1 class="brand-title">HRTélécoms</h1>
                    <p class="brand-subtitle">Documentations</p>
                </div>
                <div class="header-actions">
                    <div class="theme-selector">
                        <button class="theme-toggle" onclick="toggleThemeDropdown()" id="themeToggle"
                            aria-label="Theme settings" aria-expanded="false" aria-haspopup="true">🎨</button>
                        <div class="theme-dropdown" id="themeDropdown" role="menu" aria-labelledby="themeToggle">
                            <div class="theme-options" role="group" aria-label="Color themes">
                                <button class="theme-option pink active" onclick="setTheme('rose')" role="menuitem"
                                    aria-label="Pink theme" tabindex="0"></button>
                                <button class="theme-option blue" onclick="setTheme('bleu')" role="menuitem"
                                    aria-label="Blue theme" tabindex="-1"></button>
                                <button class="theme-option green" onclick="setTheme('vert')" role="menuitem"
                                    aria-label="Green theme" tabindex="-1"></button>
                                <button class="theme-option purple" onclick="setTheme('violet')" role="menuitem"
                                    aria-label="Purple theme" tabindex="-1"></button>

                            </div>
                            <div class="mode-toggle" role="group" aria-label="Display mode">
                                <button class="mode-btn active" onclick="setMode('clair')" role="menuitem"
                                    aria-pressed="true">☀️ Clair</button>
                                <button class="mode-btn" onclick="setMode('sombre')" role="menuitem"
                                    aria-pressed="false">🌙 Sombre</button>
                            </div>
                        </div>
                    </div>

                    <div class="user-profile" tabindex="0" role="button" aria-label="User profile">
                        <div class="user-avatar" aria-hidden="true">D</div>
                        <div class="user-info">
                            <h3>Utilisateur</h3>
                        </div>
                    </div>
                </div>
            </header>
