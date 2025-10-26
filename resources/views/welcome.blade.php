<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Barber Management System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @if (app()->getLocale() == 'ar')
                body {
                    direction: rtl;
                    text-align: right;
                }
            @endif
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-indigo-900">
            <!-- Navigation -->
            <nav class="fixed top-0 w-full bg-white/10 backdrop-blur-md border-b border-white/10 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo -->
                        <div class="flex items-center gap-3">
                            <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-2xl font-bold text-white">
                                @if(app()->getLocale() == 'ar')
                                    نظام إدارة الحلاقة
                                @else
                                    Barber Management System
                                @endif
                            </span>
                        </div>

                        <!-- Auth Links -->
                        @if (Route::has('login'))
                            <div class="flex items-center gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50">
                                        @if(app()->getLocale() == 'ar')
                                            لوحة التحكم
                                        @else
                                            Dashboard
                                        @endif
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="px-6 py-2 text-white hover:text-indigo-300 transition-colors duration-300">
                                        @if(app()->getLocale() == 'ar')
                                            تسجيل الدخول
                                        @else
                                            Log in
                                        @endif
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all duration-300 shadow-lg hover:shadow-indigo-500/50">
                                            @if(app()->getLocale() == 'ar')
                                                إنشاء حساب
                                            @else
                                                Register
                                            @endif
                                        </a>
                                    @endif
                                @endauth

                                <!-- Language Switcher -->
                                <a href="{{ url('/locale/' . (app()->getLocale() == 'ar' ? 'en' : 'ar')) }}" class="px-4 py-2 bg-white/10 text-white rounded-lg hover:bg-white/20 transition-all duration-300">
                                    {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center">
                        <!-- Hero Icon -->
                        <div class="flex justify-center mb-8">
                            <div class="p-6 bg-indigo-600/20 rounded-full backdrop-blur-sm border border-indigo-500/30">
                                <svg class="w-20 h-20 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>

                        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                            @if(app()->getLocale() == 'ar')
                                نظام إدارة الحلاقة المتكامل
                            @else
                                Complete Barber Management System
                            @endif
                        </h1>
                        <p class="text-xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                            @if(app()->getLocale() == 'ar')
                                نظام شامل لإدارة صالونات الحلاقة، تتبع الخدمات، حساب الإيرادات، وإدارة الحلاقين بسهولة واحترافية
                            @else
                                A comprehensive system to manage barbershops, track services, calculate revenue, and manage barbers with ease and professionalism
                            @endif
                        </p>
                        <div class="flex flex-wrap justify-center gap-4">
                            @guest
                                <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white text-lg font-semibold rounded-lg hover:bg-indigo-700 transition-all duration-300 shadow-xl hover:shadow-indigo-500/50 transform hover:scale-105">
                                    @if(app()->getLocale() == 'ar')
                                        ابدأ الآن مجاناً
                                    @else
                                        Get Started Free
                                    @endif
                                </a>
                                <a href="{{ route('login') }}" class="px-8 py-4 bg-white/10 backdrop-blur-sm text-white text-lg font-semibold rounded-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                                    @if(app()->getLocale() == 'ar')
                                        تسجيل الدخول
                                    @else
                                        Sign In
                                    @endif
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-indigo-600 text-white text-lg font-semibold rounded-lg hover:bg-indigo-700 transition-all duration-300 shadow-xl hover:shadow-indigo-500/50 transform hover:scale-105">
                                    @if(app()->getLocale() == 'ar')
                                        الذهاب إلى لوحة التحكم
                                    @else
                                        Go to Dashboard
                                    @endif
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-20 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <h2 class="text-4xl font-bold text-white text-center mb-16">
                        @if(app()->getLocale() == 'ar')
                            المميزات الرئيسية
                        @else
                            Key Features
                        @endif
                    </h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            <div class="w-14 h-14 bg-indigo-600/30 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                @if(app()->getLocale() == 'ar')
                                    إدارة الحلاقين
                                @else
                                    Barber Management
                                @endif
                            </h3>
                            <p class="text-gray-300">
                                @if(app()->getLocale() == 'ar')
                                    إضافة وإدارة ملفات الحلاقين مع معلومات الاتصال الكاملة
                                @else
                                    Add and manage barber profiles with complete contact information
                                @endif
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            <div class="w-14 h-14 bg-indigo-600/30 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                @if(app()->getLocale() == 'ar')
                                    الخدمات والخصومات
                                @else
                                    Services & Discounts
                                @endif
                            </h3>
                            <p class="text-gray-300">
                                @if(app()->getLocale() == 'ar')
                                    إدارة الخدمات مع أسعار مرنة وخصومات ثابتة أو نسبية
                                @else
                                    Manage services with flexible pricing and fixed or percentage discounts
                                @endif
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            <div class="w-14 h-14 bg-indigo-600/30 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                @if(app()->getLocale() == 'ar')
                                    تقارير الإيرادات
                                @else
                                    Revenue Reports
                                @endif
                            </h3>
                            <p class="text-gray-300">
                                @if(app()->getLocale() == 'ar')
                                    حساب الإيرادات والمكافآت تلقائياً مع تقارير مفصلة
                                @else
                                    Calculate revenue and bonuses automatically with detailed reports
                                @endif
                            </p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            <div class="w-14 h-14 bg-indigo-600/30 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                @if(app()->getLocale() == 'ar')
                                    سجلات الخدمات
                                @else
                                    Service Records
                                @endif
                            </h3>
                            <p class="text-gray-300">
                                @if(app()->getLocale() == 'ar')
                                    تتبع جميع المعاملات اليومية مع ملاحظات وتفاصيل كاملة
                                @else
                                    Track all daily transactions with notes and complete details
                                @endif
                            </p>
                        </div>

                        <!-- Feature 5 -->
                        <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            <div class="w-14 h-14 bg-indigo-600/30 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                @if(app()->getLocale() == 'ar')
                                    سجلات النشاط
                                @else
                                    Activity Logs
                                @endif
                            </h3>
                            <p class="text-gray-300">
                                @if(app()->getLocale() == 'ar')
                                    تتبع كامل لجميع التعديلات والتغييرات في النظام
                                @else
                                    Complete tracking of all modifications and changes in the system
                                @endif
                            </p>
                        </div>

                        <!-- Feature 6 -->
                        <div class="bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-8 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                            <div class="w-14 h-14 bg-indigo-600/30 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-3">
                                @if(app()->getLocale() == 'ar')
                                    دعم ثنائي اللغة
                                @else
                                    Bilingual Support
                                @endif
                            </h3>
                            <p class="text-gray-300">
                                @if(app()->getLocale() == 'ar')
                                    واجهة كاملة باللغتين العربية والإنجليزية مع دعم RTL
                                @else
                                    Complete interface in Arabic and English with RTL support
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="py-12 px-4 sm:px-6 lg:px-8 border-t border-white/10">
                <div class="max-w-7xl mx-auto text-center">
                    <p class="text-gray-400">
                        @if(app()->getLocale() == 'ar')
                            &copy; {{ date('Y') }} نظام إدارة الحلاقة. جميع الحقوق محفوظة.
                        @else
                            &copy; {{ date('Y') }} Barber Management System. All rights reserved.
                        @endif
                    </p>
                    <p class="text-gray-500 mt-2 text-sm">
                        @if(app()->getLocale() == 'ar')
                            مبني بواسطة Laravel {{ Illuminate\Foundation\Application::VERSION }}
                        @else
                            Built with Laravel {{ Illuminate\Foundation\Application::VERSION }}
                        @endif
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
