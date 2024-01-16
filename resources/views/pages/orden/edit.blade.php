@extends('layouts.main')
@section('titulo', 'Jaime - Editar')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/file-upload-with-preview.min.css') }}" />
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <input type="hidden" value="{{ $idOrden }}" id="ordenID">
        <!-- start main content section -->
        <div x-data="invoiceAdd">
            <div class="flex flex-col gap-2.5 xl:flex-row">
                <div class="panel flex-1 px-0 py-12 ltr:lg:mr-12 rtl:lg:ml-12">
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
                                                <input type="hidden" name="orden_medina_id"
                                                    x-model="item.orden_medina_id">
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
                            <textarea id="notes" name="notes" class="form-textarea min-h-[130px]" placeholder="Notas...."
                                x-model="params.notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 w-full xl:mt-4 xl:w-100">
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
                                <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Download
                        </button>
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
        var ordenID = document.getElementById('ordenID').value
        // Extraer componentes específicos de la fecha
        var fechaActual = new Date();
        var año = fechaActual.getFullYear();
        var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2);
        var dia = ('0' + fechaActual.getDate()).slice(-2);
        var fechaFormateada = año + '-' + mes + '-' + dia;

        console.log(fechaFormateada);

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
                    fecha: fechaFormateada,
                    bankInfo: {
                        compania: acopio.compania,
                        name: acopio.name,
                        phone: acopio.phone,
                        address: acopio.address,
                        address_two: acopio.address_two,
                    },
                    notes: '',
                },

                init() {

                    // URL de la API o recurso que deseas obtener
                    const url = '/orden_medinas/get_orden_medicinas/' + ordenID;

                    // Realizar la solicitud GET usando fetch
                    fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`Error de red: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            var x = 0
                            data.forEach(e => {
                                console.log(e);
                                // this.items.push({
                                //     id: 0,
                                //     orden_medina_id: e.id,
                                //     patient_id: e.patient_id,
                                //     medicine_id: e.medicine_id,
                                //     cantidad: e.cantidad,
                                //     amount: e.pecio,
                                // });
                            });
                        })
                        .catch(error => {
                            // Manejar errores de red o errores en el proceso
                            console.error('Error de fetch:', error);
                        });


                },

                getMedicamentos(item) {
                    let row = this.items.filter((d) => d.id == item.id)
                    let medicamento = medicinas.filter((d) => d.id == item.medicine_id);
                    this.items[row[0].id].amount = medicamento[0].pecio

                    var myHeaders = new Headers();
                    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
                    myHeaders.append("Accept", "application/json");
                    myHeaders.append("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'));


                    var formdata = new URLSearchParams();
                    formdata.append("patient_id", this.items[row[0].id].patient_id)
                    formdata.append("medicine_id", this.items[row[0].id].medicine_id)
                    formdata.append("cantidad", this.items[row[0].id].cantidad)

                    var requestOptions = {
                        method: 'PUT',
                        headers: myHeaders,
                        body: formdata,
                        redirect: 'follow'
                    };

                    fetch("/orden_medinas/update/" + this.items[row[0].id].orden_medina_id,
                            requestOptions)
                        .then(response => response.text())
                        .then(result => {
                            console.log(result);
                        })
                        .catch(error => console.log('error', error));


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

                    var myHeaders = new Headers();
                    myHeaders.append("Accept", "application/json");
                    myHeaders.append("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'));


                    var formdata = new FormData();
                    formdata.append("order_id", ordenID)

                    var requestOptions = {
                        method: 'POST',
                        headers: myHeaders,
                        body: formdata,
                        redirect: 'follow'
                    };

                    fetch("/orden_medinas/store", requestOptions)
                        .then(response => response.json())
                        .then(result => {

                            this.items.push({
                                id: maxId + 1,
                                orden_medina_id: result.OrdenMedina,
                                patient_id: '',
                                medicine_id: '',
                                cantidad: 1,
                                amount: 0,
                            });

                        })
                        .catch(error => console.log('error', error));

                },

                removeItem(item) {
                    swal.fire({
                        title: '¿Quieres eliminar esta fila?',
                        text: 'Las filas eliminadas ya no se podrán recuperar',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                        cancelButtonClass: 'btn btn-danger w-xs mt-2',
                        confirmButtonText: "Si, borrar",
                        cancelButtonText: 'Cancelar',
                        buttonsStyling: true,
                        showCloseButton: true
                    }).then(response => {
                        if (response.value) {
                            var requestOptions = {
                                method: 'DELETE',
                                redirect: 'follow',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content')
                                }
                            };

                            fetch(`/orden_medinas/delete/${item.orden_medina_id}`,
                                    requestOptions)
                                .then(response => {
                                    response.text()
                                })
                                .then(result => {
                                    this.items = this.items.filter((d) => d.id != item.id);
                                })
                                .catch(error => console.log('error', error));
                        }
                    })
                },

                saveItems() {

                },
            }));
        });
    </script>
@endsection
