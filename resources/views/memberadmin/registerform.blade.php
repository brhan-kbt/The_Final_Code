@extends('memberadmin.dashboard')

@section('content')
<div class="container">
    <div class="row reg-row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-20">
                <div class="card-header fw-bold text-center">Member Registration Form </div>

                <div class="card-body">
                <div class="container">
                  <form action="{{action('MemberController@store')}}" class="fw-bold" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('POST') --}}
                    
                    {{-- {{$errors}} --}}

                        <div class="badge bg-info text-wrap h4 text-dark text-left mb-3 fw-bold font-italic text-decoration-underline">1. Fill Personal Information Below</div>
                   
                    {{-- First row --}}

                    <div class="row m-10">
                        <div class="col-md-4 mb-3  mt-3">
                            <label for="mfullname">Full Name<span class="text-danger">*</span></label>
                            <input type="text"  id="mfullname" class="form-control @error('mfullname') is-invalid @enderror" name="mfullname" value="{{ old('mfullname') }}"  autocomplete="mfullname" autofocus >

                             @error('mfullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                        <div class="col-md-4 mb-3 mt-3">
                            <label for="gfathername">Grand-Father Name<span class="text-danger">*</span></label>
                            <input type="text" name="gfathername" class="form-control  @error('gfathername') is-invalid @enderror" id="gfathername" value="{{ old('gfathername') }}"  autocomplete="gfathername" autofocus placeholder="">

                             @error('gfathername')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                        <div class="col-md-4 mb-3 mt-3">
                                <label for="mothername">Mother's Name<span class="text-danger">*</span></label>
                                <input type="text" name="mothername" class="form-control  @error('mothername') is-invalid @enderror" value="{{ old('mothername') }}"  autocomplete="mothername" autofocus id="mothername" placeholder="">

                                @error('mothername')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>
                    </div>
                    
                        {{-- second rw --}}

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="repetanceFname">Repetance Father Name<span class="text-danger">*</span></label>
                            <input type="text" name="repetanceFname" class="form-control  @error('repetanceFname') is-invalid @enderror" value="{{ old('repetanceFname') }}"  autocomplete="repetanceFname" autofocus  id="repetanceFname" placeholder="">

                            @error('repetanceFname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="baptismalName">Baptismal Name<span class="text-danger">*</span></label>
                            <input type="text" name="baptismalName" class="form-control  @error('baptismalName') is-invalid @enderror" value="{{ old('baptismalName') }}"  autocomplete="baptismalName" autofocus  id="baptismalName" placeholder="">

                            @error('baptismalName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                         <div class="col-md-4 mb-3">
                            <label for="churchBaptized">Church Baptized<span class="text-danger">*</span></label>
                            <input type="text" name="churchBaptized" class="form-control  @error('churchBaptized') is-invalid @enderror" value="{{ old('churchBaptized') }}"  autocomplete="churchBaptized" autofocus  id="churchBaptized" placeholder="">

                            @error('churchBaptized')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>
                         
                    </div>

                    {{-- Third row --}}

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="birthplace">Birth Place<span class="text-danger">*</span></label>
                            <input type="text" name="birthplace" class="form-control @error('birthplace') is-invalid @enderror" value="{{ old('birthplace') }}"  autocomplete="birthplace" autofocus id="birthplace" placeholder="">

                             @error('birthplace')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"  autocomplete="phone" autofocus pattern="[0-9]{10}">

                                 @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                         <div class="col-md-2 mb-3">
                                    <label for="member-age">Age<span class="text-danger">*</span></label>
                                    <input type="number" name="member-age" class="form-control @error('member-age') is-invalid @enderror" value="{{ old('member-age') }}"  autocomplete="member-age" autofocus id="member-age" placeholder="">

                                     @error('member-age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                            </div>

                            <div class="col-md-2 mb-3 align-items-center {{--@error('member-sex') is-invalid @enderror--}}">
                                    <label for="member-sex">Sex<span class="text-danger">*</span></label>
                            <div class="d-flex ">
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input " type="radio" name="member-sex" id="male" value="Male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="member-sex" id="female" value="Female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>


                                
                            </div>
                            @error('member-sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                          @enderror
                            </div>

                    </div>


                    {{-- Fourth Row --}}

                    <div class="row ">
                        <div class="col-8 mb-3">
                            <label for="address">Address<span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"  autocomplete="address" autofocus id="address" cols="" rows=""></textarea>
                        
                            @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        
                        </div>

                        <div class="col-md-4 mb-3">
                                <label for="profileImg">Image<span class="text-danger">*</span></label>
                                <input type="file" name="profileImg" class="form-control @error('profileImg') is-invalid @enderror" value="{{ old('profileImg') }}"  autocomplete="profileImg" autofocus id="profileImg" >
                        
                            @error('profileImg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        
                            </div>
                    </div>

                    
            <div class="badge bg-info text-wrap h4 text-dark text-left mb-3 mt-3 fw-bold font-italic text-decoration-underline">1. Fill Families Information Below</div>

            <table class="table mb-5 ">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Full Name</th>
                        <th class="col-md-2">Age</th>
                        {{-- <th class="col-md-1">Sex</th> --}}
                        <th class="col-md-2">Date of Birth</th>
                        <th class="col-md-2">Relationship</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <tr>
                    <div class="row"> {{--Start row of table--}}
                        <td>1</td>
                        <td>
                            <input type="text" name="familyfullname1[]" class="form-control" id="familyfullname1" placeholder="">
                        </td>

                        <td>
                             <input type="number" name="familyage1[]" class="form-control" id="familyage1" placeholder="">
                        </td>

                        {{-- <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="familysex1[]" id="male" value="Male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="familysex1[]" id="female" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </td> --}}

                        <td>
                            <input type="text" name="familydob1[]" class="form-control " id="familydob1" placeholder="01/01/2022">
                        </td>
                    
                        <td>
                            <select class="form-select" name="relationship[]" aria-label="Default select example">
                            <option selected></option>
                            <option value="Wife">Wife</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            </select>
                        </td>
                        <td><button id="ad_form" type="button" class="btn-primary fa fa-plus"></button></td>
                    </div>{{--End of  row table--}}
                </tr>
                  
                </tbody>
            </table>

              <div class="badge bg-info text-wrap h4 text-dark text-left mb-3 fw-bold font-italic text-decoration-underline">1. Fill Profile Information Below</div>

                {{-- Row for Username and Password --}}
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="username">Username<span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"  autocomplete="username" autofocus id="username" placeholder="">


                         @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                    </div>
                        
                    <div class="col-4 mb-3">
                        <label for="password">Password<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"  autofocus id="password" placeholder="">


                         @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                    </div>
                
                </div>

                    {{-- <div class="row mb-3">
                        <div class="col-6 mb-3">
                        
                        </div>

                        <div class="col-6 ">
                        <label for="Password">Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" id="Password" placeholder="">
                        </div>
                        
                    </div> --}}

                    {{-- Row for Register Button --}}
                <div class="pt-4 text-center">                  
                    <button type="submit" class="btn btn-primary btn-lg h-20">Click Here To Register</button>
                </div>
                    <h5 class="text-left fw-bold">Have an account, <a class=" fw-bold btn btn-link" >Login Here</a></h5> 

                </form>
           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection