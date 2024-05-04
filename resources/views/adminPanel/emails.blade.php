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
                            Remitent
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Message
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($activeMessages as $message)
                        <tr>
                            <td class="px-6 py-4">{{ $message->sender_name }}</td>
                            <td class="px-3 py-4 max-w-sm truncate">{{ $message->message }}</td>
                            <td class="px-6 py-4">
                                <button onclick="confirmDelete(event, {{ $message->id }})"
                                    style="background-color: #E51C1C"
                                    class="text-white px-4 py-2 rounded-md border mr-2 w-32 h-full">
                                    Delete
                                </button>

                                <button
                                    onclick="showMore(event, '{{ $message->sender_name }}', '{{ $message->sender_email }}', '{{ $message->phone }}', '{{ $message->message }}', '{{ $message->userProfileImage }}', '{{ $message->id }}')"
                                    style="background-color: #808080" class="text-white px-4 py-2 rounded-md w-32 h-full">
                                    Show More
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center">There aren't any messages</td>
                        </tr>
                    @endforelse
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
                            Remitent
                        </th>
                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Message
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($deletedMessages as $message)
                        <tr>
                            <td class="px-6 py-4">{{ $message->sender_name }}</td>
                            <td class="px-3 py-4 max-w-sm truncate">{{ $message->message }}</td>
                            <td class="px-6 py-4">
                                <!-- Formulario para restaurar el mensaje eliminado -->
                                <form id="restoreForm{{ $message->id }}" method="POST"
                                    action="{{ route('restoreAdmin.message', $message->id) }}">
                                    @csrf
                                    <button type="submit" onclick="event.stopPropagation()"
                                        style="background-color: #4CAF50"
                                        class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">
                                        Restore
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center">There aren't any deleted messages</td>
                        </tr>
                    @endforelse
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

    <div id="messageModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-8 rounded shadow-md max-w-md w-full mt-20" style="max-height: 80vh; overflow-y:auto;">
            <div class="flex justify-end">
                <button onclick="closeMessageModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <!-- Aquí es donde muestras el mensaje -->
            <div id="messageContent"></div>
        </div>
    </div>

    <div id="deletedMessageModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-8 rounded shadow-md max-w-2xl overflow-y-auto" style="max-height: 80vh;">
            <div class="flex justify-end">
                <button onclick="closeDeletedMessageModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div id="deletedMessageContent"></div>
        </div>
    </div>

    @foreach ($activeMessages as $message)
        <!-- Modal for detailed user information -->
        <div id="showMoreModal-{{ $message->id }}"
            class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-8 rounded shadow-md max-w-2xl overflow-y-auto" style="max-height: 80vh;">
                <div class="flex justify-end">
                    <button onclick="closeShowMoreModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
                </div>
                <div class="flex items-center mb-4">
                    <img src="{{ $message->userProfileImage }}" alt="User Image" class="w-10 h-10 rounded-full"
                        id="senderProfileImage{{ $message->id }}">

                    <div class="ml-4">
                        <h2 class="text-lg font-semibold">Sender: <span id="senderName{{ $message->id }}"></span></h2>
                        <p class="text-gray-600" id="senderEmail{{ $message->id }}"></p>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="font-semibold">Phone:</p>
                    <p id="senderPhone{{ $message->id }}"></p>
                </div>
                <div class="mb-4">
                    <p class="font-semibold">Message:</p>
                    <p><span id="message{{ $message->id }}"></span></p>
                </div>
                <!-- Formulario de respuesta -->
                <form id="replyForm{{ $message->id }}" action="{{ route('reply.message') }}" method="POST">
                    @csrf
                    <input type="hidden" id="replyToName{{ $message->id }}" name="reply_to_name">
                    <input type="hidden" id="originalMessageId{{ $message->id }}" name="original_message_id">
                    <!-- Campo oculto para el original_message_id -->
                    <label for="replyMessage{{ $message->id }}" class="block mb-2">Message:</label>
                    <textarea id="replyMessage{{ $message->id }}" name="reply_message" rows="4"
                        class="w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"></textarea>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mr-2">Send</button>
                        <button type="button" onclick="closeShowMoreModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

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

        function replyToMessage(event, senderName) {
            event.stopPropagation();
            document.getElementById('replyTo').textContent = senderName;
            document.getElementById('replyToName').value = senderName;
            document.getElementById('showMoreModal').classList.remove('hidden');
        }

        function openMessageModal(message) {
            document.getElementById('messageModal').classList.remove('hidden');
        }

        function closeMessageModal() {
            document.getElementById('messageModal').classList.add('hidden');
        }

        function openDeletedMessageModal(message) {
            document.getElementById('deletedMessageContent').textContent = message;
            document.getElementById('deletedMessageModal').classList.remove('hidden');
        }

        function closeDeletedMessageModal() {
            document.getElementById('deletedMessageModal').classList.add('hidden');
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

        function restoreMessage(event, id) {
            event.stopPropagation();
            document.getElementById('restoreForm' + id).submit();
        }

        function showMore(event, senderName, senderEmail, senderPhone, message, userProfileImage, id) {
            event.stopPropagation();
            document.getElementById('senderName' + id).textContent = senderName;
            document.getElementById('senderEmail' + id).textContent = senderEmail;
            document.getElementById('senderPhone' + id).textContent = senderPhone;
            document.getElementById('message' + id).textContent = message;
            // Mostrar la imagen del usuario
            document.getElementById('senderProfileImage' + id).src = userProfileImage;
            document.getElementById('originalMessageId' + id).value = id; // Configurar el valor del campo originalMessageId
            document.getElementById('replyToName' + id).value = senderName; // Configurar el valor del campo replyToName si es necesario
            document.getElementById('showMoreModal-' + id).classList.remove('hidden');
        }

        function closeShowMoreModal() {
            const modals = document.querySelectorAll('[id^=showMoreModal-]');
            modals.forEach(modal => {
                modal.classList.add('hidden');
            });
        }
    </script>

@endsection
