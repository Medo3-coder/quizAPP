@extends('backend.layouts.master')

	@section('title','Update Question')

	@section('content')

    <div class = "span9">

        <div class ="content">

            @if (Session::has('message'))

              <div class="alert alert-success">
                {{ Session::get('message') }}
              </div>

            @endif

            <form action="{{ route('question.update',[$question->id]) }}" method="POST">
                @csrf

                {{ method_field('PUT') }}
                <div class ="module">

                    <div class ="module-head">
                        <h3> Update Question </h3>
                    </div>

                    <div class="module-body">

                          {{-- in which quiz i will put this question --}}

                        <div class="control-group">
                            <label class="control-label"> Choose Quiz</label>

                            <div class="controls">

                              <select name="quiz" class="span8">
                                  @foreach (App\Quiz::all() as $quiz )
                                      <option value="{{ $quiz->id }}"
                                        @if ($quiz->id == $question->quiz_id)
                                        selected
                                      @endif>
                                      {{ $quiz->name }}
                                    </option>
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
                              <input type="text" name="question" class="span8" placeholder="Name Of question" value="{{ $question->question }}">


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

                            @foreach ($question->answers as $key=>$answer )



                            <input type="text" name="options[]"
                            class="span7"
                            value="{{ $answer->answer }}"

                             required="">

                             <input type="radio" name="correct_answer" value="{{ $key }}"
                             @if ($answer->is_correct)
                             {{ 'checked' }}
                             @endif
                             >
                             <span>Is Correct Answer</span>

                             @endforeach



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
