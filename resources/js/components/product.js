import Navbar from "react-bootstrap/Navbar";
import Container from "react-bootstrap/Container";
import React from "react";
import { useState, useEffect } from "react";
import axios from "axios";
import { useParams } from "react-router";
import { Row, Col } from "react-bootstrap";
export default function Product() {
    let { id } = useParams();
    const [book, setBook] = useState({
        id: 0,
        attributes: {
            book_category: {
                id: 0,
                category_name: "",
                category_desc: "",
            },
            book_author: {
                id: 0,
                author_name: "",
                author_bio: "",
            },
            book_price: 0.0,
            book_final_price: 0.0,
            book_cover: "",
            book_title: "",
            book_summary: "",
        },
    });
    useEffect(async () => {
        await axios
            .get(`http://localhost:8000/api/books/show/${id}`)
            .then((res) => {
                setBook(res.data.data);
            })
            .catch((error) => console.log(error));
    }, []);
    var img;
    if (book.attributes.book_cover) {
        img = book.attributes.book_cover;
    } else {
        img = "default";
    }
    return (
        <>
            <Navbar>
                <Container>
                    <h3>{book.attributes.book_category.category_name}</h3>
                </Container>
            </Navbar>
            <Container>
                <Row>
                    <Col>
                        <img
                            width={250}
                            height={250}
                            src={`http://localhost:8000/images/${img}.jpg`}
                            alt={img}
                        />
                        <p>
                            By (author):
                            {book.attributes.book_author.author_name}
                        </p>
                    </Col>
                    <Col>
                        <p>{book.attributes.book_title}</p>
                        <p>{book.attributes.book_summary}</p>
                    </Col>
                </Row>
            </Container>
        </>
    );
}
