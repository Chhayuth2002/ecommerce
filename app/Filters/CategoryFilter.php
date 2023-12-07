<?php

namespace App\Filters;

use Illuminate\Http\Request;

class CategoryFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        '' => ['eq'],
        'name' => ['eq'],
        'name' => ['eq'],
    ];
    protected $columnMap = [];
    protected $operatorMap = [];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
