@extends('adminPanel.layout')
@section('title', 'Email Admin')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Lista de Correos Electrónicos</h1>
        <div class="bg-white shadow-md rounded-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sender
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mensaje
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($messages as $message)
                        <tr>
                            <td class="px-6 py-4">{{ $message->sender_name }}</td>
                            <td class="px-6 py-4">{{ $message->subject }}</td>
                            <td class="px-6 py-4">{{ $message->message }}</td>
                            <td class="px-6 py-4">
                                <button onclick="confirmDelete({{ $message->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Si no hay mensajes -->
                    @if ($messages->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">No hay mensajes disponibles</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-8 rounded shadow-md">
            <p>¿Estás seguro de que deseas eliminar este mensaje?</p>
            <div class="flex justify-end mt-4">
                <form id="deleteForm" method="POST">
                    @csrf
                    <button type="submit" style="background-color: #E51C1C"
                        class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Sí, Eliminar</button>
                </form>
                <button onclick="closeModal()" style="background-color: #3d3c3b"
                    class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Cancelar</button>
            </div>
        </div>
    </div>


    <script>
        function confirmDelete(id) {
            document.getElementById('deleteModal').classList.remove('hidden');
            // Configurar la acción del formulario para enviar el id del mensaje
            document.getElementById('deleteForm').action = `/messages/${id}`;
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>

@endsection
