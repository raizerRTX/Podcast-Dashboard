<?php

namespace App\Models;

class DataControllerModel{
    
    public static function database() {
        return \Config\Database::connect();
    }

    public static function getTreeData() {
        return DataControllerModel::database()->query(
            "SELECT pt.*, ptr.* FROM podcast_trees_records ptr
            LEFT JOIN podcast_trees pt ON pt.id = ptr.tree_id
            ORDER BY ptr.tree_id ASC"
        );
    }

    public static function getVariantData($variant_type, $month, $year) {
        return DataControllerModel::database()->query(
            "SELECT SUM(pods_num) FROM podcast_trees_history p 
             WHERE to_char(p.last_fertilize, 'YYYY-MM') = '{$year}-{$month}' 
             AND varieties = '{$variant_type}'"
        );
    }

    public static function getTotalBeansStats($month, $year) {
        return DataControllerModel::database()->query(
            "SELECT SUM(expected_yield) FROM podcast_trees_records p 
             WHERE to_char(p.expected_harvest_date, 'YYYY-MM') = '{$year}-{$month}'"
        );
    }

    public static function getTotalPodsStats($month, $year) {
        return DataControllerModel::database()->query(
            "SELECT varieties, pods_num FROM podcast_trees_history p 
             WHERE to_char(p.last_fertilize, 'YYYY-MM') = '{$year}-{$month}'"
        );
    }

    public static function getTotalBeans($year) {
        return DataControllerModel::database()->query(
            "SELECT SUM(expected_yield) total_beans FROM podcast_trees_records p 
             WHERE to_char(p.expected_harvest_date, 'YYYY') = '{$year}'"
        );
    }

    public static function getTotalPods($year) {
        return DataControllerModel::database()->query(
            "SELECT varieties, pods_num FROM podcast_trees_history p 
             WHERE to_char(p.last_fertilize, 'YYYY') = '{$year}'"
        );
    }

    public static function getFullTotalBeans() {
        return DataControllerModel::database()->query(
            "SELECT SUM(expected_yield) total_beans FROM podcast_trees_records"
        );
    }

    public static function getFullTotalPods() {
        return DataControllerModel::database()->query(
            "SELECT varieties, pods_num FROM podcast_trees_history"
        );
    }

    public static function getUnharvestedTrees() {
        return DataControllerModel::database()->query(
            "SELECT DISTINCT(ptr.tree_id), ptr.expected_yield, 
            ptr.expected_harvest_date, pt.* FROM podcast_trees_records ptr
            INNER JOIN podcast_trees pt ON pt.id = ptr.tree_id
            WHERE expected_harvest_date = CURRENT_DATE + 1
            ORDER BY ptr.tree_id ASC"
        );
    }

    public static function getTreeForecast() {
        return DataControllerModel::database()->query(
            "SELECT DISTINCT(ptr.tree_id), ptr.expected_yield, 
            ptr.expected_harvest_date, pt.* FROM podcast_trees_records ptr
            INNER JOIN podcast_trees pt ON pt.id = ptr.tree_id
            ORDER BY ptr.expected_harvest_date DESC"
        );
    }

    public static function getTreeForecastStats($year, $month) {
        return DataControllerModel::database()->query(
            "SELECT DISTINCT(ptr.tree_id), ptr.expected_yield, 
            ptr.expected_harvest_date, pt.* FROM podcast_trees_records ptr
            INNER JOIN podcast_trees pt ON pt.id = ptr.tree_id
            WHERE to_char(expected_harvest_date, 'YYYY-MM') = '{$year}-{$month}'
            ORDER BY ptr.tree_id ASC"
        );
    }

    public static function getFarmers() {
        return DataControllerModel::database()->query(
            "SELECT * FROM users 
            WHERE comments = 'farmer'"
        );
    }

    public static function getTreeStatus() {
        return DataControllerModel::database()->query(
            "SELECT * FROM podcast_trees WHERE modified + 30 < CURRENT_DATE
            ORDER BY modified DESC"
        );
    }

    public static function get_Forecast_PDF() {
        return DataControllerModel::database()->query(
            "SELECT * FROM podcast_trees_records AS ptr
            LEFT JOIN podcast_trees pt ON pt.id = ptr.tree_id
            WHERE ptr.expected_harvest_date > CURRENT_DATE + 1
            ORDER BY ptr.expected_harvest_date ASC"
        );
    }

    public static function get_Survey_Count() {
        return DataControllerModel::database()->query(
            "SELECT * FROM podcast_trees_records AS ptr
            LEFT JOIN podcast_trees pt ON pt.id = ptr.tree_id
            WHERE ptr.created = CURRENT_DATE"
        );
    }

    public static function get_Added_Pods() {
        return DataControllerModel::database()->query(
            "SELECT * FROM podcast_trees_records WHERE created = CURRENT_DATE"
        );
    }

    public static function get_Surveyor_Names() {
        return DataControllerModel::database()->query(
            "SELECT DISTINCT(surveyor_name), tree_id, expected_yield FROM podcast_trees_records WHERE created = CURRENT_DATE"
        );
    }
}
