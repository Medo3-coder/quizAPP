@extends('backend.layouts.master')

	@section('title','create quiz')

	@section('content')

    <div class = "span9">

        <div class ="content">

            @if (Session::has('message'))

              <div class="alert alert-success">
                {{ Session::get('message') }}
              </div>

            @endif

            <form action="{{ route('quiz.store') }}" method="POST">
                @csrf
                <div class ="module">

                    <div class ="module-head">
                        <h3> Create Quiz </h3>
                    </div>

                    <div class="module-body">
                     {{-- Quiz Name --}}
                      <div class="control-group">
                          <label class="control-label">Quiz Name</label>

                          <div class="controls">
                              <input type="text" name="name" class="span8" placeholder="Name Of Quiz" value="{{ old('name') }}">



                              {{-- Error_Message --}}
                              <div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                              </div>

                          </div>


                       {{-- Quiz Description --}}

                         <label class="control-label">Quiz Description</label>

                         <div class="controls">
                            <textarea name="description" class="span8">{{old('description')}}</textarea>

                             {{-- Error_Message --}}
                           <div>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                           </div>

                         </div>


                         {{-- Minutes Of Quiz --}}

                         <label class="control-label"> Minutes</label>
                         <div class="controls">
                             <input type="text" name="minutes" class="span8"  value="{{ old('minutes') }}" >

                             {{-- Error_Message --}}
                             <div>
                                @error('minutes')
                                <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                         </div>

                         <div class="controls">
                            <button type="submit" class="btn btn-success"> Submit</button>
                         </div>


                    </div>

                </div>

            </form>





        </div>


    </div>




    @endsection
