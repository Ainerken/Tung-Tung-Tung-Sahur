<table class="table table-dark">
    <thead><tr><th>ID</th><th>Skor</th><th>Waktu</th></tr></thead>
    <tbody>
        @foreach($history as $h)
        <tr><td>{{ $h->id }}</td><td>{{ $h->score }}</td><td>{{ $h->created_at }}</td></tr>
        @endforeach
    </tbody>
</table>