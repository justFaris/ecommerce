@extends('layouts.app')
 @section('title','Phone')
 @section('content')
     
     <div class="container">
       <div class="row">

  
        @foreach ($phones as $p)
        <div class="card col-5  mx-1 my-1" >
          
          <div class="card-header bg-secondary" >
            <h1 class="text-center text-white" >{{$p->Name}}</h1>
          </div>
        
           <div class="card-body border-1">
             <div class="row">
                <div class="col-sm-6">
                 <img class="mx-auto d-block" src="{{$p->Img}}" height="140px">
                </div>

                <div class="col-sm-3">
                 <small class=" mx-2 text-primary">{{$p->Display}}</small>
                </div>

                <div class="col-sm-3">
                  <h4 class="text-danger">{{$p->Price}}
                    SR<br>
                    <small class="text-black "><s>{{$p->oldPrice}}</s> SR</small> </h4>
                    <hr>
                    <br>
                    <a class="btn bg-secondary text-white float-end" href="{{ route('add_to_cart', $p->id) }}">Add to  cart</a>
                </div>
             </div>
           </div>

          </div> 
        @endforeach
      </div>
     </div>
    
@endsection