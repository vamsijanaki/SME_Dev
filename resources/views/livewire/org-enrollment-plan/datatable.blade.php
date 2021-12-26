<div  :wire:key="plan-list">
    <div>
        <div

            class="container-fluid p-0"
        >
            <div class="d-md-flex justify-content-between mb-3">
                <div class="d-md-flex">
                    <div>
                        @include('livewire.partials.org_plan_select')
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
