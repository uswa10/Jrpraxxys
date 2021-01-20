@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="well">

                                   {!! Form::open(['action' => 'App\Http\Controllers\PostController@store', 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                                  <h4>What are you doing?</h4>
                                   <div class="form-group" style="padding:14px;">

                                      {{Form::textarea('post','',['class'=>'form-control', 'placeholder'=>'Update your status', 'rows' => 3, 'cols' => 40 ])}}
                                      <br>
                                        {{Form::file('cover_image')}}
                                        <br> <br>
                                      {{Form::submit('Post', ['class' => 'btn btn-primary'])}}
                                  </div>

                                  {!! Form::close()!!}

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                            <br>
                            @if(count($posts) > 0)
                            @foreach ($posts as $posts)
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                        <div class="card-header"></div>

                                          <div class="card-body">

                            <div class="panel panel-default">


                                <div class="panel-heading"> <h4>{{$posts->name}}</h4></div>

                                 <div class="panel-body">
                                    <p hidden><small> {{$posts->id}}</small> </p>
                                      <p><small> {{ \Carbon\Carbon::parse($posts->created_at)->diffForHumans() }}</small> </p>

                                   <div class="clearfix"></div>
                                   <hr>
                                   <div class="panel-body">
                                     <img style ="width: 100%" src="/storage/cover_image/{{$posts->cover_image}}" alt="">
                                   </div>
                                   <p><h3>{{$posts->post}}</h3></p>

                                   <hr>

                                        {!! Form::open(['action' => ['App\Http\Controllers\PostController@update',$posts->id], 'method' => 'POST']) !!}
                                        {{Form::hidden('status', '1')}}
                                        @if($posts->status =='0')
                                        {{Form::submit('Like', ['class' => 'btn btn-like'])}}
                                          @else
                                        {{Form::submit('You liked this post', ['class' => 'btn btn-like'])}}
                                          @endif

                                     {{Form::hidden('_method', 'PUT')}}
                                     {!! Form::close()!!}
                                     
                                   <p>Comments:</p>
                                   @if(count($comments) > 0)
                                   @foreach ($comments as $comments)

                                         <hr>

                                        <p>{{$comments->name}}: {{$comments->comments}}</p>
                                         <hr>
                                   @endforeach
                                  @endif


                                   <hr>






                                   <div class="input-group">
                                     <div class="input-group-btn">

                                     </div>
                                           {!! Form::open(['action' => 'App\Http\Controllers\CommentController@store', 'method' => 'POST']) !!}
                                           {{Form::text('comments','',['class'=>'form-control', 'placeholder'=>'Add a comment'])}}
                                           {{ Form::hidden('post_id', $posts->id) }}

                                           <br>
                                           {{Form::submit('Comment', ['class' => 'btn btn-primary'])}}
                                           {!! Form::close()!!}


                                   </div>



                                 </div>

                                 </div>
                               </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
                @endif




@endsection
