<!DOCTYPE html>
<html lang="en">
<head>
    <title>Отчёт за {{ date('d.m.Y') }} по выполненным задачам</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css" media="screen">
        html {
            margin: 0;
        }
        body {
            font-size: 0.6175rem;
            background-color: #eceff4;
        }
        .tasks-list{
            width:100%;
            text-align:left;
            border-collapse:collapse;
            padding: 2rem 1rem;
        }
        .tasks-list thead{
            background-color:#f1f5f8
        }
        .tasks-list thead tr {
            border-bottom: 2px solid #e8ecef;
        }
        .tasks-list thead tr th {
            color:#6f7279;
            text-transform:uppercase;
            font-size: 9px;
            text-align: left;
        }
        .tasks-list thead tr th.align-right {
            text-align: right;
        }
        .tasks-list thead tr th:last-child{
            text-align:right
        }
        .tasks-list th {
            padding:8px 10px
        }
        .tasks-list td {
            padding:8px 10px;
            border-bottom: 1px solid #f1f1f1;
            background-color: #ffffff;
        }
        .tasks-list tbody tr {
            border-bottom:2px solid #ffffff;
        }
        .tasks-list tbody tr td {
            color:#2f3034;
        }
        .tasks-list tbody tr td:last-child {
            text-align:right
        }
        .tasks-list tr .f-bg {
            background-color: #f1f5f8;
        }
        .align-right {
            text-align: right;
        }
        .author {
            color: #6e6e6e;
            display: block;
            margin: 0;
            font-size: 8px;
        }
        body * {
            font-family: "DejaVu Sans", sans-serif;
            line-height: 1.1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="responsive-table rounded-block">
                    <table class="tasks-list">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Название
                            </th>
                            <th class="align-right">
                                Время
                            </th>
                            <th>
                                Исполнитель
                            </th>
                            <th>
                                Дата закрытия
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <div class="task-name">{{ $task->name }}</div>
                                    <div class="author{{ $task->author->deleted_at ? ' deleted-record' : '' }}">{{ $task->author->name }}</div>
                                </td>
                                <td class="align-right">
                                    {{ format_seconds($task->timer->total) }}
                                </td>
                                <td>
                                    <div class="with-icon">
                                        <div class="user">
                                            {{ $task->performer ? $task->performer->name : '' }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ format_deadline($task->closed_at) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="align-right f-bg" colspan="6">
                                Всего:  <b>{{ format_seconds($timeCalculator->total($tasks)) }}</b>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
