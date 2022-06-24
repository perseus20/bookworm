{{-- <table>
    <thead>
        <tr>
            <th>Book id</th>
            <th>Sub price</th>
            <th>Final price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->book_final_price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $categories->render() }} --}}
@foreach ($books as $book)
    <p>{{ $book->id }} , {{ $book->book_price }}, {{ $book->book_final_price }}</p>
@endforeach
{{-- {{ $books }} --}}
