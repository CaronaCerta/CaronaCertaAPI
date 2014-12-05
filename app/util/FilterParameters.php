<?php

class FilterParameters {

    public static function applyFilter(\Illuminate\Database\Eloquent\Builder $query, $app) {
        $filter_parameters = $app->request->get(null, array());
        unset($filter_parameters['sort']);
        if ($filter_parameters) {
            foreach($filter_parameters as $field => $value) {
                $query->where($field, '=', $value);
            }
        }
    }
}
