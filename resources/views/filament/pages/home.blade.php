{{-- resources/views/filament/pages/home.blade.php --}}
<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}
        <x-filament-actions::actions :actions="$this->getFormActions()" class="mt-4" />
    </x-filament-panels::form>
</x-filament-panels::page>
