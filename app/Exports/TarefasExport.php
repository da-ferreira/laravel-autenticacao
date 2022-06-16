<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return auth()->user()->tarefas()->get();
    }

    /**
     * Titulos de cabeçalho para importação.
     *
     * Cada item no array retornado representa o título de uma determinada coluna
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID da tarefa',
            'Tarefa',
            'Data limite de conclusão',
        ];
    }

    /**
     * Intecepta/manipula as informações de exportação linha a linha.
     *
     * @param  mixed  $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->tarefa,
            date('d/m/Y', strtotime($row->data_limite_conclusao)),

            // É possível adicionar mais valores, sem eles estarem na tabela de tarefas
            // 'Informação teste',
        ];
    }
}
