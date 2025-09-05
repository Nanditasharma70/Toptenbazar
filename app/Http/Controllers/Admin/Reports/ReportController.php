<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function categorySalesIndex()
    {
        return view('admin.pages.reports.categorySales.index');
    }
     public function orderReportIndex()
    {
        return view('admin.pages.reports.orderReports.index');
    }
     public function deliveryStatusIndex()
    {
        return view('admin.pages.reports.deliveryStatus.index');
    }
     public function productSalesIndex()
    {
        return view('admin.pages.reports.productSales.index');
    }
}
