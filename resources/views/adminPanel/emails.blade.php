@extends('adminPanel.layout')
@section('title', 'Email Admin')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Lista de Correos Electrónicos</h1>
        <!-- Botón para mostrar los mensajes eliminados -->
        <div id="deletedMessagesButton">
            <button onclick="showDeletedMessages()" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Deleted
                messages</button>
        </div>
        <!-- Tabla de mensajes activos -->
        <div id="activeMessages" class="bg-white shadow-md rounded-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Remitente
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mensaje
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($activeMessages as $message)
                        <tr>
                            <td class="px-6 py-4">{{ $message->sender_name }}</td>
                            <td class="px-3 py-4 max-w-sm truncate">{{ $message->message }}</td>
                            <td class="px-6 py-4">
                                <button onclick="confirmDelete(event, {{ $message->id }})" class="text-red-600 mr-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button
                                    onclick="showMore(event, '{{ $message->sender_name }}', '{{ $message->sender_email }}', '{{ $message->phone }}', '{{ $message->message }}', '{{ $message->userProfileImage }}')"
                                    class="text-green-600">
                                    Show More
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    <!-- Si no hay mensajes -->
                    @if ($activeMessages->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">There aren't any messages</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- Tabla de mensajes eliminados (inicialmente oculta) -->
        <div id="deletedMessages" class="hidden">
            <button onclick="showActiveMessages()" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Active
                messages</button>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Remitente
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mensaje
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($deletedMessages as $message)
                        <tr>
                            <td class="px-6 py-4">{{ $message->sender_name }}</td>
                            <td class="px-3 py-4 max-w-sm truncate">{{ $message->message }}</td>
                            <td class="px-6 py-4">
                                <!-- Formulario para restaurar el mensaje eliminado -->
                                <form id="restoreForm{{ $message->id }}" method="POST"
                                    action="{{ route('restoreAdmin.message', $message->id) }}">
                                    @csrf
                                    <button type="submit" onclick="event.stopPropagation()" class="text-green-600">
                                        Restore
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Si no hay mensajes eliminados -->
                    @if ($deletedMessages->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">There aren't any deleted messages</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modales -->
    <div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-8 rounded shadow-md">
            <p>Are you sure you want to delete this message?</p>
            <div class="flex justify-end mt-4">
                <form id="deleteForm" method="POST">
                    @csrf
                    <button type="submit" style="background-color: #E51C1C"
                        class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Yes, Delete</button>
                </form>
                <button onclick="closeModal()" style="background-color: #3d3c3b"
                    class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Modal for detailed user information -->
    <div id="showMoreModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-8 rounded shadow-md max-w-2xl overflow-y-auto" style="max-height: 80vh;">
            <div class="flex justify-end">
                <button onclick="closeShowMoreModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div class="flex items-center mb-4">
                <img src="" alt="User Image" class="w-10 h-10 rounded-full" id="senderProfileImage">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Sender: <span id="senderName"></span></h2>
                    <p class="text-gray-600" id="senderEmail"></p>
                </div>
            </div>
            <div class="mb-4">
                <p class="font-semibold">Phone:</p>
                <p id="senderPhone"></p>
            </div>
            <div class="mb-4">
                <p class="font-semibold">Message:</p>
                <p id="messageContent"></p>
            </div>
            <!-- Formulario de respuesta -->
            <form id="replyForm" action="{{ route('reply.message') }}" method="POST">
                @csrf
                <input type="hidden" id="replyToName" name="reply_to_name">
                <input type="hidden" id="originalMessageId" name="original_message_id">
                <label for="replyMessage" class="block mb-2">Message:</label>
                <textarea id="replyMessage" name="reply_message" rows="4"
                    class="w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"></textarea>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mr-2">Send</button>
                    <button type="button" onclick="closeShowMoreModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->
    <script>
        function confirmDelete(event, id) {
            event.stopPropagation();
            document.getElementById('deleteModal').classList.remove('hidden');
            // Configurar la acción del formulario para enviar el id del mensaje
            document.getElementById('deleteForm').action = `/messages/${id}`;
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function showDeletedMessages() {
            // Ocultar el botón de mensajes eliminados
            document.getElementById('deletedMessagesButton').classList.add('hidden');
            // Mostrar la tabla de mensajes eliminados
            document.getElementById('deletedMessages').classList.remove('hidden');
            // Ocultar la tabla de mensajes activos
            document.getElementById('activeMessages').classList.add('hidden');
        }

        function showActiveMessages() {
            // Mostrar el botón de mensajes eliminados
            document.getElementById('deletedMessagesButton').classList.remove('hidden');
            // Mostrar la tabla de mensajes activos
            document.getElementById('activeMessages').classList.remove('hidden');
            // Ocultar la tabla de mensajes eliminados
            document.getElementById('deletedMessages').classList.add('hidden');
        }

        function showMore(event, senderName, senderEmail, senderPhone, message, userProfileImage) {
            event.stopPropagation();
            document.getElementById('senderName').textContent = senderName;
            document.getElementById('senderEmail').textContent = senderEmail;
            document.getElementById('senderPhone').textContent = senderPhone;
            document.getElementById('messageContent').textContent = message;
            document.getElementById('senderProfileImage').src =
            userProfileImage; // Aquí establecemos la imagen del remitente
            document.getElementById('showMoreModal').classList.remove('hidden');
        }

        function closeShowMoreModal() {
            document.getElementById('showMoreModal').classList.add('hidden');
        }
    </script>

@endsection
