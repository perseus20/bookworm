<table>
    <thead>
        <tr>
            <th>Book id</th>
            <th>Category</th>
            <th>Final price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->category->id }}</td>
                <td>{{ $book->author->id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $books->appends($_GET)->links() }}
