@extends('layouts.main')
@section('titulo', 'Comunidad religiosa - Orden')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <input type="hidden" value="{{ $order->id }}" id="ordenID">
        <!-- start main content section -->
        <div x-data="invoicePreview">
            <div class="mb-6 flex flex-wrap items-center justify-center gap-4 lg:justify-end">
                <select name="" id="status_order_change" class="btn btn-danger gap-2" onchange="cambioStatus()">
                    <option value="0">Status Orden</option>
                    @foreach ($status_orden as $item)
                        <option value="{{ $item->id }}" @if ($item->id == $order->status_orden_id) selected @endif>
                            {{ $item->status }}</option>
                    @endforeach
                </select>

                <button type="button" class="btn btn-success gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5">
                        <path opacity="0.5"
                            d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Descargar
                </button>
            </div>
            <div class="panel">
                <div class="flex flex-wrap justify-between gap-4 px-4">
                    <div class="text-2xl font-semibold uppercase">Orden</div>
                    <div class="shrink-0">
                        <img src="{{ url('assets/images/logo.svg') }}" alt="image"
                            class="w-14 ltr:ml-auto rtl:mr-auto" />
                    </div>
                </div>
                <div class="px-4 ltr:text-right rtl:text-left">
                    <div class="mt-6 space-y-1 text-white-dark">
                        <div>{{ $user->name }}</div>
                        <div>{{ $user->email }}</div>
                        <div>{{ $user->phone }}</div>
                    </div>
                </div>

                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
                <div class="flex flex-col flex-wrap justify-between gap-6 lg:flex-row">
                    <div class="flex flex-col justify-between gap-6 sm:flex-row w-full">
                        <div class="xl:1/3 sm:w-1/2 lg:w-2/6">
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Orden :</div>
                                <div>#{{ $order->id }}</div>
                            </div>
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Fecha Solicitud :</div>
                                <div>{{ $order->fecha_solicitud }}</div>
                            </div>
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Método Pago :</div>
                                <div style="color: #ff0000">PENDIENTE</div>
                            </div>
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Comunidad religiosa :</div>
                                <div>{{ $order->acopio->name }}</div>
                            </div>
                            <div class="flex w-full items-center justify-between">
                                <div class="text-white-dark">Estatus de la orden :</div>
                                <div>{{ $order->status_orden->status }}</div>
                            </div>
                        </div>
                        <div class="xl:1/3 sm:w-1/2 lg:w-2/6">
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Compañia:</div>
                                <div class="whitespace-nowrap">{{ $order->acopio->facturation->compania }}</div>
                            </div>
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Nombre:</div>
                                <div>{{ $order->acopio->facturation->name }}</div>
                            </div>
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Teléfono:</div>
                                <div>{{ $order->acopio->facturation->phone }}</div>
                            </div>
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Dirección 1:</div>
                                <div>{{ $order->acopio->facturation->address }}</div>
                            </div>
                            <div class="mb-2 flex w-full items-center justify-between">
                                <div class="text-white-dark">Dirección 2:</div>
                                <div>{{ $order->acopio->facturation->address_two }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-6">
                    <table class="table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Paciente</th>
                                <th>Medicina</th>
                                <th class="ltr:text-right rtl:text-left">Cantidad</th>
                                <th class="ltr:text-right rtl:text-left">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicinas as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->patient->name }}</td>
                                    <td>{{ $item->medicine->descripcion }}</td>
                                    <td class="ltr:text-right rtl:text-left">{{ $item->cantidad }}</td>
                                    <td class="ltr:text-right rtl:text-left">${{ $item->pecio }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 grid grid-cols-1 px-4 sm:grid-cols-2">
                    <div></div>
                    <div class="space-y-2 ltr:text-right rtl:text-left">
                        <div class="flex items-center">
                            <div class="flex-1">Subtotal</div>
                            <div class="w-[37%]">${{ number_format($subtotal, 2, '.', ',') }}</div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-1">IVA</div>
                            <div class="w-[37%]">${{ number_format($iva, 2, '.', ',') }}</div>
                        </div>
                        <div class="flex items-center text-lg font-semibold">
                            <div class="flex-1">Total</div>
                            <div class="w-[37%]">${{ number_format($total, 2, '.', ',') }}</div>
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
        var ordenID = document.getElementById('ordenID').value
        var facturacion = @json($facturacion);
        var direccion_envio = @json($direccion_envio);
        var medicinas = @json($medicinas);
        var listFormat = medicinas.map(i => [i.id, i.patient.name, i.medicine.descripcion, i.cantidad, i.pecio]);
        console.log(listFormat);


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

            //invoice preview
            Alpine.data('invoicePreview', () => ({
                items: [{
                    id: 1,
                    title: 'Calendar App Customization',
                    quantity: 1,
                    price: '120',
                    amount: '120',
                }, ],
                columns: [{
                        key: 'id',
                        label: 'S.NO',
                    },
                    {
                        key: 'title',
                        label: 'ITEMS',
                    },
                    {
                        key: 'quantity',
                        label: 'QTY',
                    },
                    {
                        key: 'price',
                        label: 'PRICE',
                        class: 'ltr:text-right rtl:text-left',
                    },
                    {
                        key: 'amount',
                        label: 'AMOUNT',
                        class: 'ltr:text-right rtl:text-left',
                    },
                ],

                print() {
                    window.print();
                },
            }));
        });

        function cambioStatus() {
            var id = document.getElementById("status_order_change").value;

            swal.fire({
                title: '¿Quieres combiar el status de esta orden?',
                text: '¡Notificaremos a la comunidad religiosa del cambió de estatus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Si, cambiar",
                cancelButtonText: 'Cancelar',
                buttonsStyling: true,
                showCloseButton: true
            }).then(response => {
                if (response.value) {
                    var myHeaders = new Headers();
                    myHeaders.append("Accept", "application/json");
                    myHeaders.append("X-CSRF-TOKEN", document.querySelector(
                            'meta[name="csrf-token"]')
                        .getAttribute('content'));


                    var formdata = new FormData();
                    formdata.append("order_id", ordenID)
                    formdata.append("status_orden_id", id)

                    var requestOptions = {
                        method: 'POST',
                        headers: myHeaders,
                        body: formdata,
                        redirect: 'follow'
                    };

                    fetch("/orden/change_status_order", requestOptions)
                        .then(response => response.json())
                        .then(result => {
                            console.log(result);
                            // location.reload();
                        })
                        .catch(error => console.log('error', error));
                }
            })
        }
    </script>
@endsection
