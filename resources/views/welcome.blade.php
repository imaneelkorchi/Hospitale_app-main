<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zenith Health Center - Premium Medical Care</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-gradient {
            background: linear-gradient(135deg, rgba(6, 78, 59, 0.9) 0%, rgba(13, 148, 136, 0.8) 100%);
        }
        .text-glow {
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="antialiased font-sans bg-slate-50">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-medical-primary flex items-center justify-center text-white shadow-lg">
                    <i data-lucide="plus-circle" class="w-6 h-6"></i>
                </div>
                <span class="text-2xl font-bold tracking-tight text-medical-primary">Zenith<span class="text-medical-secondary">Health</span></span>
            </div>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="#services" class="text-sm font-medium text-slate-600 hover:text-medical-primary transition-colors">Services</a>
                <a href="#about" class="text-sm font-medium text-slate-600 hover:text-medical-primary transition-colors">About Us</a>
                <a href="#contact" class="text-sm font-medium text-slate-600 hover:text-medical-primary transition-colors">Contact</a>
                
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-slate-200">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-full bg-medical-primary text-white text-sm font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-medical-primary transition-colors">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full bg-medical-primary text-white text-sm font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

            <button class="md:hidden p-2 text-slate-600">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero.png') }}" alt="Hospital" class="w-full h-full object-cover">
            <div class="absolute inset-0 hero-gradient"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-in fade-in slide-in-from-left-8 duration-1000">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2 animate-pulse"></span>
                    Excellence in Healthcare
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight mb-6 tracking-tight text-glow">
                    Your Health,<br><span class="text-emerald-300">Our Priority</span>
                </h1>
                <p class="text-xl text-emerald-50/80 mb-10 max-w-lg leading-relaxed">
                    Experience world-class medical services with a touch of personal care. Zenith Health Center brings together top specialists and cutting-edge technology.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 rounded-2xl bg-white text-medical-primary font-bold text-lg hover:bg-emerald-50 transition-all shadow-2xl flex items-center justify-center">
                        Book an Appointment
                        <i data-lucide="calendar" class="ml-2 w-5 h-5"></i>
                    </a>
                    <a href="#services" class="px-8 py-4 rounded-2xl bg-transparent border-2 border-white/30 text-white font-bold text-lg hover:bg-white/10 transition-all backdrop-blur-sm flex items-center justify-center">
                        Explore Services
                    </a>
                </div>
                
                <div class="mt-12 flex items-center space-x-6">
                    <div class="flex -space-x-4">
                        <div class="w-12 h-12 rounded-full border-4 border-emerald-900 bg-slate-200 overflow-hidden">
                            <img src="https://i.pravatar.cc/150?u=1" alt="Doctor">
                        </div>
                        <div class="w-12 h-12 rounded-full border-4 border-emerald-900 bg-slate-200 overflow-hidden">
                            <img src="https://i.pravatar.cc/150?u=2" alt="Doctor">
                        </div>
                        <div class="w-12 h-12 rounded-full border-4 border-emerald-900 bg-slate-200 overflow-hidden">
                            <img src="https://i.pravatar.cc/150?u=3" alt="Doctor">
                        </div>
                    </div>
                    <p class="text-emerald-100 text-sm">
                        <span class="font-bold text-white">50+ Specialists</span> available for consultation
                    </p>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-50 to-transparent"></div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-slate-50 relative -mt-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-premium border border-slate-100 text-center animate-in zoom-in duration-700">
                    <div class="text-4xl font-bold text-medical-primary mb-2">15k+</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-widest">Patients Yearly</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-premium border border-slate-100 text-center animate-in zoom-in duration-700 delay-100">
                    <div class="text-4xl font-bold text-medical-primary mb-2">50+</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-widest">Medical Staff</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-premium border border-slate-100 text-center animate-in zoom-in duration-700 delay-200">
                    <div class="text-4xl font-bold text-medical-primary mb-2">12+</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-widest">Departments</div>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-premium border border-slate-100 text-center animate-in zoom-in duration-700 delay-300">
                    <div class="text-4xl font-bold text-medical-primary mb-2">99%</div>
                    <div class="text-sm font-bold text-slate-500 uppercase tracking-widest">Success Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-xs font-bold text-medical-secondary uppercase tracking-widest mb-4">Our Specializations</h2>
                <h3 class="text-4xl font-bold text-slate-900 mb-6">Comprehensive Healthcare Solutions</h3>
                <p class="text-lg text-slate-600 leading-relaxed">
                    We offer a wide range of medical services designed to meet all your healthcare needs, from emergency care to specialized surgeries.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card -->
                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-medical-primary flex items-center justify-center mb-6 group-hover:bg-medical-primary group-hover:text-white transition-colors">
                        <i data-lucide="stethoscope" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Diagnostics</h4>
                    <p class="text-slate-600 leading-relaxed">Advanced imaging and laboratory tests for accurate diagnosis of various medical conditions.</p>
                </div>

                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-lucide="activity" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Cardiology</h4>
                    <p class="text-slate-600 leading-relaxed">Expert heart care including screening, diagnosis, and treatment of complex cardiovascular issues.</p>
                </div>

                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-lucide="baby" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Pediatrics</h4>
                    <p class="text-slate-600 leading-relaxed">Dedicated child healthcare from birth through adolescence, ensuring healthy development.</p>
                </div>

                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i data-lucide="heart-pulse" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Emergency Care</h4>
                    <p class="text-slate-600 leading-relaxed">24/7 rapid response for critical medical emergencies with state-of-the-art facilities.</p>
                </div>

                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <i data-lucide="smile" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Dental Care</h4>
                    <p class="text-slate-600 leading-relaxed">Comprehensive oral health services from routine cleaning to advanced restorative procedures.</p>
                </div>

                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <i data-lucide="eye" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Ophthalmology</h4>
                    <p class="text-slate-600 leading-relaxed">Specialized eye care and vision correction surgeries using the latest laser technology.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-slate-50 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-medical-primary rounded-[3rem] p-12 lg:p-20 relative overflow-hidden flex flex-col lg:flex-row items-center justify-between shadow-2xl">
                <!-- Background Decoration -->
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-medical-secondary/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 max-w-xl text-center lg:text-left mb-10 lg:mb-0">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">Ready to prioritize your health?</h2>
                    <p class="text-lg text-emerald-100 leading-relaxed">
                        Join thousands of patients who trust Zenith Health Center for their medical needs. Secure portal access for all your records.
                    </p>
                </div>
                
                <div class="relative z-10 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="px-10 py-5 rounded-2xl bg-white text-medical-primary font-bold text-lg hover:bg-emerald-50 transition-all shadow-xl">Create Account</a>
                    <a href="{{ route('login') }}" class="px-10 py-5 rounded-2xl bg-emerald-900 text-white font-bold text-lg hover:bg-emerald-950 transition-all">Sign In</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white pt-24 pb-12 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-medical-primary flex items-center justify-center text-white shadow-lg">
                            <i data-lucide="plus-circle" class="w-6 h-6"></i>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-medical-primary">Zenith<span class="text-medical-secondary">Health</span></span>
                    </div>
                    <p class="text-slate-500 leading-relaxed mb-8">
                        Providing premium healthcare services with compassion and excellence. Your trusted partner in health.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-medical-primary hover:text-white transition-all"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-medical-primary hover:text-white transition-all"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-medical-primary hover:text-white transition-all"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                    </div>
                </div>

                <div>
                    <h5 class="text-slate-900 font-bold mb-8">Quick Links</h5>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 hover:text-medical-primary transition-colors">Home</a></li>
                        <li><a href="#services" class="text-slate-500 hover:text-medical-primary transition-colors">Services</a></li>
                        <li><a href="#about" class="text-slate-500 hover:text-medical-primary transition-colors">About Us</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-medical-primary transition-colors">Our Doctors</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-slate-900 font-bold mb-8">Resources</h5>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-500 hover:text-medical-primary transition-colors">Patient Portal</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-medical-primary transition-colors">Health Tips</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-medical-primary transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-500 hover:text-medical-primary transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-slate-900 font-bold mb-8">Contact Info</h5>
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <i data-lucide="map-pin" class="w-5 h-5 text-medical-primary mr-3 mt-1"></i>
                            <span class="text-slate-500">123 Health Ave, Medical District, NY 10001</span>
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="phone" class="w-5 h-5 text-medical-primary mr-3"></i>
                            <span class="text-slate-500">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="mail" class="w-5 h-5 text-medical-primary mr-3"></i>
                            <span class="text-slate-500">contact@zenithhealth.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-12 border-t border-slate-100 text-center">
                <p class="text-slate-400 text-sm">
                    &copy; {{ date('Y') }} Zenith Health Center. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
