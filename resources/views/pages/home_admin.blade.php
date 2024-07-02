@extends('layouts.main')
@section('titulo', 'Comunidad religiosa - Home')

@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <!-- start main content section -->
        <div x-data="analytics">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
                </li>
                <li class="before:mr-1 before:content-['/'] rtl:before:ml-1">
                    <span>Home</span>
                </li>
            </ul>
            <div class="pt-5">
                <div class="mb-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    <div class="panel grid h-full grid-cols-1 content-between overflow-hidden before:absolute before:-right-44 before:top-0 before:bottom-0 before:m-auto before:h-96 before:w-96 before:rounded-full before:bg-[#1937cc]"
                        style="background: linear-gradient(0deg, #7e8d91 -227%, #54B551) !important">
                        <div class="z-[7] mb-16 flex items-start justify-between text-white-light">
                            <h5 class="text-lg font-semibold">Ventas</h5>

                            <div class="relative whitespace-nowrap text-xl">
                                ${{ $ventas }}
                            </div>
                        </div>

                    </div>

                    <div class="panel grid h-full grid-cols-1 content-between overflow-hidden before:absolute before:-right-44 before:top-0 before:bottom-0 before:m-auto before:h-96 before:w-96 before:rounded-full before:bg-[#1937cc]"
                        style="background: linear-gradient(0deg, #00c6fb -227%, #3575AD) !important">
                        <div class="z-[7] mb-16 flex items-start justify-between text-white-light">
                            <h5 class="text-lg font-semibold">Pendientes</h5>

                            <div class="relative whitespace-nowrap text-xl">
                                ${{ $pendientes }}
                            </div>
                        </div>

                    </div>

                    <div class="panel grid h-full grid-cols-1 content-between overflow-hidden before:absolute before:-right-44 before:top-0 before:bottom-0 before:m-auto before:h-96 before:w-96 before:rounded-full before:bg-[#1937cc]"
                        style="background: linear-gradient(0deg, #00c6fb -227%, #005bea) !important">
                        <div class="z-[7] mb-16 flex items-start justify-between text-white-light">
                            <h5 class="text-lg font-semibold">Comunidades <br> totales</h5>

                            <div class="relative whitespace-nowrap text-xl">
                                {{ $acopios }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- end main content section -->

    </div>
@endsection

@section('scripts')
    <script src="{{ url('assets/js/alpine-collaspe.min.js') }}"></script>
    <script src="{{ url('assets/js/alpine-persist.min.js') }}"></script>
    <script defer src="{{ url('assets/js/alpine-ui.min.js') }}"></script>
    <script defer src="{{ url('assets/js/alpine-focus.min.js') }}"></script>
    <script defer src="{{ url('assets/js/alpine.min.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>
    <script defer src="{{ url('assets/js/apexcharts.js') }}"></script>

    <script>
        // main section
        document.addEventListener('alpine:init', () => {
            Alpine.data('scrollToTop', () => ({
                showTopButton: false,
                init() {
                    window.onscroll = () => {
                        this.scrollFunction();
                    };
                },

                scrollFunction() {
                    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                        this.showTopButton = true;
                    } else {
                        this.showTopButton = false;
                    }
                },

                goToTop() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                },
            }));

            // theme customization
            Alpine.data('customizer', () => ({
                showCustomizer: false,
            }));

            // sidebar section
            Alpine.data('sidebar', () => ({
                init() {
                    const selector = document.querySelector('.sidebar ul a[href="' + window.location
                        .pathname + '"]');
                    if (selector) {
                        selector.classList.add('active');
                        const ul = selector.closest('ul.sub-menu');
                        if (ul) {
                            let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                            if (ele) {
                                ele = ele[0];
                                setTimeout(() => {
                                    ele.click();
                                });
                            }
                        }
                    }
                },
            }));

            // header section
            Alpine.data('header', () => ({
                init() {
                    const selector = document.querySelector('ul.horizontal-menu a[href="' + window
                        .location.pathname + '"]');
                    if (selector) {
                        selector.classList.add('active');
                        const ul = selector.closest('ul.sub-menu');
                        if (ul) {
                            let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                            if (ele) {
                                ele = ele[0];
                                setTimeout(() => {
                                    ele.classList.add('active');
                                });
                            }
                        }
                    }
                },

                notifications: [{
                        id: 1,
                        profile: 'user-profile.jpeg',
                        message: '<strong class="text-sm mr-1">John Doe</strong>invite you to <strong>Prototyping</strong>',
                        time: '45 min ago',
                    },
                    {
                        id: 2,
                        profile: 'profile-34.jpeg',
                        message: '<strong class="text-sm mr-1">Adam Nolan</strong>mentioned you to <strong>UX Basics</strong>',
                        time: '9h Ago',
                    },
                    {
                        id: 3,
                        profile: 'profile-16.jpeg',
                        message: '<strong class="text-sm mr-1">Anna Morgan</strong>Upload a file',
                        time: '9h Ago',
                    },
                ],

                messages: [{
                        id: 1,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-success-light dark:bg-success text-success dark:text-success-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></span>',
                        title: 'Congratulations!',
                        message: 'Your OS has been updated.',
                        time: '1hr',
                    },
                    {
                        id: 2,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-info-light dark:bg-info text-info dark:text-info-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></span>',
                        title: 'Did you know?',
                        message: 'You can switch between artboards.',
                        time: '2hr',
                    },
                    {
                        id: 3,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-danger-light dark:bg-danger text-danger dark:text-danger-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>',
                        title: 'Something went wrong!',
                        message: 'Send Reposrt',
                        time: '2days',
                    },
                    {
                        id: 4,
                        image: '<span class="grid place-content-center w-9 h-9 rounded-full bg-warning-light dark:bg-warning text-warning dark:text-warning-light"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">    <circle cx="12" cy="12" r="10"></circle>    <line x1="12" y1="8" x2="12" y2="12"></line>    <line x1="12" y1="16" x2="12.01" y2="16"></line></svg></span>',
                        title: 'Warning',
                        message: 'Your password strength is low.',
                        time: '5days',
                    },
                ],

                languages: [{
                        id: 1,
                        key: 'Chinese',
                        value: 'zh',
                    },
                    {
                        id: 2,
                        key: 'Danish',
                        value: 'da',
                    },
                    {
                        id: 3,
                        key: 'English',
                        value: 'en',
                    },
                    {
                        id: 4,
                        key: 'French',
                        value: 'fr',
                    },
                    {
                        id: 5,
                        key: 'German',
                        value: 'de',
                    },
                    {
                        id: 6,
                        key: 'Greek',
                        value: 'el',
                    },
                    {
                        id: 7,
                        key: 'Hungarian',
                        value: 'hu',
                    },
                    {
                        id: 8,
                        key: 'Italian',
                        value: 'it',
                    },
                    {
                        id: 9,
                        key: 'Japanese',
                        value: 'ja',
                    },
                    {
                        id: 10,
                        key: 'Polish',
                        value: 'pl',
                    },
                    {
                        id: 11,
                        key: 'Portuguese',
                        value: 'pt',
                    },
                    {
                        id: 12,
                        key: 'Russian',
                        value: 'ru',
                    },
                    {
                        id: 13,
                        key: 'Spanish',
                        value: 'es',
                    },
                    {
                        id: 14,
                        key: 'Swedish',
                        value: 'sv',
                    },
                    {
                        id: 15,
                        key: 'Turkish',
                        value: 'tr',
                    },
                ],

                removeNotification(value) {
                    this.notifications = this.notifications.filter((d) => d.id !== value);
                },

                removeMessage(value) {
                    this.messages = this.messages.filter((d) => d.id !== value);
                },
            }));

            // content section
            // total-visit
            Alpine.data('analytics', () => ({
                init() {
                    isDark = this.$store.app.theme === 'dark' ? true : false;
                    isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;

                    const totalVisit = null;
                    const paidVisit = null;
                    const uniqueVisitorSeries = null;
                    const followers = null;
                    const referral = null;
                    const engagement = null;

                    // statistics
                    setTimeout(() => {
                        this.totalVisit = new ApexCharts(this.$refs.totalVisit, this
                            .totalVisitOptions);
                        this.totalVisit.render();

                        this.paidVisit = new ApexCharts(this.$refs.paidVisit, this
                            .paidVisitOptions);
                        this.paidVisit.render();

                        // followers
                        this.followers = new ApexCharts(this.$refs.followers, this
                            .followersOptions);
                        this.followers.render();

                        // referral
                        this.referral = new ApexCharts(this.$refs.referral, this
                            .referralOptions);
                        this.referral.render();

                        // engagement
                        this.engagement = new ApexCharts(this.$refs.engagement, this
                            .engagementOptions);
                        this.engagement.render();
                    }, 300);

                    this.$watch('$store.app.theme', () => {
                        isDark = this.$store.app.theme === 'dark' ? true : false;
                        this.totalVisit.updateOptions(this.totalVisitOptions);
                        this.paidVisit.updateOptions(this.paidVisitOptions);
                        this.uniqueVisitorSeries.updateOptions(this.uniqueVisitorSeriesOptions);
                        this.followers.updateOptions(this.followersOptions);
                        this.referral.updateOptions(this.referralOptions);
                        this.engagement.updateOptions(this.engagementOptions);
                    });

                    this.$watch('$store.app.rtlClass', () => {
                        isRtl = this.$store.app.rtlClass === 'rtl' ? true : false;
                        this.uniqueVisitorSeries.updateOptions(this.uniqueVisitorSeriesOptions);
                    });
                },

                // statistics
                get totalVisitOptions() {
                    return {
                        series: [{
                            data: [21, 9, 36, 12, 44, 25, 59, 41, 66, 25],
                        }, ],
                        chart: {
                            height: 58,
                            type: 'line',
                            fontFamily: 'Nunito, sans-serif',
                            sparkline: {
                                enabled: true,
                            },
                            dropShadow: {
                                enabled: true,
                                blur: 3,
                                color: '#009688',
                                opacity: 0.4,
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        colors: ['#009688'],
                        grid: {
                            padding: {
                                top: 5,
                                bottom: 5,
                                left: 5,
                                right: 5,
                            },
                        },
                        tooltip: {
                            x: {
                                show: false,
                            },
                            y: {
                                title: {
                                    formatter: (formatter = () => {
                                        return '';
                                    }),
                                },
                            },
                        },
                    };
                },

                //paid visit
                get paidVisitOptions() {
                    return {
                        series: [{
                            data: [22, 19, 30, 47, 32, 44, 34, 55, 41, 69],
                        }, ],
                        chart: {
                            height: 58,
                            type: 'line',
                            fontFamily: 'Nunito, sans-serif',
                            sparkline: {
                                enabled: true,
                            },
                            dropShadow: {
                                enabled: true,
                                blur: 3,
                                color: '#e2a03f',
                                opacity: 0.4,
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        colors: ['#e2a03f'],
                        grid: {
                            padding: {
                                top: 5,
                                bottom: 5,
                                left: 5,
                                right: 5,
                            },
                        },
                        tooltip: {
                            x: {
                                show: false,
                            },
                            y: {
                                title: {
                                    formatter: (formatter = () => {
                                        return '';
                                    }),
                                },
                            },
                        },
                    };
                },

                // followers
                get followersOptions() {
                    return {
                        series: [{
                            data: [38, 60, 38, 52, 36, 40, 28],
                        }, ],
                        chart: {
                            height: 160,
                            type: 'area',
                            fontFamily: 'Nunito, sans-serif',
                            sparkline: {
                                enabled: true,
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        colors: ['#4361ee'],
                        grid: {
                            padding: {
                                top: 5,
                            },
                        },
                        yaxis: {
                            show: false,
                        },
                        tooltip: {
                            x: {
                                show: false,
                            },
                            y: {
                                title: {
                                    formatter: (formatter = () => {
                                        return '';
                                    }),
                                },
                            },
                        },

                        if (isDark) {
                            option['fill'] = {
                                type: 'gradient',
                                gradient: {
                                    type: 'vertical',
                                    shadeIntensity: 1,
                                    inverseColors: !1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.05,
                                    stops: [100, 100],
                                },
                            };
                        },
                    };
                },

                // referral
                get referralOptions() {
                    return {
                        series: [{
                            data: [60, 28, 52, 38, 40, 36, 38],
                        }, ],
                        chart: {
                            height: 160,
                            type: 'area',
                            fontFamily: 'Nunito, sans-serif',
                            sparkline: {
                                enabled: true,
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        colors: ['#e7515a'],
                        grid: {
                            padding: {
                                top: 5,
                            },
                        },
                        yaxis: {
                            show: false,
                        },
                        tooltip: {
                            x: {
                                show: false,
                            },
                            y: {
                                title: {
                                    formatter: (formatter = () => {
                                        return '';
                                    }),
                                },
                            },
                        },

                        if (isDark) {
                            option['fill'] = {
                                type: 'gradient',
                                gradient: {
                                    type: 'vertical',
                                    shadeIntensity: 1,
                                    inverseColors: !1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.05,
                                    stops: [100, 100],
                                },
                            };
                        },
                    };
                },

                // engagement
                get engagementOptions() {
                    return {
                        series: [{
                            name: 'Sales',
                            data: [28, 50, 36, 60, 38, 52, 38],
                        }, ],
                        chart: {
                            height: 160,
                            type: 'area',
                            fontFamily: 'Nunito, sans-serif',
                            sparkline: {
                                enabled: true,
                            },
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        colors: ['#1abc9c'],
                        grid: {
                            padding: {
                                top: 5,
                            },
                        },
                        yaxis: {
                            show: false,
                        },
                        tooltip: {
                            x: {
                                show: false,
                            },
                            y: {
                                title: {
                                    formatter: (formatter = () => {
                                        return '';
                                    }),
                                },
                            },
                        },

                        if (isDark) {
                            option['fill'] = {
                                type: 'gradient',
                                gradient: {
                                    type: 'vertical',
                                    shadeIntensity: 1,
                                    inverseColors: !1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.05,
                                    stops: [100, 100],
                                },
                            };
                        },
                    };
                },
            }));
        });
    </script>
@endsection
