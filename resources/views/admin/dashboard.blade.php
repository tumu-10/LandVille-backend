@extends('layouts.master')

@section('content')

                <!--Page header-->
                <div class="page-header">
                    <div class="page-leftheader">
                        <h4 class="page-title"> &nbsp&nbsp&nbsp  <b>Tree Clinic Dashboard</b></h4>
                    </div>
                    <!--<div class="page-rightheader ml-auto d-lg-flex d-none">
                        <div class="ml-5 mb-0">
                            <a class="btn btn-white date-range-btn" href="#" id="daterange-btn">
                                <svg class="header-icon2 mr-3" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path d="M5 8h14V6H5z" opacity=".3"/><path d="M7 11h2v2H7zm12-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2zm-4 3h2v2h-2zm-4 0h2v2h-2z"/>
                                </svg> <span>Select Date
                                <i class="fa fa-caret-down"></i></span>
                            </a>
                        </div>
                    </div> -->
                </div>
                <!--End Page header-->

               @yield('content')
                

            </div>
        </div><!-- end app-content-->
    </div>

   
@endsection