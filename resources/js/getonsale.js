import React from "react";
import { useState, useEffect } from "react";
import Carousel from "react-bootstrap/Carousel";

export default function GetOnSale() {
    const [books, setBooks] = useState([]);

    useEffect(() => {
        fetch("http://localhost:8000/api/books/get-on-sale")
            .then((res) => res.json())
            .then((result) => {
                setBooks(result.data);
            });
    }, []);
    return (
        <>
            <Carousel variant="dark">
                {books.map((book) => (
                    <Carousel.Item>
                        <img
                            className="d-block carousel-img"
                            src={book.attributes.book_cover + ".jpg"}
                            alt={book.attributes.book_cover}
                        />
                        <Carousel.Caption>
                            <h3>{book.attributes.book_title}</h3>
                            <p>{book.attributes.book_author.author_name}</p>
                        </Carousel.Caption>
                    </Carousel.Item>
                ))}
            </Carousel>
        </>
    );
}
