{{-- resources/views/filament/pages/cookies.blade.php --}}
<x-filament-panels::page>
    {{ $this->form }}

    <x-filament-actions::actions :actions="$this->getFormActions()" class="mt-4" />
</x-filament-panels::page>
