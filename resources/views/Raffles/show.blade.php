<form action="{{ route('raffles.show', $raffle->id) }}" method="POST">
    @csrf
    <div>
        <label for="id">Número del Boleto (3-4 dígitos):</label>
        <input type="number" id="id" name="id" min="100" max="9999" placeholder="Ingrese un número de boleto">
    </div>
    <div>
        <button type="button" onclick="generateRandomTicket()">Generar Automáticamente</button>
    </div>
    <div>
        <button type="submit">Comprar Boleto</button>
    </div>
</form>

<script>
    function generateRandomTicket() {
        const randomTicket = Math.floor(Math.random() * 9000) + 100; // Genera entre 100 y 9999
        document.getElementById('id').value = randomTicket;
    }
</script>
