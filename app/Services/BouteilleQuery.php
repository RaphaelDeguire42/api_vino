<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


    class BouteilleQuery {
        protected $champsPermis = [
            'id' => ['eq'],
            'nom' => ['eq', 'lk'],
            'prix' => ['eq', 'gt', 'lt', 'lte', 'gte'],
            'id_format' => ['eq'],
            'id_pays' => ['eq'],
            'id_type' => ['eq'],
        ];

    protected $operateursMap = [
        'eq'    => '=',
        'lt'    => '<',
        'lte'   => '<=',
        'gt'    => '>',
        'gte'   => '>=',
        'lk'    => 'like',
    ];

    public function transform(Request $request){
        $eloquentArray = [];

        foreach ($this->champsPermis as $col => $operators) {
            $query = $request->query($col);
            
            if(!isset($query)) { continue; }
           
            $column = $col;

            foreach ($operators as $operator){
                if ((isset($query[$operator]) && ($operator) === 'lk')){
                    
                    $eloquentArray[] = [$column, $this->operateursMap[$operator], "%" . $query[$operator] . "%"];
                
                }else if (isset($query[$operator])) 
                {
                    $eloquentArray[] = [$column, $this->operateursMap[$operator], $query[$operator]];
                }
            }

        }

        var_dump($eloquentArray);
        return $eloquentArray;
}



    }



