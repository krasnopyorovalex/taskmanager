@extends('layouts.app')
@section('title', 'Verify E-Mail address')

@section('content')
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-bold">Thank you for registering with Ticketgroup!</h3>
                                </div>

                                <div class="panel-body">
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            A new confirmation link has been sent to your email address.
                                        </div>
                                    @endif

                                    <p>Please wait until your account is activated. Ticketgroup will contact you by email. If you have any questions, please contact us.</p>
                                    <p>If you have not received the letter</p>
                                    <form action="{{ route('verification.resend') }}" method="post">
                                        @csrf
                                        <button type="submit">click here to request another letter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
@endsection
