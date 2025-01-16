<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
use Encore\Admin\Grid;
use Encore\Admin\Form;

Encore\Admin\Form::forget(['map', 'editor']);
\Encore\Admin\Grid\Exporter::extend('AppCsvExporter', \App\Admin\Grid\Exporters\CsvExporter::class);

Grid::init(function (Grid $grid) {
    $grid->filter(function(Grid\Filter $filter){
//        $filter->disableIdFilter();
    });

});

Form::init(function (Form $form){
    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
    });
//    $form->footer(function ($footer) {
//        $footer->disableViewCheck();
//        $footer->disableEditingCheck();
//        $footer->disableCreatingCheck();
//    });
});

if(!empty(Admin::user()->id)){
    define('ADMIN_ID',Admin::user()->id);
}

