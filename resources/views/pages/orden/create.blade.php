@extends('layouts.main')
@section('titulo', 'Jaime - Agregar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/file-upload-with-preview.min.css') }}" />
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <!-- start main content section -->
        <div x-data="invoiceAdd">
            <div class="flex flex-col gap-2.5 xl:flex-row">
                <div class="panel flex-1 px-0 py-6 ltr:lg:mr-6 rtl:lg:ml-6">
                    <div class="flex flex-wrap justify-between px-4">
                        <div class="mb-6 w-full lg:w-1/2">
                            <div class="mt-6 space-y-1 text-gray-500 dark:text-gray-400">
                                <div>{{ $user->address }}</div>
                                <div>{{ $user->email }}</div>
                                <div>{{ $user->phone }}</div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 lg:max-w-fit">
                            <div class="flex items-center">
                                <label for="number" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">No. Orden
                                    {{ $no_orden }}</label>
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="dueDate" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">Fecha</label>
                                <input id="dueDate" type="date" name="due-date" class="form-input w-2/3 lg:w-[250px]"
                                    x-model="params.fecha" />
                            </div>
                        </div>
                    </div>
                    <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
                    <div class="mt-8 px-4">
                        <div class="flex flex-col justify-between lg:flex-row">
                            <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                                <div class="text-lg font-semibold">Información de facturación:</div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-compania" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Compañía:</label>
                                    <input id="reciever-compania" type="text" name="reciever-compania"
                                        class="form-input flex-1" x-model="params.to.compania"
                                        placeholder="Ingresa la compañia" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Nombre:</label>
                                    <input id="reciever-name" type="text" name="reciever-name" class="form-input flex-1"
                                        x-model="params.to.name" placeholder="Ingresa el nombre" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-number" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Teléfono:</label>
                                    <input id="reciever-number" type="text" name="reciever-number"
                                        class="form-input flex-1" x-model="params.to.phone"
                                        placeholder="Ingresa número celular" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Dirección:</label>
                                    <input id="reciever-address" type="text" name="reciever-address"
                                        class="form-input flex-1" x-model="params.to.address"
                                        placeholder="Ingresa Dirección" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-address-two" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Dirección
                                        2:</label>
                                    <input id="reciever-address-two" type="text" name="reciever-address-two"
                                        class="form-input flex-1" x-model="params.to.address"
                                        placeholder="Ingresa Dirección 2" />
                                </div>
                            </div>
                            <div class="w-full lg:w-1/2">
                                <div class="text-lg font-semibold">Información de envío:</div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-compania" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Compañía:</label>
                                    <input id="reciever-compania" type="text" name="reciever-compania"
                                        class="form-input flex-1" x-model="params.bankInfo.compania"
                                        placeholder="Ingresa la compañia" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Nombre:</label>
                                    <input id="reciever-name" type="text" name="reciever-name" class="form-input flex-1"
                                        x-model="params.bankInfo.name" placeholder="Ingresa el nombre" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-number" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Teléfono:</label>
                                    <input id="reciever-number" type="text" name="reciever-number"
                                        class="form-input flex-1" x-model="params.bankInfo.phone"
                                        placeholder="Ingresa número celular" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Dirección:</label>
                                    <input id="reciever-address" type="text" name="reciever-address"
                                        class="form-input flex-1" x-model="params.bankInfo.address"
                                        placeholder="Ingresa Dirección" />
                                </div>
                                <div class="mt-4 flex items-center">
                                    <label for="reciever-address-two" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Dirección
                                        2:</label>
                                    <input id="reciever-address-two" type="text" name="reciever-address-two"
                                        class="form-input flex-1" x-model="params.bankInfo.address"
                                        placeholder="Ingresa Dirección 2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th class="w-1">Cantidad</th>
                                        <th class="w-1">Precio</th>
                                        <th>Total</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-if="items.length <= 0">
                                        <tr>
                                            <td colspan="5" class="!text-center font-semibold">Esta vacio</td>
                                        </tr>
                                    </template>
                                    <template x-for="(item, i) in items" :key="i">
                                        <tr class="border-b border-[#e0e6ed] align-top dark:border-[#1b2e4b]">
                                            <td>
                                                <select id="patient_id" name="patient_id"
                                                    class="form-select min-w-[200px]" x-model="item.patient_id">
                                                    <option value="">Pacientes</option>
                                                    @foreach ($pacientes as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <select id="medicine_id" name="medicine_id"
                                                    class="form-select min-w-[200px] mt-4" x-model="item.medicine_id"
                                                    @change="getMedicamentos(item)">
                                                    <option value="">Medicamentos</option>
                                                    @foreach ($medicinas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->descripcion }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" class="form-input w-32" placeholder="Cantidad"
                                                    x-model="item.cantidad" /></td>
                                            <td><input type="text" class="form-input w-32" placeholder="Precio"
                                                    x-model="item.amount" /></td>
                                            <td x-text="`$${item.amount * item.cantidad}`"></td>
                                            <td>
                                                <button type="button" @click="removeItem(item)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="h-5 w-5">
                                                        <line x1="18" y1="6" x2="6"
                                                            y2="18"></line>
                                                        <line x1="6" y1="6" x2="18"
                                                            y2="18"></line>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6 flex flex-col justify-between px-4 sm:flex-row">
                            <div class="mb-6 sm:mb-0">
                                <button type="button" class="btn btn-primary" @click="addItem()">Agregar
                                    medicamento</button>
                            </div>
                            <div class="sm:w-2/5">
                                <div class="flex items-center justify-between">
                                    <div>Subtotal</div>
                                    <div id="subtotal">$0.00</div>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div>Envio</div>
                                    <div>$0.00</div>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div>Impuestos</div>
                                    <div id="iva">$0.00</div>
                                </div>
                                <div class="mt-4 flex items-center justify-between font-semibold">
                                    <div>Total</div>
                                    <div id="total">$0.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 px-4">
                        <div>
                            <label for="notes">Notes</label>
                            <textarea id="notes" name="notes" class="form-textarea min-h-[130px]" placeholder="Notes...."
                                x-model="params.notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-6 w-full xl:mt-0 xl:w-96">
                    <div class="panel">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                            <button type="button" class="btn btn-success w-full gap-2" @click="saveItems()">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                    <path
                                        d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path
                                        d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                                Guardar
                            </button>

                            <button type="button" class="btn btn-info w-full gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                    <path
                                        d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                                Send Invoice
                            </button>

                            <a href="apps-invoice-preview.html" class="btn btn-primary w-full gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                    <path opacity="0.5"
                                        d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                    <path
                                        d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                </svg>
                                Preview
                            </a>

                            <button type="button" class="btn btn-secondary w-full gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                    <path opacity="0.5"
                                        d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end main content section -->
    </div>
@endsection

@section('scripts')
    <script>
        var medicinas = @json($medicinas);
        var acopio = @json($acopio);
        var user = @json($user);
        var no_orden = @json($no_orden);
        // var listFormat = list.map(i => [i.id]);

        document.addEventListener('alpine:init', () => {
            // main section
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

            //invoice add
            Alpine.data('invoiceAdd', () => ({
                items: [],
                selectedFile: null,
                params: {
                    invoiceNo: no_orden,
                    to: {
                        compania: acopio.compania,
                        name: acopio.name,
                        phone: acopio.phone,
                        address: acopio.address,
                        address_two: acopio.address_two,
                    },
                    fecha: '',
                    bankInfo: {
                        compania: acopio.compania,
                        name: acopio.name,
                        phone: acopio.phone,
                        address: acopio.address,
                        address_two: acopio.address_two,
                    },
                    notes: 'Hola mundo',
                },

                init() {
                    //set default data
                    this.items.push({
                        id: 1,
                        patient_id: '',
                        medicine_id: '',
                        rate: 0,
                        cantidad: 1,
                        amount: 0,
                    });
                },

                getMedicamentos(item) {
                    var medicamento = medicinas.filter((d) => d.id == item.medicine_id);
                    let numMedicinas = this.items.length - 1;
                    this.items[numMedicinas].amount = medicamento[0].pecio
                    // console.log(numMedicinas);

                    var total = 0
                    this.items.forEach(e => {
                        if (!isNaN(e.amount) && !isNaN(e.cantidad)) {
                            total += e.amount * e.cantidad
                        }
                    });

                    let iva = total * 0.16
                    let subtotal = total - iva

                    document.getElementById('subtotal').innerText = '$' + subtotal.toFixed(2)
                    document.getElementById('iva').innerText = '$' + iva.toFixed(2)
                    document.getElementById('total').innerText = '$' + total.toFixed(2)
                },

                addItem() {
                    let maxId = 0;
                    if (this.items && this.items.length) {
                        maxId = this.items.reduce((max, character) => (character.id > max ? character
                            .id : max), this.items[0].id);
                    }
                    this.items.push({
                        id: maxId + 1,
                        patient_id: '',
                        medicine_id: '',
                        rate: 0,
                        cantidad: 1,
                        amount: 0,
                    });


                },

                removeItem(item) {
                    this.items = this.items.filter((d) => d.id != item.id);
                },

                saveItems() {
                    var myHeaders = new Headers();
                    myHeaders.append("Accept", "application/json");
                    myHeaders.append("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'));


                    var formdata = new FormData();
                    formdata.append("id", this.items);

                    var requestOptions = {
                        method: 'POST',
                        headers: myHeaders,
                        body: formdata,
                        redirect: 'follow'
                    };

                    fetch("/orden/store", requestOptions)
                        .then(response => response.text())
                        .then(result => {
                            console.log(result);
                        })
                        .catch(error => console.log('error', error));
                },
            }));
        });
    </script>
@endsection
