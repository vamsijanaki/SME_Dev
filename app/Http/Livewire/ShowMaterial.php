<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Modules\Org\Entities\OrgMaterial;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class  ShowMaterial extends DataTableComponent
{
    use WithPagination;

    protected $listeners = ['addBranchFilter', 'selectTypeFilter'];
    public $page = 1;

    protected $materials = [];
    public $branchCodes = [];
    public $type = null;


    public function addBranchFilter($branchCode)
    {
        if (($key = array_search($branchCode, $this->branchCodes)) !== false) {
            unset($this->branchCodes[$key]);
        } else {
            array_push($this->branchCodes, $branchCode);
        }
        $this->emit('checkOrgChart', $this->branchCodes);

    }

    public function selectTypeFilter($type)
    {
        $this->type = $type;

    }

    public function columns(): array
    {
        return [
            Column::make(__('common.SL')),
            Column::make(__('common.Title'))
                ->sortable()
                ->searchable(),
            Column::make(__('common.Category'))
                ->sortable()
                ->searchable(),
            Column::make(__('common.Type'))
                ->sortable()
                ->searchable(),
            Column::make(__('org.Create By'),'user_id')
                ->sortable()
                ->searchable(),
            Column::make(__('common.Status')),
            Column::make(__('org.Create Date'),'created_at')
                ->sortable()
                ->searchable(),
            Column::make(__('common.Action')),
        ];
    }

    public function query()
    {

        $query = OrgMaterial::with('user');
        if (Auth::user()->role_id != 1) {
            $query->where('user_id', Auth::user()->id);
        }
        if (count($this->branchCodes) != 0) {
            foreach ($this->branchCodes as $key => $code) {
                if ($key == 0) {
                    $query->where('category', 'LIKE', "%{$code}%");
                } else {
                    $query->orWhere('category', 'LIKE', "%{$code}%");
                }
            }
        }
//dd($this->type);
        if (!empty($this->type)) {
            $query->where('type', $this->type);
        }
        return $query;
    }

    public function rowView(): string
    {
        $this->emptyMessage= trans("common.No data available in the table");
        return 'livewire.show-material';
    }

    public function paginationView()
    {
        return 'backend.partials._pagination';
    }

}
