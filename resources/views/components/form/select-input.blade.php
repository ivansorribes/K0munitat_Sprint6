<div>
    <label for="selectInput">Selecciona una opción:</label>
    <select id="selectInput" name="selectInput" wire:model="selected">
        <option value="" disabled>Selecciona...</option>
        @foreach ($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>

    @if ($selected)
        <p>Seleccionaste: {{ $selected }}</p>
    @endif
</div>
