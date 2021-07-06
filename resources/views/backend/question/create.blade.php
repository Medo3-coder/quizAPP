@extends('backend.layouts.master')

	@section('title','create Question')

	@section('content')

    <div class = "span9">

        <div class ="content">

            @if (Session::has('message'))

              <div class="alert alert-success">
                {{ Session::get('message') }}
              </div>

            @endif

            <form action="{{ route('question.store') }}" method="POST">
                @csrf
                <div class ="module">

                    <div class ="module-head">
                        <h3> Create Question </h3>
                    </div>

                    <div class="module-body">

                          {{-- in which quiz i will put this question --}}

                        <div class="control-group">
                            <label class="control-label"> Choose Quiz</label>

                            <div class="controls">

                              <select name="quiz" class="span8">
                                  @foreach (App\Quiz::all() as $quiz )
                                      <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                  @endforeach
                              </select>

                                {{-- Error_Message --}}
                                <div>
                                      @error('quiz')
                                      <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                </div>

                            </div>
                        </div>





                     {{-- Question Name --}}
                      <div class="control-group">
                          <label class="control-label">question Name</label>

                          <div class="controls">
                              <input type="text" name="question" class="span8" placeholder="Name Of question" value="{{ old('question') }}">


                              {{-- Error_Message --}}
                              <div>
                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                              </div>

                          </div>
                      </div>

                      {{-- Question answer Option --}}
                      <div class="control-group">
                        <label class="control-label" for="options">Options</label>

                        <div class="controls">
                            @for ($i = 0 ; $i < 4 ; $i++)

                            <input type="text" name="options[]"
                            class="span7" placeholder="options{{ $i+1 }}"

                             required="">

                             <input type="radio" name="correct_answer" value="{{ $i }}">
                             <span>Is Correct Answer</span>

                            @endfor



                            {{-- Error_Message --}}
                            <div>
                                  @error('options[]')
                                  <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                            </div>

                        </div>
                    </div>


                          <div class="control-group">

                         <div class="controls">
                            <button type="submit" class="btn btn-success"> Submit</button>
                         </div>
                    </div>

                </div>

            </form>





        </div>


    </div>




    @endsection
