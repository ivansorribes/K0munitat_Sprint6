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
                            Remitente
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Asunto
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
                        <tr class="{{ $message->unread ? 'font-bold' : '' }}">
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

    <!-- Modal para confirmar eliminación -->
    <div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-8 rounded shadow-md">
            <p>¿Estás seguro de que deseas eliminar este mensaje?</p>
            <div id="loading" class="hidden">
                <div id="loading-content"></div>
            </div>
            <div class="flex justify-end mt-4">
                <form id="deleteForm" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Sí, Eliminar</button>
                </form>
                <button onclick="closeModal()" class="bg-gray-500 text-black px-4 py-2 rounded-md mr-2">Cancelar</button>
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

        function showLoading() {
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('loading-content').classList.remove('hidden');
        }

        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('loading-content').classList.add('hidden');
        }
    </script>

@endsection
