@extends('layout.basic')
@section('title', 'Email')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Emails list</h1>
        <!-- Botón para mostrar los mensajes eliminados -->
        <div id="activeMessagesButton">
<<<<<<< HEAD
            <button onclick="showDeletedMessages()" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Deleted
                messages</button>
=======
            <button onclick="showDeletedMessages()" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Deleted messages</button>
>>>>>>> main
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
<<<<<<< HEAD
                    @foreach ($activeEmails as $email)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full overflow-hidden">
                                        <img src="{{ asset('profile/images/' . $email->userProfileImage) }}"
                                            alt="User Image" class="h-8 w-8 rounded-full">
                                        {{ $email->sender_name }}
                                    </div>
                                    <span class="ml-2">{{ $email->sender_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-sm truncate" onclick="openMessageModal('{{ $email->message }}')">
                                {{ $email->message }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="confirmDelete(event, {{ $email->id }})"
                                    style="background-color: #E51C1C"
                                    class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Delete</button>
                                <button onclick="openReplyModal(event, {{ $email->id }})"
                                    style="background-color: #3182CE"
                                    class="text-white px-4 py-2 rounded-md w-32 h-full">Reply</button>
=======
                    @foreach($activeEmails as $email)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $email->sender_name }}</td>
                            <td class="px-6 py-4 max-w-sm truncate" onclick="openMessageModal('{{ $email->message }}')">{{ $email->message }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="confirmDelete(event, {{ $email->id }}) style="background-color: #E51C1C" class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Delete</button>
>>>>>>> main
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
<<<<<<< HEAD
            <button onclick="showActiveMessages()" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Active
                messages</button>
=======
            <button onclick="showActiveMessages()" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Active messages</button>
>>>>>>> main
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
<<<<<<< HEAD
                    @foreach ($deletedEmails as $email)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full overflow-hidden">
                                        <img src="{{ asset('profile/images/' . $email->userProfileImage) }}"
                                            alt="User Image" class="h-8 w-8 rounded-full">
                                        {{ $email->sender_name }}
                                    </div>
                                    <span class="ml-2">{{ $email->sender_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-sm truncate" onclick="openMessageModal('{{ $email->message }}')">
                                {{ $email->message }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('restore.message', ['id' => $email->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background-color: #4CAF50"
                                        class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Restore</button>
=======
                    @foreach($deletedEmails as $email)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $email->sender_name }}</td>
                            <td class="px-6 py-4 max-w-sm truncate" onclick="openMessageModal('{{ $email->message }}')">{{ $email->message }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('restore.message', ['id' => $email->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background-color: #4CAF50" class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Restore</button>
>>>>>>> main
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
<<<<<<< HEAD
                    <button type="submit" style="background-color: #E51C1C"
                        class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Yes, delete</button>
                </form>
                <button onclick="closeModal()" style="background-color: #3d3c3b"
                    class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Cancel</button>
=======
                    <button type="submit" style="background-color: #E51C1C" class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Yes, delete</button>
                </form>
                <button onclick="closeModal()" style="background-color: #3d3c3b" class="text-white px-4 py-2 rounded-md mr-2 w-32 h-full">Cancel</button>
>>>>>>> main
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <div id="replyModal" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center">
        <div class="absolute inset-0 bg-gray-800 bg-opacity-50"></div> <!-- Fondo con opacidad -->
        <div class="bg-white p-8 rounded shadow-md max-w-2xl overflow-y-auto z-10 mt-20">
            <!-- Contenedor de contenido con margen superior -->
            <div class="flex justify-end">
                <button onclick="closeReplyModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <form id="replyForm" action="{{ route('reply.message') }}" method="POST">
                @csrf
                <input type="hidden" id="replyToId" name="reply_to_id">
                <label for="replyMessage" class="block mb-2">Message:</label>
                <textarea id="replyMessage" name="reply_message" rows="4"
                    class="w-full border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"></textarea>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md mr-2">Send</button>
                    <button type="button" onclick="closeReplyModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="messageModal" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center">
        <div class="absolute inset-0 bg-gray-800 bg-opacity-50"></div> <!-- Fondo con opacidad -->
        <div class="bg-white p-8 rounded shadow-md max-w-2xl overflow-y-auto z-10 mt-20">
            <!-- Contenedor de contenido con margen superior -->
=======
    <div id="messageModal" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center">
        <div class="absolute inset-0 bg-gray-800 bg-opacity-50"></div> <!-- Fondo con opacidad -->
        <div class="bg-white p-8 rounded shadow-md max-w-2xl overflow-y-auto z-10 mt-20"> <!-- Contenedor de contenido con margen superior -->
>>>>>>> main
            <div class="flex justify-end">
                <button onclick="closeMessageModal()" class="text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div id="messageContent" class="max-h-96 overflow-y-auto" style="word-wrap: break-word;"></div>
        </div>
    </div>
<<<<<<< HEAD
=======
    
    
    
    
>>>>>>> main

    <script>
        function confirmDelete(event, id) {
            event.stopPropagation();
            document.getElementById('deleteModal').classList.remove('hidden');
            // Configurar la acción del formulario para enviar el id del mensaje
            document.getElementById('deleteForm').action = `/messagesDelete/${id}`;
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

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
<<<<<<< HEAD

        function openReplyModal(event, id) {
            event.stopPropagation();
            document.getElementById('replyToId').value = id;
            document.getElementById('replyModal').classList.remove('hidden');
        }

        function closeReplyModal() {
            document.getElementById('replyModal').classList.add('hidden');
        }
=======
>>>>>>> main
    </script>

@endsection
