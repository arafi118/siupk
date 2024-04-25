<link id="pagestyle" href="/assets/css/material-dashboard.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/css/style.css">

<body class="min-vh-100 d-flex align-items-center justify-content-center">
    <form action="/generate/save/{{ $offset }}" method="post">
        @csrf

        @foreach ($data as $key => $val)
            @php
                if ($key == '_token') {
                    continue;
                }
            @endphp

            @if (is_array($val))
                @php
                    $opt = $val['operator'];
                    $value = $val['value'];
                @endphp

                <input type="hidden" name="{{ $key }}[operator]" value="{{ $opt }}">
                <input type="hidden" name="{{ $key }}[value]" value="{{ $value }}">
            @else
                @php
                    $value = $val;
                @endphp

                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <button type="submit" class="btn btn-info" id="generate">Generate</button>
    </form>

    @if (count($data_id_pinj) >= $offset)
        <script>
            $('#generate').submit()
        </script>
    @else
        <script>
            window.close()
        </script>
    @endif
</body>
