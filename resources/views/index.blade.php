<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact form</title>
    <link rel="stylesheet" href="{{url('/')}}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{url('/')}}/assets/css/style.css" />
  </head>
  <body>
    <div class="container">

      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="form-box">
            <h1>Book Now!</h1>

            <form method="post" action="{{ route('book.store')  }}">
            {{ csrf_field() }}
              <div class="form-group">
                <input class="form-control @error('Name') is-invalid @enderror" id="name" type="text" name="Name" placeholder="Full Name" value="{{ old('Name') }}"/>
                @error('Name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>


              <div class="form-group">
                <input class="form-control @error('Email') is-invalid @enderror" id="email" type="email" name="Email" placeholder="Email" value="{{ old('Email') }}"
                />
                @error('Email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <input  class="form-control @error('Phone') is-invalid @enderror" id="phone" type="phone" name="Phone" placeholder="Phone" value="{{ old('Phone') }}"
                />
                @error('Phone')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>


              <div class="form-group">
                <div class="dropdown">
                  <select name = 'type' class="@error('type') is-invalid @enderror">
                    <option selected disabled>Choose your room</option>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                      @foreach($types as $type)
                        <option class="dropdown-item" value = '{{$type->id}}'>
                          {{$type->type_name}}
                        </option>
                      @endforeach
                    </div>
                  </select>

                  @error('type')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror

                </div>
              </div>

              <div class="form-group">
                <label for="arrival ">Arrival date</label>
                <input class="form-control @error('Arrival') is-invalid @enderror" id="StartDate" type="date" name="Arrival" value="{{ old('Arrival') }}"
                />

                @error('Arrival')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror

              </div>



              <div class="form-group">
                <label for="departure">Departure date</label>
                <input class="form-control  @error('Departure') is-invalid @enderror" id="EndDate" type="date" name="Departure" placeholder="" value="{{ old('Departure') }}"
                />
                @error('Departure')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <input class="form-control @error('PersonNumber') is-invalid @enderror" id="personNumber" min = "1"  max = "4" type="number" name="PersonNumber" placeholder="Count of persons"  value="{{ old('PersonNumber') }}"
                />
                @error('PersonNumber')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
               <button type="submit" class="btn btn-primary">Create book</button>
            </form>

          </div>
        </div>
        <!-- end form  -->

        <div class="col-md-6 col-sm-12 mt-lg-3">

          <div class="text-center mt-lg-3 mb-lg-3">
            <div class="alert alert-info" role="alert">
              Total of Booking : <span style="font-weight: bold;">{{$books_num}}</span>
            </div>
          </div>

          <div class="accordion" id="accordionExample">
            @foreach($books as $book)
            <div class="card">
              <div class="card-header" id="heading{{$book->id}}">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" 
                    data-toggle="collapse" data-target="#collapse{{$book->id}}"
                    aria-expanded="true" aria-controls="collapse{{$book->id}}">
                    Booking #{{$book->id}}
                  </button>
                </h2>
              </div>

              <div id="collapse{{$book->id}}" class="collapse" aria-labelledby="heading{{$book->id}}"
                data-parent="#accordionExample">

                <div class="card-body">
                  <ul class="list-group">
                    <li class="list-group-item">Full Name: {{$book->name}}</li>
                    <li class="list-group-item">Email: {{$book->email}}</li>
                    <li class="list-group-item">Phone: {{$book->number}}</li>
                    <li class="list-group-item">Date of arrival: {{$book->arrival_date}}</li>
                    <li class="list-group-item">Date of departcher: {{$book->departure_date}}</li>

                    <?php

                      $to = \Carbon\Carbon::createFromFormat('Y-m-d', $book->departure_date);
                      $from = \Carbon\Carbon::createFromFormat('Y-m-d', $book->arrival_date);
                      $diff_in_days = $to->diffInDays($from);

                      ?>

                    <li class="list-group-item">Number of persons: {{$book->count_person}}</li>
                    <li class="list-group-item">Price: 
                      @if($book->count_person == 1)
                       {{$book->roomtype->price}}
                      @elseif ($book->count_person == 2)
                        {{$book->roomtype->price +( $book->roomtype->price  * 0.15) * $diff_in_days }}
                      @elseif ($book->count_person == 3)
                        {{ $book->roomtype->price +($book->roomtype->price * 0.3) * $diff_in_days }}
                      @elseif ($book->count_person == 4)
                        {{ $book->roomtype->price + ( $book->roomtype->price * 0.45) * $diff_in_days}}
                      @endif
                    </li>
                  </ul>
                </div>

              </div>
            </div>

            @endforeach
          </div> <!-- accordion -->


        </div>
      </div>
    </div>
    <script src="{{url('/')}}/assets/js/jquery-3.5.1.min.js"></script>
    <script src="{{url('/')}}/assets/js/popper.min.js"></script>
    <script src="{{url('/')}}/assets/js/bootstrap.min.js"></script>
    
  </body>
</html>
