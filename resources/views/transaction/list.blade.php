@extends('layouts.app', ['page' => __('Transaction List'), 'pageSlug' => 'transaction'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Transactions') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Make Payment') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                            <th scope="col">{{ __('Transaction Reference') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Fee') }}</th>
                            <th scope="col">{{ __('Amount') }}</th>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col"></th>
                            </thead>
                            <tbody>
                            @foreach ($transactions->transactions as $t)
                                <tr>
                                    <td>{{ $t->reference }}</td>
                                    <td>
                                        {{ $transactions->email }}

                                    </td>
                                    <td>
                                        {{ $t->fee->name }}

                                    </td>
                                    <td>
                                        {{ '&#8358;'.number_format($t->total_amount) }}

                                    </td>
                                    <td>{{ Carbon\Carbon::parse($t->created_at)->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                    <form action="" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <a class="dropdown-item" href="">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Print Invoice') }}
                                                        </button>
                                                    </form>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{--{{ $users->links() }}--}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
