<?php

class SortParameters {

    public static function applySort(\Illuminate\Database\Eloquent\Builder $query, $app) {
        $sort = $app->request->get('sort', '');
        if ($sort) {
            $sort_parameters = explode(',', $sort);
            print_r($sort_parameters);
            die;
            if ($sort_parameters) {
                foreach ($sort_parameters as $field) {

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
}
