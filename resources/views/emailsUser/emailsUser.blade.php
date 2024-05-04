@extends('adminPanel.layout')
@section('title', 'Email Admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Emails list</h1>
    <!-- Botón para mostrar los mensajes eliminados -->
    <div id="activeMessagesButton">
        <button onclick="showDeletedMessages()" style="background-color: #808080" class="text-white px-4 py-2 rounded-md mb-4">Deleted messages</button>
    </div>
    <!-- Tabla de mensajes activos -->
    <div id="activeMessages" class="bg-white shadow-md rounded-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sender
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Message
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($activeEmails as $email)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $email->sender_name }}</td>
                    <td class="px-6 py-4 max-w-sm truncate">{{ $email->message }}</td>
                    <!-- Dentro del bucle foreach -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button onclick="showMore(event, '{{ $email->sender_name }}', '{{ $email->sender_email }}', '{{ $email->message }}')" style="background-color: #808080" class="text-white px-4 py-2 rounded-md w-32 h-full">Show More</button>
                        <button onclick="confirmDelete(event, {{ $email->id }})" style="background-color: #E51C1C" class="text-white px-4 py-2 rounded-md border mr-2 w-32 h-full">Delete</button>
                    </td>
                </tr>
                @endforeach
                <!-- Si no hay mensajes -->
                @if ($activeEmails->isEmpty())
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center">There aren't any messages</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- Tabla de mensajes eliminados (inicialmente oculta) -->
    <div id="deletedMessages" class="hidden">
        <button onclick="showActiveMessages()" style="background-color: #808080" class="text-white px-4 py-2 rounded-md mb-4">Active messages</button>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sender
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Message
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($deletedEmails as $email)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $email->sender_name }}</td>
                    <td class="px-6 py-4 max-w-sm truncate">{{ $email->message }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('restore.message', ['id' => $email->id]) }}" method="POST">
                            @csrf
                            <button type="submit" style="background-color: #4CAF50" class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Restore</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <!-- Si no hay mensajes -->
                @if ($deletedEmails->isEmpty())
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center">There aren't deleted messages.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-8 rounded shadow-md">
        <p>Are you sure that you want to delete this message?</p>
        <div class="flex justify-end mt-4">
            <form id="deleteForm" method="POST">
                @csrf
                <button type="submit" style="background-color: #E51C1C" class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Yes, delete</button>
            </form>
            <button onclick="closeModal()" style="background-color: #3d3c3b" class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Cancel</button>
        </div>
    </div>
</div>

<<<<<<< HEAD
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
=======
<!-- Modal for detailed user information -->
<div id="showMoreModal" class="mt-10 hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-8 rounded shadow-md max-w-2xl overflow-y-auto" style="max-height: 80vh;">
        <div class="flex items-center mb-4">
            <img src="{{ $email->profile_image }}" alt="User Image" class="w-10 h-10 rounded-full">
            <div class="ml-4">
                <h2 class="text-lg font-semibold">Sender: <span id="senderName">{{ $email->sender_name }}</span></h2>
                <p class="text-gray-600" id="senderEmail">{{ $email->sender_email }}</p>
>>>>>>> main
            </div>
        </div>

<<<<<<< HEAD
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
=======
        <div class="mb-4">
            <p class="font-semibold">Message:</p>
            <p id="message">{{ $email->message }}</p>
>>>>>>> main
        </div>
        <!-- Formulario de respuesta -->
        <form id="replyForm" action="{{ route('reply.message2') }}" method="POST">
            @csrf
            <input type="hidden" id="replyToName" name="reply_to_name">
            <input type="hidden" id="originalMessageId" name="original_message_id">
            <label for="replyMessage" class="block mb-2">Message:</label>
            <textarea id="replyMessage" name="reply_message" rows="4" class="w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"></textarea>
            <div class="mt-4 flex justify-end">
                <button type="submit" style="background-color: #64a858" class="text-white px-4 py-2 rounded-md mr-2">Send</button>
                <button type="button" onclick="closeShowMoreModal()" style="background-color: #3d3c3b" class="text-white px-4 py-2 rounded-md">Cancel</button>
            </div>
        </form>
    </div>
<<<<<<< HEAD
    <!-- Scripts -->
    <script>
        function confirmDelete(event, id) {
            event.stopPropagation();
            document.getElementById('deleteModal').classList.remove('hidden');
            // Configurar la acción del formulario para enviar el id del mensaje
            document.getElementById('deleteForm').action = `/messages/${id}`;
        }
=======
</div>

<script>
    function confirmDelete(event, id) {
        event.stopPropagation();
        document.getElementById('deleteModal').classList.remove('hidden');
        // Configurar la acción del formulario para enviar el id del mensaje
        document.getElementById('deleteForm').action = `/messagesDelete/${id}`;
    }
>>>>>>> main

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

<<<<<<< HEAD
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

=======
    function openMessageModal(message) {
        document.getElementById('messageContent').textContent = message;
        document.getElementById('messageModal').classList.remove('hidden');
    }

    function closeMessageModal() {
        document.getElementById('messageModal').classList.add('hidden');
    }

    function showDeletedMessages() {
        // Ocultar el botón de mensajes eliminados
        document.getElementById('activeMessagesButton').classList.add('hidden');
        // Mostrar la tabla de mensajes eliminados
        document.getElementById('deletedMessages').classList.remove('hidden');
        // Ocultar la tabla de mensajes activos
        document.getElementById('activeMessages').classList.add('hidden');
    }

    function showActiveMessages() {
        // Mostrar el botón de mensajes eliminados
        document.getElementById('activeMessagesButton').classList.remove('hidden');
        // Mostrar la tabla de mensajes activos
        document.getElementById('activeMessages').classList.remove('hidden');
        // Ocultar la tabla de mensajes eliminados
        document.getElementById('deletedMessages').classList.add('hidden');
    }

    function showMore(event, senderName, senderEmail, message) {
        event.stopPropagation();
        document.getElementById('senderName').textContent = senderName;
        document.getElementById('senderEmail').textContent = senderEmail;
        document.getElementById('message').innerText = message; // Usa innerText en lugar de textContent
        document.getElementById('showMoreModal').classList.remove('hidden');
    }



    function closeShowMoreModal() {
        document.getElementById('showMoreModal').classList.add('hidden');
    }
</script>

>>>>>>> main
@endsection