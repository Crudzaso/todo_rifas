<div class="card">
    <div class="container">

        @if(isset($winners) && count($winners) > 0)
            <h3>Ganadores</h3>
            <table>
                <thead>
                <tr>
                    <th>Lotería</th>
                    <th>Número Ganador</th>
                    <th>Número del Usuario</th>
                    <th>ID del Usuario</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($winners as $winner)
                    <tr>
                        <td>{{ $winner['raffle_name'] }}</td>
                        <td>{{ $winner['winning_number'] }}</td>
                        <td>{{ $winner['user_number'] }}</td>
                        <td>{{ $winner['user_id'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No hay ganadores en este momento.</p>
        @endif
    </div>
</div>
