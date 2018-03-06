<?php

namespace App\DataTables;

use App\Admin;
use Yajra\DataTables\Services\DataTable;

class AdminDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('edit', 'admin.admins.btn.edit')
			->addColumn('delete', 'admin.admins.btn.delete')
			->rawColumns([
				'edit',
				'delete',
			]);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query() {
		return Admin::query();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
		            ->columns($this->getColumns())
			->minifiedAjax()
		//->addAction(['width' => '80px'])
		//->parameters($this->getBuilderParameters());
			->parameters([
				'dom'        => 'Blfrtip',
				'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, trans('admin.all_record')]],
				'buttons'    => [
					['text'     => '<i class="fa fa-plus"></i> '.trans('admin.create_admin'), 'className'     => 'btn btn-info'],
					['extend'   => 'print', 'className'   => 'btn btn-primary', 'text'   => '<i class="fa fa-print"></i>'],
					['extend'   => 'csv', 'className'   => 'btn btn-info', 'text'   => '<i class="fa fa-file"></i> '.trans('admin.ex_csv')],
					['extend'   => 'excel', 'className'   => 'btn btn-success', 'text'   => '<i class="fa fa-file"></i> '.trans('admin.ex_excel')],
					['extend'   => 'reload', 'className'   => 'btn btn-default', 'text'   => '<i class="fa fa-refresh"></i>'],

				],
				'initComplete' => " function () {
		            this.api().columns([0,1,2,3,4]).every(function () {
		                var column = this;
		                var input = document.createElement(\"input\");
		                $(input).appendTo($(column.footer()).empty())
		                .on('keyup', function () {
		                    column.search($(this).val(), false, false, true).draw();
		                });
		            });
		        }",

				'language'         => [
					'sProcessing'     => trans('admin.sProcessing'),
					'sLengthMenu'     => trans('admin.sLengthMenu'),
					'sZeroRecords'    => trans('admin.sZeroRecords'),
					'sEmptyTable'     => trans('admin.sEmptyTable'),
					'sInfo'           => trans('admin.sInfo'),
					'sInfoEmpty'      => trans('admin.sInfoEmpty'),
					'sInfoFiltered'   => trans('admin.sInfoFiltered'),
					'sInfoPostFix'    => trans('admin.sInfoPostFix'),
					'sSearch'         => trans('admin.sSearch'),
					'sUrl'            => trans('admin.sUrl'),
					'sInfoThousands'  => trans('admin.sInfoThousands'),
					'sLoadingRecords' => trans('admin.sLoadingRecords'),
					'oPaginate'       => [
						'sFirst'         => trans('admin.sFirst'),
						'sLast'          => trans('admin.sLast'),
						'sNext'          => trans('admin.sNext'),
						'sPrevious'      => trans('admin.sPrevious'),
					],
					'oAria'            => [
						'sSortAscending'  => trans('admin.sSortAscending'),
						'sSortDescending' => trans('admin.sSortDescending'),
					],

				],

			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			[
				'name'  => 'id',
				'data'  => 'id',
				'title' => 'ID',
			], [
				'name'  => 'name',
				'data'  => 'name',
				'title' => 'Admin Name',
			], [
				'name'  => 'email',
				'data'  => 'email',
				'title' => 'Admin Email',
			], [
				'name'  => 'created_at',
				'data'  => 'created_at',
				'title' => 'created at',
			], [
				'name'  => 'updated_at',
				'data'  => 'updated_at',
				'title' => 'updated at',
			], [
				'name'       => 'edit',
				'data'       => 'edit',
				'title'      => 'Edit',
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			], [
				'name'       => 'delete',
				'data'       => 'delete',
				'title'      => 'Delete',
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			],

		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Admin_'.date('YmdHis');
	}
}
