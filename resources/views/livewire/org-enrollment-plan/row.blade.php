<div>
    <div>
        <div>
            <style>

                .QA_section.check_box_table .QA_table .table thead tr th:first-child, .QA_section.check_box_table .QA_table .table thead tr th {
                    padding-left: 12px !important;
                }

                .QA_section .QA_table .table thead th {
                    vertical-align: middle !important;
                }

            </style>
            <td><input type="checkbox" id="plan{{$row->id}}"
                       data-student="{{$row->id}}"
                       class=" singlePlan common-checkbox plan{{$row->id}}"
                       value="{{$row->id}}" name="plans[]">
                <label for="plan{{$row->id}}" class="mt-2"></label>
            </td>

            <x-livewire-tables::bs4.table.cell>
                {{$row->title}}
            </x-livewire-tables::bs4.table.cell>

            <x-livewire-tables::bs4.table.cell>
                {{$row->price}}
            </x-livewire-tables::bs4.table.cell>

            <x-livewire-tables::bs4.table.cell>
                {{$row->about}}
            </x-livewire-tables::bs4.table.cell>


            <x-livewire-tables::bs4.table.cell>
                {{$row->join_date}}
                {{$row->join_time}}
            </x-livewire-tables::bs4.table.cell>
            <x-livewire-tables::bs4.table.cell>
                {{$row->end_date}}
                {{$row->end_time}}
            </x-livewire-tables::bs4.table.cell>

            <x-livewire-tables::bs4.table.cell>
                {{$row->duration}}
            </x-livewire-tables::bs4.table.cell>

            <x-livewire-tables::bs4.table.cell>
                {{$row->type==1?'Class':'Leaning Path'}}
            </x-livewire-tables::bs4.table.cell>


        </div>

    </div>

</div>
