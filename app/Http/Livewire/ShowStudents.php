<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ShowStudents extends DataTableComponent
{
    use WithPagination;

    protected $listeners = ['addBranchFilter', 'addPositionFilter'];
    public $page = 1;
    protected $students = [];
    public $branchCodes = [];
    public $position = null;


    public function addBranchFilter($branchCode)
    {
        if (($key = array_search($branchCode, $this->branchCodes)) !== false) {
            unset($this->branchCodes[$key]);
        } else {
            array_push($this->branchCodes, $branchCode);
        }
        $this->emit('checkOrgChart', $this->branchCodes);

    }

    public function addPositionFilter($position)
    {
        $this->position = $position;

    }


    public function columns(): array
    {
        return [
            Column::make('all'),
            Column::make(__('common.SL')),
            Column::make(__('common.Name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('org.Org Chart'), 'org_chart_code')
                ->sortable()
                ->searchable(),

            Column::make(__('org.Position'), 'org_position_code')
                ->sortable()
                ->searchable(),

            Column::make(__('org.Employee ID'), 'employee_id')
                ->sortable()
                ->searchable(),
            Column::make(__('common.Email'), 'email')
                ->sortable()
                ->searchable(),
            Column::make(__('common.Date of Birth'), 'dob')
                ->sortable()
                ->searchable(),

            Column::make(__('common.gender'), 'gender')
                ->sortable()
                ->searchable(),

            Column::make(__('org.Start working date'), 'start_working_date')
                ->sortable()
                ->searchable(),

            Column::make(__('common.Phone'), 'phone')
                ->sortable()
                ->searchable(),

            Column::make(__('common.Status'))
                ->sortable()
        ];
    }

    public function query()
    {
        $query = User::where('role_id', 3)->where('teach_via', 1)->with('position', 'branch');
        if (count($this->branchCodes) != 0) {
            foreach ($this->branchCodes as $key => $code) {
                if ($key == 0) {
                    $query->where('org_chart_code', 'LIKE', "%{$code}%");
                } else {
                    $query->orWhere('org_chart_code', 'LIKE', "%{$code}%");

                }
            }
        }

        if (!empty($this->position)) {
            $query->where('org_position_code', $this->position);
        }
        return $query;
    }

    public function rowView(): string
    {
        $this->emptyMessage = trans("common.No data available in the table");
        return 'livewire.show-students';
    }

    public function paginationView()
    {
        return 'backend.partials._pagination';
    }

}
