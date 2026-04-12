<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt bàn - Golden Spoons</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-menu {
            transition: all 0.3s ease;
        }

        .sidebar-menu:hover {
            background-color: rgba(139, 92, 246, 0.1);
            border-left: 3px solid rgb(139, 92, 246);
            padding-left: calc(1.5rem - 3px);
        }

        .table-feature {
            transition: all 0.3s ease;
        }

        .table-feature:hover {
            transform: translateY(-4px);
        }

        .time-slot {
            transition: all 0.2s ease;
        }

        .time-slot:hover {
            background-color: rgb(139, 92, 246);
            color: white;
        }

        .time-slot.active {
            background-color: rgb(139, 92, 246);
            color: white;
        }

        .date-btn {
            transition: all 0.2s ease;
        }

        .date-btn:hover {
            background-color: rgb(139, 92, 246);
            color: white;
        }

        .date-btn.active {
            background-color: rgb(139, 92, 246);
            color: white;
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100">
    <nav class="fixed top-0 left-0 right-0 h-16 bg-slate-900/95 backdrop-blur-md z-40 border-b border-slate-800 flex items-center px-6">
        <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
            <a href="{{ route('customer.dashboard') }}" class="text-2xl font-bold text-white hover:text-violet-400 transition">
                Golden Spoons
            </a>
            <div class="flex items-center gap-8">
                <a href="#" class="text-slate-300 hover:text-white transition font-medium">Explore</a>
                <a href="{{ route('customer.bookings') }}" class="text-slate-300 hover:text-white transition font-medium">Reservations</a>
                <a href="#" class="text-slate-300 hover:text-white transition font-medium">Favorites</a>
                <div class="relative group">
                    <button class="p-2">
                        <svg class="w-6 h-6 text-slate-400 hover:text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-slate-800 rounded-lg shadow-lg hidden group-hover:block z-50 border border-slate-700">
                        <a href="{{ route('customer.profile') }}" class="block px-4 py-2 hover:bg-slate-700 rounded-t-lg text-sm">Tài khoản</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-slate-700 rounded-b-lg text-red-400 text-sm">Đăng xuất</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16 min-h-screen gap-0">
        <aside class="w-40 bg-slate-900 border-r border-slate-800 p-6 fixed left-0 top-16 bottom-0 overflow-y-auto">
            <div class="mb-12">
                <h3 class="text-sm font-bold text-violet-400 tracking-wider mb-4">MAITRED'</h3>
                <p class="text-xs text-slate-500">HIGH-TECH HOSPITALITY</p>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('customer.dashboard') }}" class="sidebar-menu flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h2v8H3zm4-8h2v16H7zm4-2h2v18h-2zm4-2h2v20h-2zm4 4h2v16h-2z"></path>
                    </svg>
                    <span class="text-sm">DASHBOARD</span>
                </a>
                <button href="#" class="sidebar-menu w-full flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
                    </svg>
                    <span class="text-sm">TABLE MAP</span>
                </button>
                <a href="{{ route('customer.bookings') }}" class="sidebar-menu flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5-10H7v2h7V9zm6 0h-2v2h2V9zM9 5H7v2h2V5zm6 0h-2v2h2V5z"></path>
                    </svg>
                    <span class="text-sm">BOOKINGS</span>
                </a>
                <a href="#" class="sidebar-menu flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2V17zm4 0h-2V7h2V17zm4 0h-2v-4h2V17z"></path>
                    </svg>
                    <span class="text-sm">ANALYTICS</span>
                </a>
                <a href="#" class="sidebar-menu flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white rounded-lg transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                    </svg>
                    <span class="text-sm">STAFF</span>
                </a>
            </nav>

            <div class="mt-12 pt-6 border-t border-slate-700">
                <button class="w-full px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white rounded-lg transition font-medium text-sm">
                    QUICK BOOK
                </button>
            </div>

            <div class="mt-auto pt-6">
                <p class="text-xs text-slate-500">Help</p>
            </div>
        </aside>

        <main class="ml-40 flex-1 p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div>
                        <div class="inline-block mb-4 px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded text-xs font-semibold uppercase">
                            ✕ LIVE AVAILABILITY / Table Selection / {{ $table?->location ?? 'Grand Hall' }}
                        </div>
                        <h1 class="text-4xl font-bold mb-2">Reserve Your Experience</h1>
                    </div>

                    <div class="bg-slate-800 rounded-2xl overflow-hidden border border-slate-700">
                        <div class="relative h-96 bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center overflow-hidden">
                            <svg class="absolute w-full h-full opacity-20" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <defs>
                                    <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                                        <path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgb(139, 92, 246)" stroke-width="0.5" />
                                    </pattern>
                                </defs>
                                <rect width="100" height="100" fill="url(#grid)" />
                            </svg>

                            <div class="relative text-center">
                                <div class="inline-block">
                                    <svg class="w-32 h-32 text-violet-500 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="8" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 bg-slate-800">
                            <h2 class="text-2xl font-bold mb-2">{{ $table?->name ?? 'The Obsidian Alcove' }}</h2>
                            <p class="text-slate-400 text-sm mb-6">{{ $table?->location ?? 'North-West Wing' }}, Table {{ $table?->id ?? '12' }}</p>

                            <div class="flex items-center gap-4 mb-6 text-sm">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                                    </svg>
                                    <span>{{ $table?->capacity ?? '4' }} - {{ ($table?->capacity ?? 4) + 2 }} PERSONS</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path>
                                    </svg>
                                    <span>OPENS AT 21:00</span>
                                </div>
                            </div>

                            <p class="text-slate-300 text-sm leading-relaxed mb-6">
                                @if($table)
                                Experience your evening at {{ $table->name }}. This perfect setting offers an intimate ambiance combined with cutting-edge amenities for the ultimate dining pleasure.
                                @else
                                Experience your evening in one of our most sophisticated settings. The Obsidian Alcove offers an intimate ambiance combined with cutting-edge amenities for the ultimate dining pleasure.
                                @endif
                            </p>

                            <div class="grid grid-cols-3 gap-4">
                                <div class="table-feature bg-slate-700/50 border border-slate-600 rounded-lg p-4 text-center hover:border-violet-500 hover:bg-slate-700">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="text-xs font-semibold">Climate Control</p>
                                    <p class="text-xs text-slate-500 mt-1">Personalized settings</p>
                                </div>
                                <div class="table-feature bg-slate-700/50 border border-slate-600 rounded-lg p-4 text-center hover:border-violet-500 hover:bg-slate-700">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 15.464a5 5 0 010-7.072m2.828 2.828a7 7 0 010 9.9M5 12a7 7 0 009.9 0m-2.828-2.828a5 5 0 010 7.072M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <p class="text-xs font-semibold">Acoustic Shield</p>
                                    <p class="text-xs text-slate-500 mt-1">Privacy noise cancellation</p>
                                </div>
                                <div class="table-feature bg-slate-700/50 border border-slate-600 rounded-lg p-4 text-center hover:border-violet-500 hover:bg-slate-700">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-xs font-semibold">Sommelier Table</p>
                                    <p class="text-xs text-slate-500 mt-1">Built-in wine services</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800 rounded-2xl p-8 border border-slate-700">
                        <h3 class="text-lg font-bold mb-6">Guest Information</h3>

                        <div class="space-y-4 mb-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-2">FULL NAME</label>
                                    <input type="text" placeholder="Alexander Starling" class="w-full px-3 py-2 bg-slate-900 border border-slate-600 rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-violet-500" value="{{ auth()->user()->name ?? '' }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-2">CONTACT SIGNAL</label>
                                    <input type="email" placeholder="alex@sterling.corp" class="w-full px-3 py-2 bg-slate-900 border border-slate-600 rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-violet-500" value="{{ auth()->user()->email ?? '' }}">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2">DIETARY LOGIC / SPECIAL REQUESTS</label>
                                <textarea placeholder="Molecular gastronomy allergies, preferences for exclusive sourcing" class="w-full px-3 py-2 bg-slate-900 border border-slate-600 rounded-lg text-slate-100 placeholder-slate-500 focus:outline-none focus:border-violet-500 h-24 resize-none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-slate-800 rounded-2xl p-6 border border-slate-700 sticky top-24">
                        <h3 class="text-lg font-bold mb-6">Scheduling</h3>

                        <form action="{{ route('customer.dashboard') }}" method="GET" class="space-y-6">
                            @csrf

                            @if($table)
                            <input type="hidden" name="table_id" value="{{ $table->id }}">
                            @endif

                            <div class="mb-6">
                                <label class="block text-xs font-semibold text-slate-300 mb-3">SELECT PHASE (DATE)</label>
                                <div class="grid grid-cols-5 gap-2">
                                    <button type="button" class="date-btn active bg-violet-600 text-white text-center py-2 rounded text-xs font-semibold" data-date="2025-04-14">
                                        MON<br>14
                                    </button>
                                    <button type="button" class="date-btn bg-slate-700 text-slate-400 hover:text-white text-center py-2 rounded text-xs font-semibold" data-date="2025-04-15">
                                        TUE<br>15
                                    </button>
                                    <button type="button" class="date-btn bg-slate-700 text-slate-400 hover:text-white text-center py-2 rounded text-xs font-semibold" data-date="2025-04-16">
                                        WED<br>16
                                    </button>
                                    <button type="button" class="date-btn bg-slate-700 text-slate-400 hover:text-white text-center py-2 rounded text-xs font-semibold" data-date="2025-04-17">
                                        THU<br>17
                                    </button>
                                    <button type="button" class="date-btn bg-slate-700 text-slate-400 hover:text-white text-center py-2 rounded text-xs font-semibold" data-date="2025-04-18">
                                        FRI<br>18
                                    </button>
                                </div>
                                <input type="hidden" name="booking_date" id="booking_date" value="2025-04-14">
                            </div>

                            <div class="mb-6">
                                <label class="block text-xs font-semibold text-slate-300 mb-3">ARRIVAL SEQUENCE (TIME)</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <button type="button" class="time-slot active bg-violet-600 text-white py-2 rounded text-xs font-semibold" data-time="19:00">19:00</button>
                                    <button type="button" class="time-slot bg-slate-700 text-slate-400 py-2 rounded text-xs font-semibold" data-time="19:30">19:30</button>
                                    <button type="button" class="time-slot bg-violet-600 text-white py-2 rounded text-xs font-semibold" data-time="20:00">20:00</button>
                                    <button type="button" class="time-slot bg-slate-700 text-slate-400 py-2 rounded text-xs font-semibold" data-time="20:30">20:30</button>
                                    <button type="button" class="time-slot bg-slate-700 text-slate-400 py-2 rounded text-xs font-semibold" data-time="21:00">21:00</button>
                                    <button type="button" class="time-slot bg-slate-700 text-slate-400 py-2 rounded text-xs font-semibold opacity-50 cursor-not-allowed" disabled>--:--</button>
                                </div>
                                <input type="hidden" name="booking_time" id="booking_time" value="19:00">
                            </div>

                            <div class="bg-slate-900 rounded-lg p-4 mb-6 space-y-2 border border-slate-600">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-400">Experience Deposit</span>
                                    <span class="text-white font-semibold">$48.50</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-400">Table Service Fee</span>
                                    <span class="text-white font-semibold">$12.50</span>
                                </div>
                                <div class="border-t border-slate-700 pt-2 mt-2 flex justify-between">
                                    <span class="text-sm font-semibold text-slate-300">TOTAL EST.</span>
                                    <span class="text-lg font-bold text-violet-400">$52.50</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-700 hover:to-purple-700 text-white font-bold py-3 rounded-lg transition transform hover:scale-105 mb-4 text-sm">
                                CONFIRM BOOKING
                            </button>

                            <p class="text-xs text-slate-500 text-center">
                                Secured by Gold Summit Encryption. Cancellation within 24h.
                            </p>
                        </form>
                    </div>

                    <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-emerald-400">Reservation Synchronized</p>
                                <p class="text-xs text-slate-400 mt-1">Table 12 successfully held for 15 minutes.</p>
                            </div>
                            <button class="text-slate-500 hover:text-slate-300 ml-auto">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="bg-purple-500/10 border border-purple-500/30 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-purple-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-purple-400">Elite Status Recognized</p>
                                <p class="text-xs text-slate-400 mt-1">Complimentary amontillado vintage unlocked</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.date-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.date-btn').forEach(b => {
                    b.classList.remove('active', 'bg-violet-600', 'text-white');
                    b.classList.add('bg-slate-700', 'text-slate-400');
                });
                this.classList.add('active', 'bg-violet-600', 'text-white');
                this.classList.remove('bg-slate-700', 'text-slate-400');
                document.getElementById('booking_date').value = this.getAttribute('data-date');
            });
        });

        document.querySelectorAll('.time-slot:not([disabled])').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.time-slot:not([disabled])').forEach(b => {
                    b.classList.remove('active', 'bg-violet-600', 'text-white');
                    b.classList.add('bg-slate-700', 'text-slate-400');
                });
                this.classList.add('active', 'bg-violet-600', 'text-white');
                this.classList.remove('bg-slate-700', 'text-slate-400');
                document.getElementById('booking_time').value = this.getAttribute('data-time');
            });
        });
    </script>

</body>

</html>