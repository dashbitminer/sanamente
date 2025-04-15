<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Sede</th>
            <th>Cantidad deactividades</th>
            <th>Detalle</th>
            <th>Hay registro GWDATA</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($formularios as $formulario)
        <tr>
            <td rowspan="{{ count($formulario->actividades) }}" valign="center">
                {{ $formulario->full_name }}<br/>
                <span>{{ $formulario->documento_identidad }}</span>
            </td>
            <td rowspan="{{ count($formulario->actividades) }}" valign="center">
                {{ $formulario->escuela->name ?? "" }}
            </td>
            @foreach ($formulario->actividades as $key => $actividad )
                    @if ($loop->first)
                        <td>
                            {{ $actividad["count"] ?? '' }}
                        </td>

                        <td>
                            {{ $actividad["nombre"] ?? '' }}
                        </td>

                        <td
                            rowspan="{{ count($formulario->actividades) }}" valign="center" align="center">
                            {{ $formulario->record_gwdata }}
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td>
                            {{ $actividad["count"] ?? '' }}
                        </td>
                        <td>
                            {{ $actividad["nombre"] ?? '' }}
                        </td>
                    </tr>
                    @endif
                @endforeach
        @endforeach
    </tbody>
</table>
