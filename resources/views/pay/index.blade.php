@extends('layouts.app', ['page' => __('Pay'), 'pageSlug' => 'pay'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Pay') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('transaction.list') }}" class="btn btn-sm btn-primary">{{ __('Show Transactions') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('pay') }}" autocomplete="off">
                            {{csrf_field()}}

                            <h6 class="heading-small text-muted mb-4">{{ __('Make Payment') }}</h6>
                            @include('alerts.success')
                            @include('alerts.error')
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('fee') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Fee') }}</label>
                                    <select type="text" name="fee" id="fee_id"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"   required autofocus>
                                    <option>---------------please select the fee -------------------</option>
                                        @foreach($fees as $f)
                                            <option value="{{$f->id}}">{{$f->name}}</option>
                                            @endforeach

                                    </select>
                                    @include('alerts.feedback', ['field' => 'fee'])
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">{{ __('Total Amount') }}</label>
                                    <input type="text" name="total_amount" id="total_amount" class="form-control form-control-alternative"  value="" disabled>

                                </div>
                                <input type="hidden" name="email" value="{{auth()->user()->email}}"> {{-- required --}}
                                <input type="hidden" name="student_id" id="student_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="amount" id="total_amount1" value=""> {{-- required in kobo --}}
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="metadata" id="metadata" value="{{ json_encode($array = ['student_id' => auth()->user()->id]) }}" >{{-- For other necessary things you want to add to your payload. it is optional though --}}
                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}">



                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Pay Now!') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
