<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    integrity="sha384-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<x-app-layout>
    <x-slot name="header">
        <div style="max-width: 1250px; margin: 0 auto;">
            <h2 class="font-semibold text-xl text-white-800 leading-tight">
                {{ __('Reporte de quejas') }}
            </h2>
        </div>
    </x-slot>
    <br>
    <style>
        .table-container {
            display: flex;
            max-width: 1250px;
            margin: 0 auto;

        }

        .table-container table {
            margin-right: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            /* Espacio entre las tablas */
        }

        .dataTables_wrapper .dt-buttons {
            background-color: black;
            /* Agregado */
        }

        .container-with-bg {
            background-color: white;
            padding: 10px;
        }

        .sticky-col {
            position: sticky !important;
            z-index: 1000;
            top: 0;
            align-self: flex-start;
            left: 0;
        }
    </style>
    <div class="table-container">
        <table id="quejas" class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->idqueja }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->direccion }}</td>
                        <td>{{ $item->categoriaqueja }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->fecha }}</td>
                        <td>
                            @if ($item->estado == 1)
                                Pendiente
                            @elseif($item->estado == 2)
                                Solucionado
                            @elseif($item->estado == 3)
                                Descartado
                            @else
                                Estado desconocido
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('actualizar.estado', ['idqueja' => $item->idqueja]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    Solucionar
                                </button>
                            </form>

                            <form action="{{ route('descartar.estado', ['idqueja' => $item->idqueja]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Descartar
                                </button>
                            </form>
                        </td>
                        <td>
                            @if ($item->imagenes != null)
                                <img src='vista.php?id={{ $item->idqueja }}' width="150" />
                            @else
                            @endif
                        </td>
                    </tr>
                @endforeach
        </table>
        <table class="sticky-col">
            <thead>

            </thead>
            <tbody>
                @foreach ($datos as $item)
                    <tr>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>



<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/jquery/jquery-3.5.1.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<div class="container-with-bg">
    <script>
        $(function() {
            $("#quejas").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "columns": [
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    {
                        "type": "html"
                    },
                    {
                        "type": "html"
                    },
                ],
                "buttons": [{
                        text: 'Copiar',
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        text: 'Exportar a PDF',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        text: 'Exportar a Excel',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        text: 'Imprimir',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                ]
            }).buttons().container().appendTo('#quejas_wrapper .col-md-6:eq(0)');
        });
    </script>
</div>
