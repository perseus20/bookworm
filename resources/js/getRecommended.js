import React from "react";
import { useState, useEffect } from "react";

export default function GetRecommended() {
    const [books, setBooks] = useState([]);

    useEffect(() => {
        fetch("http://localhost:8000/api/books/get-recommended")
            .then((res) => res.json())
            .then((result) => {
                setBooks(result.data);
            });
    }, []);
    console.log(books);
    return (
        <>
            {books.map((item) => (
                <li key={item.id}>
                    {item.id} - {item.attributes.book_final_price}
                </li>
            ))}
        </>
    );
}
