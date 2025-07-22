<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        // Global Variables
        let currentTheme = 'Rose';
        let currentMode = 'Clair';
        let currentTab = 'Tableau de bord';

        // Drag and Drop Variables
        let draggedElement = null;
        let draggedFromColumn = null;

        // Initialize App
        document.addEventListener('DOMContentLoaded', function() {
            initializeApp();
            setupDragAndDrop();
            showWelcomeNotifications();
        });

        function initializeApp() {
            // Load saved preferences
            const savedTheme = localStorage.getItem('theme') || 'Rose';
            const savedMode = localStorage.getItem('mode') || 'Clair';

            setTheme(savedTheme);
            setMode(savedMode);

            // Set up event listeners
            setupEventListeners();

            // Initialize timer display
            updateTimerDisplay();
        }

        function setupEventListeners() {
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    switch (e.key) {
                        case '1':
                            e.preventDefault();
                            switchMode('dashboard');
                            break;
                        case '2':
                            e.preventDefault();
                            switchMode('technique');
                            break;
                        case '3':
                            e.preventDefault();
                            switchMode('adv');
                            break;
                        case '4':
                            e.preventDefault();
                            switchMode('comptabilite');
                            break;
                        case '5':
                            e.preventDefault();
                            switchMode('commerciaux');
                            break;
                        case 't':
                            e.preventDefault();
                            toggleThemeDropdown();
                            break;
                    }
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.theme-selector')) {
                    document.getElementById('themeDropdown').classList.remove('show');
                    document.getElementById('themeToggle').setAttribute('aria-expanded', 'false');
                }
            });

            // Focus input enhancement
            const focusInput = document.getElementById('focusInput');
            if (focusInput) {
                focusInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const value = this.value.trim();
                        if (value) {
                            showNotification(`Focus set: ${value}`, 'success');
                            localStorage.setItem('dailyFocus', value);
                        }
                    }
                });

                // Load saved focus
                const savedFocus = localStorage.getItem('dailyFocus');
                if (savedFocus) {
                    focusInput.value = savedFocus;
                }
            }
        }

        // Theme Management
        function toggleThemeDropdown() {
            const dropdown = document.getElementById('themeDropdown');
            const toggle = document.getElementById('themeToggle');
            const isOpen = dropdown.classList.contains('show');

            dropdown.classList.toggle('show');
            toggle.setAttribute('aria-expanded', !isOpen);

            if (!isOpen) {
                // Focus first theme option
                dropdown.querySelector('.theme-option').focus();
            }
        }

        function setTheme(theme) {
            currentTheme = theme;
            document.body.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);

            // Update active theme option
            document.querySelectorAll('.theme-option').forEach(option => {
                option.classList.remove('active');
                option.setAttribute('tabindex', '-1');
            });

            const activeOption = document.querySelector(`.theme-option.${theme}`);
            if (activeOption) {
                activeOption.classList.add('active');
                activeOption.setAttribute('tabindex', '0');
            }

            showNotification(`Theme ${theme}`, 'info');
        }

        function setMode(mode) {
            currentMode = mode;
            document.body.setAttribute('data-mode', mode);
            localStorage.setItem('mode', mode);

            // Update mode buttons
            document.querySelectorAll('.mode-btn').forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-pressed', 'false');
            });

            const activeBtn = document.querySelector(`.mode-btn[onclick="setMode('${mode}')"]`);
            if (activeBtn) {
                activeBtn.classList.add('active');
                activeBtn.setAttribute('aria-pressed', 'true');
            }

            showNotification(`${mode} mode`, 'info');
        }

        // Mode Switching
        function switchMode(mode) {
            currentTab = mode;

            // Update tab states

            showNotification(`${mode} mode`, 'info');
        }

        // Mode Switching
        function switchMode(mode) {
            currentTab = mode;

            // Update tab states
            document.querySelectorAll('.mode-tab').forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
            });

            document.querySelectorAll('.mode-content').forEach(content => {
                content.classList.remove('active');
            });

            // Activate selected tab and content
            const activeTab = document.querySelector(`[onclick="switchMode('${mode}')"]`);
            const activeContent = document.getElementById(`${mode}-mode`);

            if (activeTab && activeContent) {
                activeTab.classList.add('active');
                activeTab.setAttribute('aria-selected', 'true');
                activeContent.classList.add('active');
            }

            // Announce mode change for screen readers
            const modeNames = {
                dashboard: 'Dashboard',
                technique: 'Page technique',
                adv: 'Page Administrative',
                comptabilite: 'Page comptabilité',
                commerciaux: 'Page commerciaux'
            };

            showNotification(`${modeNames[mode]}`, 'info');
        }

        // Drag and Drop Functions
        function setupDragAndDrop() {
            const taskCards = document.querySelectorAll('.task-card');
            const columns = document.querySelectorAll('.kanban-column');

            taskCards.forEach(card => {
                card.addEventListener('dragstart', handleDragStart);
                card.addEventListener('dragend', handleDragEnd);

                // Keyboard support
                card.addEventListener('keydown', handleCardKeydown);
            });

            columns.forEach(column => {
                column.addEventListener('dragover', handleDragOver);
                column.addEventListener('drop', handleDrop);
                column.addEventListener('dragenter', handleDragEnter);
                column.addEventListener('dragleave', handleDragLeave);
            });
        }

        function handleDragStart(e) {
            draggedElement = this;
            draggedFromColumn = this.closest('.kanban-column').dataset.column;
            this.classList.add('dragging');

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.outerHTML);

            // Announce drag start for screen readers
            showNotification(`Started moving ${this.querySelector('.task-title').textContent}`, 'info');
        }

        function handleDragEnd(e) {
            this.classList.remove('dragging');

            // Clean up drag over states
            document.querySelectorAll('.kanban-column').forEach(col => {
                col.classList.remove('drag-over');
            });
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.dataTransfer.dropEffect = 'move';
            return false;
        }

        function handleDragEnter(e) {
            this.classList.add('drag-over');
        }

        function handleDragLeave(e) {
            if (!this.contains(e.relatedTarget)) {
                this.classList.remove('drag-over');
            }
        }

        function handleDrop(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            }

            const targetColumn = this.dataset.column;

            if (draggedElement && draggedFromColumn !== targetColumn) {
                // Move the task to new column
                const addButton = this.querySelector('.add-task-btn');
                this.insertBefore(draggedElement, addButton);

                // Update column counts
                updateColumnCounts();

                // Show success notification
                const taskTitle = draggedElement.querySelector('.task-title').textContent;
                const columnNames = {
                    planning: 'Planning',
                    development: 'In Development',
                    review: 'Code Review',
                    deployed: 'Deployed'
                };

                showNotification(`Moved "${taskTitle}" to ${columnNames[targetColumn]}`, 'success');

                // Save state to localStorage
                saveKanbanState();
            }

            this.classList.remove('drag-over');
            return false;
        }

        function handleCardKeydown(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                // Show task details or edit mode
                const taskTitle = this.querySelector('.task-title').textContent;
                showNotification(`Selected: ${taskTitle}`, 'info');
            }
        }

        function updateColumnCounts() {
            const columns = ['planning', 'development', 'review', 'deployed'];

            columns.forEach(columnId => {
                const column = document.querySelector(`[data-column="${columnId}"]`);
                const taskCount = column.querySelectorAll('.task-card').length;
                const countElement = document.getElementById(`${columnId}-count`);

                if (countElement) {
                    countElement.textContent = taskCount;
                    countElement.setAttribute('aria-label', `${taskCount} items`);
                }
            });
        }

        function saveKanbanState() {
            const kanbanState = {};
            const columns = document.querySelectorAll('.kanban-column');

            columns.forEach(column => {
                const columnId = column.dataset.column;
                const tasks = Array.from(column.querySelectorAll('.task-card')).map(task => ({
                    id: task.dataset.taskId,
                    title: task.querySelector('.task-title').textContent,
                    description: task.querySelector('.task-description').textContent,
                    priority: task.querySelector('.task-priority').textContent,
                    meta: task.querySelector('.task-meta span:last-child').textContent
                }));
                kanbanState[columnId] = tasks;
            });

            localStorage.setItem('kanbanState', JSON.stringify(kanbanState));
        }

        // Workout Functions
        function updateWorkoutStats() {
            document.getElementById('todayWorkouts').textContent = workoutStats.today;
            document.getElementById('weekWorkouts').textContent = workoutStats.week;
            document.getElementById('totalWorkouts').textContent = workoutStats.total;
        }

        function startWorkout(type) {
            const workoutElement = document.getElementById(`${type}Workout`);
            if (workoutElement.style.display === 'none') {
                // Hide all other workouts
                document.querySelectorAll('.workout-routine').forEach(routine => {
                    routine.style.display = 'none';
                });

                // Show selected workout
                workoutElement.style.display = 'block';
                workoutElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });

                const workoutNames = {
                    desk: 'Desk Workout',
                    hiit: 'HIIT Workout',
                    tabata: 'Tabata Training',
                    cardio: 'Short Cardio'
                };

                showNotification(`Started ${workoutNames[type]}! Let's go! 💪`, 'success');
            } else {
                workoutElement.style.display = 'none';
            }
        }

        function completeWorkout(type) {
            const button = event.target;

            if (!button.classList.contains('completed')) {
                // Mark as completed
                button.classList.add('completed');
                button.textContent = 'Completed! ✅';

                // Update stats
                workoutStats.today++;
                workoutStats.week++;
                workoutStats.total++;

                // Save to localStorage
                localStorage.setItem('todayWorkouts', workoutStats.today.toString());
                localStorage.setItem('weekWorkouts', workoutStats.week.toString());
                localStorage.setItem('totalWorkouts', workoutStats.total.toString());

                updateWorkoutStats();

                const workoutNames = {
                    desk: 'Desk Workout',
                    hiit: 'HIIT Workout',
                    tabata: 'Tabata Training',
                    cardio: 'Short Cardio'
                };

                showNotification(`${workoutNames[type]} completed! Great job! 🎉`, 'success');

                // Hide workout after 2 seconds
                setTimeout(() => {
                    document.getElementById(`${type}Workout`).style.display = 'none';
                }, 2000);
            }
        }

        // Notification System
        function showNotification(message, type = 'info') {
            const container = document.getElementById('notificationContainer');
            const notification = document.createElement('div');

            notification.className = `notification ${type}`;
            notification.innerHTML = `
        ${message}
        <button class="notification-close" onclick="closeNotification(this)" aria-label="Close notification">&times;</button>
    `;

            container.appendChild(notification);

            // Auto remove after 4 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    closeNotification(notification.querySelector('.notification-close'));
                }
            }, 4000);

            // Announce to screen readers
            notification.setAttribute('role', 'alert');
            notification.setAttribute('aria-live', 'polite');
        }

        function closeNotification(button) {
            const notification = button.parentNode;
            notification.style.animation = 'slideOutUp 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }

        // Date and Time Functions
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };

            document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);

            // Update greeting based on time
            updateGreeting(now);
        }

        // Mobile Functions
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');

            // Update aria-expanded
            const toggle = document.querySelector('.mobile-menu-toggle');
            const isOpen = sidebar.classList.contains('open');
            toggle.setAttribute('aria-expanded', isOpen);

            if (isOpen) {
                showNotification('Navigation menu opened', 'info');
            } else {
                showNotification('Navigation menu closed', 'info');
            }
        }

        // Welcome Notifications
        function showWelcomeNotifications() {
            setTimeout(() => {
                showNotification('Bienvenue sur notre platerforme! 🎉', 'success');
            }, 1000);
        }

        // Accessibility Enhancements
        function announceToScreenReader(message) {
            const announcement = document.createElement('div');
            announcement.setAttribute('aria-live', 'polite');
            announcement.setAttribute('aria-atomic', 'true');
            announcement.className = 'sr-only';
            announcement.textContent = message;

            document.body.appendChild(announcement);

            setTimeout(() => {
                document.body.removeChild(announcement);
            }, 1000);
        }

        // Focus Management
        function trapFocus(element) {
            const focusableElements = element.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );

            const firstFocusable = focusableElements[0];
            const lastFocusable = focusableElements[focusableElements.length - 1];

            element.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    if (e.shiftKey) {
                        if (document.activeElement === firstFocusable) {
                            lastFocusable.focus();
                            e.preventDefault();
                        }
                    } else {
                        if (document.activeElement === lastFocusable) {
                            firstFocusable.focus();
                            e.preventDefault();
                        }
                    }
                }
            });
        }

        // Initialize focus trapping for theme dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const themeDropdown = document.getElementById('themeDropdown');
            if (themeDropdown) {
                trapFocus(themeDropdown);
            }
        });
    </script>
</body>

</html>
