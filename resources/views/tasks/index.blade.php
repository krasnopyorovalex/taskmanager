@extends('layouts.app')

@section('content')

    <div class="content-wrapper">

        <div class="card">

            <div class="card-body table-responsive p-0">

                <table class="table  m-0">
                    <thead>
                    <tr>
                        <th scope="col" width="1" class="border-top-0">#</th>
                        <th scope="col" class="border-top-0">Название</th>

                        <th scope="col" class="border-top-0">Статус</th>
                        <th scope="col" class="border-top-0">Avg. Session</th>
                        <th scope="col" class="border-top-0 text-right">Username</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td class=" align-middle text-center">
                                <span class="user-initials bg-success-light25 text-success">{{ $loop->index + 1 }}</span>
                            </td>
                            <td class="align-middle">
                                <small class="text-muted weight-300">{{ $task->initiator->name }}</small>
                                <div><a href="{{ route('tasks.show', $task) }}" class="weight-400">{{ $task->name }}</a></div>
                            </td>
                            <td class="align-middle">
                                <small class="text-muted weight-300">New York</small>
                                <div class="weight-400">{{ $task->status }}</div>
                            </td>
                            <td class="align-middle"><span class="material-icons align-middle md-18 text-danger">expand_more</span> 32 Sec</td>
                            <td class="align-middle text-right">@mdo</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection
