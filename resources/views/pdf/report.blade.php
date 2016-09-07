<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Report</title>
</head>
<body>

Report Number: #{{ $report->id }}
<hr>
Patient Name: {{ $report->patient->name }} <br>
Patient Email: {{ $report->patient->email }} <br>
Patient Phone: {{ $report->patient->phone }} <br>
<hr>

<table>
    <thead>
        <tr>
            <th>Test</th>
            <th>Result</th>
            <th>Normal Range</th>
        </tr>

    </thead>

    <tbody>
        @foreach ($report->tests as $test)
            <tr>
                <th>{{ $test->test }}</th>
                <th>{{ $test->result }}</th>
                <th>{{ $test->normal_range }}</th>
            </tr>
        @endforeach
    </tbody>


</table>

<hr>
<p><strong>Statement</strong></p>
<p>{{ $report->statement }}</p>

<hr>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

</body>
</html>