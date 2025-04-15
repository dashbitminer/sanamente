<table>
    <thead>
        <tr>
            <th>Actividad</th>
            <th>Cantidad de grupos</th>
            <th>Perfil</th>
            <th>Participantes unicos</th>
            <th>Total Participaciones</th>
            <th colspan="2">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($actividades as $actividad)
        <tr>
            <td rowspan="{{ count($actividad->total_perfiles_count) }}">
                {{ $actividad->nombre }}</td>
            <td rowspan="{{ count($actividad->total_perfiles_count)}}">{{ $actividad->unique_grupo_count }}</td>

            @foreach ($actividad->total_perfiles_count as $key => $value)
            @if ($loop->first)
                <td>{{ $key }}</td>
                <td>  {{ count(array_filter($actividad->unique_perfiles_count, function($perfil) use ($key) {
                    return $perfil['nombre'] === $key;
                })) }}</td>
                <td>{{ $value }}</td>
                <td rowspan="{{ count($actividad->total_perfiles_count) }}">
                    {{ array_sum($actividad->total_perfiles_count) }}
                </td>
            </tr>
            @else
            <tr>
                <td>{{ $key }}</td>
                <td>{{ count(array_filter($actividad->unique_perfiles_count, function($perfil) use ($key) {
                    return $perfil['nombre'] === $key;
                })) }}</td>
                <td>{{ $value }} </td>
            </tr>
        @endif
        @endforeach
        @endforeach
    </tbody>
</table>
