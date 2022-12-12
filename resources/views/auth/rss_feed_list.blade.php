@extends('auth.feed_layout')
@section('content')
@if(session()->has('message'))
    <div class="alert alert-dismissable alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session()->get('message') }}
    </div>
@endif


    <!-- Events Start -->
    <section class="white-paddings">
        <div class="container">
            <div class="row">
            <div class="col-12">
                    <div class="common-heading text-center">
                        <h4>Welcome {{Auth::user()->name}} you have {{$count}} feeds</h4>
                    </div>
                </div>

               
                <div class="col-12 mainList"> <div class="row toprow">

                @php
             $i=1;
             @endphp
             @if(!empty($feeds))
             @foreach($feeds as $fed)
             
                  <div class="eventsDivs col-md-4 col-sm-6 detail_div"  data-id="{{$i}}" tabindex="0">
                    <div class="eventsList">
                      <div class="listconts">
                        <h5 class="titleSpace limits">{{$fed->title}}</h5>
                        <p class="descp">
                        {{$fed->description}}
                        </p>
                        <div class="row">
                         
                          <div class="col-lg-12">
                             <button id="button_{{$i}}" style="display:none;" class="addittineryBtn float-left" type="button"><a style="color: white;" target="_blank" href="{{$fed->links}}">View detail</a></button> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- list --->
                  @php
             $i++;
             @endphp
       @endforeach
       @endif

            
              


                </div> </div>
            </div>
        </div>
    </section>
      
   @endsection