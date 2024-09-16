<style>
    .tree{
        margin: 0 auto; /* Center horizontally */
        width: max-content; /* Adjust width based on content */
        text-align: center;
    }
    .tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #666;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}
</style>

@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.assign_client') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>التسويق بالعمولة</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.assign_client') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card card-Vertical card-default card-md mb-4">
                <div class="card-header">
                    <h6>{{ trans('menu.clients_tree') }}</h6>
                </div>
                <div class="card-body py-md-30">

<div class="container">
    <div class="tree">
        <ul>
            <li>
                
                <a href="#">
                    <i class="fa-solid fa-user fa-2xl"></i>
                    @php
                    $previousName = App\Models\Client::where('id', $assign->previous_client_id)->pluck('name')->first();

                    @endphp
                    <p>{{$previousName}}</p>
                </a>

                <ul>                    
                        
                    
                    @php
                    $existings = App\Models\ClientAttribution::select('existing_client_id')->where('previous_client_id', $assign->previous_client_id)->get();
                    @endphp
                  
                        
                    
                  @foreach ($existings as $existing)
                  @php
                    $exNames = App\Models\Client::where('id', $existing->existing_client_id)->pluck('name');
                    
                  @endphp
                  
                      
                  @foreach ($exNames as $exName)
                  <li>
                      <a href="#">
                          <i class="fa-solid fa-user fa-2xl"></i>
                          <p>{{ $exName }}</p>
                      </a>
                  </li>
                  
                  @endforeach
                  @endforeach

{{-- 
                    <li>
                        <a href="#"><i class="fa-solid fa-user fa-2xl"></i></a>
                        <ul>
                            <ul>
                <li>
                                <a href="#"><i class="fa-solid fa-user fa-2xl"></i></a>
                  <ul>
                <li>
                                <a href="#"><i class="fa-solid fa-user fa-2xl"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-user fa-2xl"></i></a>
                            </li>
                        </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-user fa-2xl"></i></a>
                            </li>
                        </ul>
                        </ul>
                    </li> --}}
                </ul>
            </li>
        </ul>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>

</script>