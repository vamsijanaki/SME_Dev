<div :wire:key="student-list">
    <div>
        <div
            @if (is_numeric($refresh))
            wire:poll.{{ $refresh }}ms
            @elseif(is_string($refresh))
            @if ($refresh === '.keep-alive' || $refresh === 'keep-alive')
            wire:poll.keep-alive
            @elseif($refresh === '.visible' || $refresh === 'visible')
            wire:poll.visible
            @else
            wire:poll="{{ $refresh }}"
            @endif
            @endif
            class="container-fluid p-0"
        >
            <div class="d-md-flex justify-content-between mb-3">
                <div class="d-md-flex">
                    <div>
                        @include('livewire.partials.org_position_select',compact('positions'))
                    </div>
                </div>
                <div class="d-md-flex">
                    <div>
                        @include('livewire.partials.search')
                    </div>
                </div>
            </div>

            @include('livewire-tables::bootstrap-4.includes.table')
            @include('livewire-tables::bootstrap-4.includes.pagination')
        </div>


    </div>

</div>
