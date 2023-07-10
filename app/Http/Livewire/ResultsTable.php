<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Builder;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

use App\Models\Result;

class ResultsTable extends DataTableComponent
{
    protected $model = Result::class;

    public function configure(): void
    {
        /* " ->setAdditionalSelects(['user_id as user_id']) " 
        is for a links to the PDF result */
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['user_id as user_id'])
            ->setPerPage(10)
            ->setPerPageAccepted([10, 25, 50, 100]);
    }

    public function columns(): array
    {
        return [
            Column::make('ID Результата', 'id')
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('id'),
            // "format()" is for adding text to <td> element
            Column::make('Баллов', 'score')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) => $row->score . ' / 40'
                )
                ->secondaryHeaderFilter('score'),
            Column::make('Время', 'created_at')
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('created_at'),
            Column::make('Email', 'user.email')
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('email'),
            Column::make('ФИО', 'user.full_name')
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('full_name'),
            Column::make('ИИН', 'user.iin')
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('iin'),
            Column::make('Специальность', 'user.speciality')
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('speciality'),
            LinkColumn::make('Ссылка')
                ->title(fn ($row) => 'Ссылка')
                ->location(fn ($row) => URL::to('/PDFResult/' . $row->id . '/' . $row->user_id))
                ->attributes(function ($row) {
                    return [
                        'target' => '_blank',
                        'class' => 'underline text-blue-500',
                    ];
                }),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('id')
                ->config([
                    'placeholder' => 'ID',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('results.id', 'like', '%' . $value . '%');
                }),
            TextFilter::make('score')
                ->config([
                    'placeholder' => 'Баллов',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('score', 'like', '%' . $value . '%');
                }),
            DateFilter::make('created_at')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('results.created_at', 'like', '%' . $value . '%');
                }),
            TextFilter::make('email')
                ->config([
                    'placeholder' => 'Email',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('email', 'like', '%' . $value . '%');
                }),
            TextFilter::make('full_name')
                ->config([
                    'placeholder' => 'ФИО',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('full_name', 'like', '%' . $value . '%');
                }),
            TextFilter::make('iin')
                ->config([
                    'placeholder' => 'ИИН',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('iin', 'like', '%' . $value . '%');
                }),
            TextFilter::make('speciality')
                ->config([
                    'placeholder' => 'Специальность',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('speciality', 'like', '%' . $value . '%');
                }),
        ];
    }
}
