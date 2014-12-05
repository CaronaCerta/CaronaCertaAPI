<?php

class SortParameters {

    public static function applySort(\Illuminate\Database\Eloquent\Builder $query, $app) {
        $sort_parameters = explode(',', $app->request->get('sort', array()));
        if ($sort_parameters) {
            foreach($sort_parameters as $field) {

                $sort = 'ASC';
                // removing '-' in front of the field name
                if (substr($field, 0, 1) == '-') {
                    $sort = 'DESC';
                    $field = substr($field, 1);
                }
                $query->orderBy($field, $sort);
            }

        }
    }
}
