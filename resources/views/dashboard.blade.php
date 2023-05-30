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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte de quejas') }}
        </h2>
    </x-slot>
    <style>
        .table-container {
            display: flex;
        }

        .table-container table {
            margin-right: 10px;
            /* Espacio entre las tablas */
        }
    </style>
    <div class="table-container">
        <table id="quejas" class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Correo Electronico</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->idqueja }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->direccion }}</td>
                        <td>
                            @if ($item->categoriaqueja == 1)
                                Opcion 1
                            @elseif($item->categoriaqueja == 2)
                                Opcion 2
                            @elseif($item->categoriaqueja == 3)
                                Opcion 3
                            @elseif($item->categoriaqueja == 4)
                                Opcion 4
                            @endif
                        </td>
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

                    </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                    <tr>
                        <td>
                            <form action="{{ route('actualizar.estado', ['idqueja' => $item->idqueja]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success text-dark">
                                    Solucionar
                                </button>
                            </form>


                            <form action="{{ route('descartar.estado', ['idqueja' => $item->idqueja]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger text-dark">
                                    Descartar
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>



<script src="../../plugins/jquery/jquery.min.js"></script>

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
<script>
    $(function() {
        $("#quejas").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#quejas_wrapper .col-md-6:eq(0)');

    });
</script>
