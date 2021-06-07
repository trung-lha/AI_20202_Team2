@extends('layouts.sidebar')
@section('contents')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Workout</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>   
                            <th>Name</th>
                            <th>Count</th>
                            <th>Times</th>     
                            <th>Date</th>                   
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>   
                            <th>Name</th>
                            <th>Count</th>
                            <th>Times</th>   
                            <th>Date</th>                        
                        </tr>
                    </tfoot>
                    
                    <tbody>
                        @foreach ($exercises as $key => $eItem)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$eItem->name}}</td>   
                            <td>{{$eItem->count}}</td>
                            <td>
                                @if($eItem->time > 60)
                                    {{floor($eItem->time/60)}} mins {{$eItem->time - floor($eItem->time/60)*60}} secs
                                @else
                                    {{$eItem->time}} secs
                                @endif
                            </td>
                            <td>{{$eItem->date}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
</script>