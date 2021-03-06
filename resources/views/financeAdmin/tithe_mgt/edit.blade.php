@extends('financeAdmin.dashboard')
@section('content')
   
<main class="container">

    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Tithe Data</h1>
                </div>
                <div class="card-body">
                    <form action="{{action('TitheController@update',$tithe->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="memberName" class="form-label">Member Name</label>
                                        <input type="text" name="memberName" class="form-control @error('memberName') is-invalid @enderror" value="{{$tithe->memberName }}"  autocomplete="memberName" autofocus id="memberName">
                                        
                                        @error('memberName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="col-md-4 offset-md-2">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ $tithe->date }}"  autocomplete="date" autofocus id="date">
                                    
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $tithe->phone }}"  autocomplete="phone" autofocus  id="phone">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                              

                                <div class="col-md-4 offset-md-2">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{$tithe->amount}}"  autocomplete="amount" autofocus id="amount">
                                    
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn-lg btn-primary float-right">Save Change</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>


@endsection
